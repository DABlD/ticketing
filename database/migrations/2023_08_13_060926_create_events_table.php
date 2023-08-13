<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->text('description');

            $table->date('date');
            $table->string('start_time');
            $table->string('end_time');

            $table->string('venue');
            $table->string('venue_address')->nullable();

            $table->boolean('ticket')->default(0);

            $table->json('images')->nullable();
            $table->enum('status', ['Upcoming', 'Finished'])->default('Upcoming');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('events');
    }
}
