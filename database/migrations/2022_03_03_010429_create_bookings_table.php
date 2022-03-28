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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->string('customer_id')->nullable();
            $table->string('schedule')->nullable();
            $table->string('provider_id')->nullable();
            $table->string('payment_type')->nullable();
            $table->string('services')->nullable();
            $table->string('category_name')->nullable();
            $table->string('verification_code')->nullable();
            $table->string('verified')->nullable();
            $table->string('instructions')->nullable();
            $table->string('instructions_image')->nullable();
            //$table->string('services')->nullable();
            $table->string('time')->nullable();
            $table->string('date')->nullable();
            $table->string('status')->nullable();
            $table->string('location')->nullable();
            $table->string('longitude')->nullable();
            $table->string('latitude')->nullable();
            $table->string('coupon')->nullable();
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
        Schema::dropIfExists('bookings');
    }
};
