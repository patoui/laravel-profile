<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentsTable extends Migration
{
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('post_id')->unsigned();
            $table->text('body');
            $table->timestamps();

            $table->foreign('post_id')
                ->references('id')
                ->on('posts');
        });
    }

    public function down()
    {
        Schema::dropIfExists('comments');
    }
}
