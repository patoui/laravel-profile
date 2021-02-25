<?php

use ClickHouseDB\Client;
use Illuminate\Database\Migrations\Migration;

class ChCreateAnalyticsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        if (app()->environment('testing')) {
            return;
        }

        /** @var Client $client */
        $client = resolve(Client::class);
        $client->write('
            CREATE TABLE IF NOT EXISTS analytics (
                dt              Date DEFAULT toDate(ts),
                ts              DateTime,
                analytical_id   UInt32,
                analytical_type String,
                headers         String /* JSON */
            ) ENGINE = MergeTree (dt, (analytical_id, dt), 8192);
        ');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        if (app()->environment('testing')) {
            return;
        }

        /** @var Client $client */
        $client = resolve(Client::class);
        $client->write('DROP TABLE IF EXISTS analytics');
    }
}
