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
            $table->foreignId('id_tower')->constrained('towers')->onDelete('cascade');
            $table->integer('lantai');
            $table->foreignId('id_sensor')->constrained('sensors')->onDelete('cascade');
            $table->enum('status', ['Active', 'Inactive'])->default('Active');
           $table->timestamps();
        });

        Schema::table('tempat_sampahs', function (Blueprint $table) {
            $table->string('id_sensor',10)->after('lantai')->nullable()->change();
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
