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
        Schema::create('tempat_sampahs', function (Blueprint $table) {
            $table->id();
            $table->string('nama_tempat_sampah', 100);
            $table->integer('id_tower');
            $table->integer('lantai');
            $table->integer('id_sensor');
            $table->enum('status', ['Active', 'Inactive'])->default('Active');
           $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tempat_sampahs');
    }
};
