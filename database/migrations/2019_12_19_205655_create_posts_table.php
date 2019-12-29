<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'posts', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('user_id')->unsigned();
                $table->boolean('published')->default(false);
                $table->string('title');
                $table->text('body');
                $table->binary('image')->nullable();
                $table->timestamps();
                $table->softDeletes();
                // $table->integer('current_revision')->unsigned()->nullable();
                $table->text('slug')->nullable();

                // $table->foreign('current_revision')->references('id')->on('revisions');
            }
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
}
