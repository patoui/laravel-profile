<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

final class CreateTagTipTable extends Migration
{
    public function up()
    {
        Schema::create('tag_tip', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('tip_id')->unsigned();
            $table->integer('tag_id')->unsigned();
            $table->timestamps();

            $table->foreign('tip_id')->references('id')->on('tips');
            $table->foreign('tag_id')->references('id')->on('tags');
        });
    }

    public function down()
    {
        Schema::dropIfExists('tag_tip');
    }
}
