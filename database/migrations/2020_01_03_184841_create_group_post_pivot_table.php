<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGroupPostPivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create(
            'group_post', function (Blueprint $table) {
                $table->increments('id');
                $table->unsignedBigInteger('post_id');
                $table->unsignedBigInteger('group_id');

                // foreign keys
                $table->foreign('group_id')->references('id')->on('groups');
                $table->foreign('post_id')->references('id')->on('posts');
                
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
        Schema::dropIfExists('group_post');
    }
}
