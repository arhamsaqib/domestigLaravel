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
        Schema::create('provider_notifications', function (Blueprint $table) {
            $table->id();
            $table->string('provider_id')->nullable();
            $table->string('customer_id')->nullable();
            $table->string('booking_id')->nullable();
            $table->string('category')->nullable();
            $table->string('description');
            $table->string('status')->nullable();
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
        Schema::dropIfExists('provider_notifications');
    }
};
