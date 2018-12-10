<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIndexVideosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('index_videos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('url');
            $table->string('video_type');
            $table->string('title');
            $table->string('desc');
            $table->string('img');
            $table->timestamps();
            $table->foreign('video_type')->references('ename')->on('video_types')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('index_videos');
    }
}
