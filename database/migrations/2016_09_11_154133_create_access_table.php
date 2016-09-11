<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccessTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('access', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->integer('house_id')->unsigned();
            $table->integer('amount')->unsigned();
            $table->enum('action', ['add', 'remove', 'set']);
            $table->timestamps();

            // Foreign Keys declaration
            $table->foreign('user_id')->references('id')->on('user');
            $table->foreign('house_id')->references('id')->on('house');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('access');
    }
}
