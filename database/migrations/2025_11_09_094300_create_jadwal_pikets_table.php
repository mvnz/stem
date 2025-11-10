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
        Schema::create('jadwal_pikets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pegawai_id')->constrained('pegawais')->onDelete('cascade');
            $table->date('tanggal');
            $table->foreignId('tower_id')->constrained('towers')->onDelete('cascade');
            $table->enum('shift', ['Pagi', 'Sore', 'Malam', 'Libur']);
            $table->time('jam_mulai')->nullable();
            $table->time('jam_selesai')->nullable();

            $table->timestamps();

            $table->unique(['pegawai_id', 'tanggal']); //1 orang yang sama cuma bisa 1 jadwal 1 harinya
            $table->unique(['pegawai_id', 'tanggal', 'shift', 'tower_id']); //1 hari 1 hari-shift-tower cuma bisa 1 orang untuk orang yang sama
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jadwal_pikets');
    }
};
