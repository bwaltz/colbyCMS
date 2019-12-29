<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'pages', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->integer('user_id');
                $table->text('title');
                $table->text('slug')->nullable();
                $table->boolean('published')->default(false);
                $table->longText('body');
                $table->dateTime('published_on')->nullable();
                $table->timestamps();
                $table->softDeletes();
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
        Schema::dropIfExists('pages');
    }
}
