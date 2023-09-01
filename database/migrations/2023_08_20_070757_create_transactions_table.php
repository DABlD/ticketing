<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('event_id');
            
            $table->string('fname')->nullable();
            $table->string('mname')->nullable();
            $table->string('lname')->nullable();
            
            $table->string('gender')->nullable();
            $table->date('birthday')->nullable();

            $table->string('contact')->nullable();
            $table->string('email')->unique()->nullable();
            
            $table->text('address')->nullable();

            $table->timestamps();

            $table->foreign('event_id')
                  ->references('id')
                  ->on('events');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions');
    }
}
