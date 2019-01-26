<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTipAnalyticsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
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

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tip_analytics');
    }
}
