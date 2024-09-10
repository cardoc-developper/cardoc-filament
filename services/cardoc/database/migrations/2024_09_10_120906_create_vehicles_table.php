<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            $table->string('license_plate')->nullable();
            $table->string('brand');
            $table->string('model');
            $table->string('type')->nullable();
            $table->string('date_of_registration')->nullable();
            $table->string('vin')->nullable();
            $table->string('color')->nullable();
            $table->string('mileage')->nullable();
            $table->string('energy')->nullable();
            $table->string('date_of_purchase')->nullable();
            $table->string('number_of_owner')->nullable();
            $table->string('images')->nullable();
            $table->string('attachments')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicles');
    }
};
