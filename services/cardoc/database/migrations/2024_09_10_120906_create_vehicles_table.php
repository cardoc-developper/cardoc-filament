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
            $table->ulid('id')
                ->primary();

            $table->string('name')->nullable();
            $table->string('type');
            $table->string('brand');
            $table->string('model');
            $table->string('license_plate');
            $table->string('color')->nullable();
            $table->string('energy');

            $table->string('date_of_registration')->nullable();
            $table->string('date_of_purchase')->nullable();
            $table->string('vin')->nullable();
            $table->string('mileage')->nullable();
            $table->string('number_of_owner')->nullable();

            $table->text('images')->nullable();
            $table->text('attachments')->nullable();

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
