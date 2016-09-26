<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOperationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('operation', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->integer('house_id')->unsigned();
            $table->integer('amount');
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
        Schema::drop('operation');
    }
}
