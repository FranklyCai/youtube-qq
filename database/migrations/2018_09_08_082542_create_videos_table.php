<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVideosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('videos', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->string('url');
            $table->string('videoName');
            $table->string('type');
            $table->string('videoDesc');
            $table->string('poster')->nullable();
            $table->string('upload_path');
            $table->string('4K')->nullable();
            $table->string('2K')->nullable();
            $table->string('1080P')->nullable();
            $table->string('720P')->nullable();
            $table->string('480P')->nullable();
            $table->string('360P')->nullable();
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('type')->references('ename')->on('video_types')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('videos');
    }
}
