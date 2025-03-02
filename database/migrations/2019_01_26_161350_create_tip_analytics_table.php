<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

final class CreateTipAnalyticsTable extends Migration
{
    public function up()
    {
        Schema::create('tip_analytics', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('tip_id')->unsigned();
            $table->json('headers')->nullable();
            $table->timestamps();

            $table->foreign('tip_id')->references('id')->on('tips');
        });
    }

    public function down()
    {
        Schema::dropIfExists('tip_analytics');
    }
}
