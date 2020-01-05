<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGroupPagePivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create(
            'group_page', function (Blueprint $table) {
                $table->increments('id');
                $table->unsignedBigInteger('page_id');
                $table->unsignedBigInteger('group_id');

                // foreign keys
                $table->foreign('group_id')->references('id')->on('groups');
                $table->foreign('page_id')->references('id')->on('pages');
                
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
        Schema::dropIfExists('group_page');
    }
}
