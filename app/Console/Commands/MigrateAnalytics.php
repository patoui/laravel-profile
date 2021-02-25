<?php

namespace App\Console\Commands;

use ClickHouseDB\Client;
use Exception;
use Illuminate\Console\Command;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

/**
 * Migrate analytics from MySQL to Clickhouse
 * Class MigrateAnalytics
 * @package App\Console\Commands
 */
class MigrateAnalytics extends Command
{
    /** @var string */
    protected $signature = 'migrate:analytics {last_id?}';

    /** @var string */
    protected $description = 'Migrate analytics';

    /** @var Client */
    private Client $clickhouse;

    public function __construct(Client $client)
    {
        parent::__construct();
        $this->clickhouse = $client;
    }

    public function handle(): void
    {
        $last_id = $this->argument('last_id');
        $processed_count = 0;
        DB::table('analytics')
            ->select(
                'id',
                'analytical_id',
                'analytical_type',
                'headers',
                DB::raw('UNIX_TIMESTAMP(created_at) as ts')
            )
            ->when($last_id, static function ($q) use ($last_id) {
                $q->where('id', '>', $last_id);
            })
            ->oldest('id')
            ->chunk(50, function (Collection $rows) use (&$processed_count) {
                $data = $rows->map(static function ($v) {
                    $v = (array) $v;
                    unset($v['id']);
                    return $v;
                })->toArray();
                $this->clickhouse->insertAssocBulk('analytics', $data);
                $processed_count += $rows->count();
                $this->info('SUCCESSFULLY MIGRATED: ' . ($processed_count) . ' RECORDS');
                // should clickhouse fail we can restart at the last id
                file_put_contents(base_path('last_id.txt'), $rows->last()->id, FILE_APPEND);
            });

        // successfully migrated, delete log
        unlink(base_path('last_id.txt'));
        $this->info('SUCCESSFULLY MIGRATED TO CLICKHOUSE');
    }
}
