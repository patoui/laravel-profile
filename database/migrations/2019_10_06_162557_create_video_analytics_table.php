<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVideoAnalyticsTable extends Migration
{
    public function up()
    {
        Schema::create('video_analytics', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('video_id')->unsigned();
            $table->json('headers')->nullable();
            $table->timestamps();

            $table->foreign('video_id')->references('id')->on('videos');
        });
    }

    public function down()
    {
        Schema::dropIfExists('video_analytics');
    }
}
