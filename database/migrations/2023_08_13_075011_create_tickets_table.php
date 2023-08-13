<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('event_id');

            $table->string('type');
            $table->float('price', 8,2);
            $table->unsignedSmallInteger('stock');
            $table->date('end_date')->nullable();

            $table->date('sale_until')->nullable();
            $table->float('sale_price', 8,2)->nullable();

            $table->timestamps();
            $table->softDeletes();

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
        Schema::dropIfExists('tickets');
    }
}
