<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('booking_submissions', function (Blueprint $table) {
            $table->id();
            $table->string('provider_id');
            $table->string('before_work_image');
            $table->string('after_work_image');
            $table->string('time_taken');
            $table->string('booking_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('booking_submissions');
    }
};
