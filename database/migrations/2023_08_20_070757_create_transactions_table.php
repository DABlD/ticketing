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

            // EVENT IS USED FOR TICKET ID NOW
            $table->unsignedBigInteger('ticket_id');
            
            $table->string('fname')->nullable();
            $table->string('mname')->nullable();
            $table->string('lname')->nullable();
            
            $table->string('gender')->nullable();
            $table->date('birthday')->nullable();

            $table->string('contact')->nullable();
            $table->string('email')->nullable();

            $table->text('address')->nullable();

            $table->timestamps();

            $table->foreign('ticket_id')
                  ->references('id')
                  ->on('tickets');

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
