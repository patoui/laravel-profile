<?php

use App\Analytic;
use App\Post;
use App\Tip;
use App\Video;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class BackfillAnalyticsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('tip_analytics')) {
            DB::table('tip_analytics')->oldest()->each(static function ($a) {
                self::createRecordIfNotExist($a, Tip::class);
            });
        }

        if (Schema::hasTable('post_analytics')) {
            DB::table('post_analytics')->oldest()->each(static function ($a) {
                self::createRecordIfNotExist($a, Post::class);
            });
        }

        if (Schema::hasTable('video_analytics')) {
            DB::table('video_analytics')->oldest()->each(static function ($a) {
                self::createRecordIfNotExist($a, Video::class);
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }

    /**
     * @param int    $model_id
     * @param string $model_type
     * @return bool
     */
    public static function hasRecord(int $model_id, string $model_type): bool
    {
        return DB::table('analytics')
                 ->where('analytical_id', $model_id)
                 ->where('analytical_type', $model_type)
                 ->exists();
    }

    public static function createRecordIfNotExist(stdClass $model, string $class_name): void
    {
        if (!self::hasRecord($model->id, $class_name)) {
            Analytic::create([
                'analytical_id'   => $model->id,
                'analytical_type' => $class_name,
                'headers'         => $model->headers,
                'created_at'      => $model->created_at,
                'updated_at'      => $model->updated_at,
            ]);
        }
    }
}
