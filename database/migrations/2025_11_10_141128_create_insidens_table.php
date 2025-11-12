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
        Schema::create('insidens', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal_insiden');
            $table->date('tanggal_close')->nullable();
            $table->foreignId('tower_id')->constrained('towers')->onDelete('cascade');
            $table->enum('jenis_insiden', ['Sampah', 'Sensor', 'Lantai', 'Lainnya']);
            $table->text('deskripsi_insiden');
            $table->enum('status_insiden', ['Open', 'Proses Perbaikan', 'Closed'])->default('Open');
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('cascade');
            $table->string('catatan_perbaikan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('insidens');
    }
};
