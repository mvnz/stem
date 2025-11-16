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
        Schema::create('notif_whatsapps', function (Blueprint $table) {
            $table->id();
            $table->string('no_telp');              // nomor tujuan (pake format 62xxx)
            $table->text('pesan');              // isi pesan
            $table->string('status')->nullable(); // success / failed / pending
            $table->json('response')->nullable(); // response raw dari Fonnte
            $table->timestamp('sent_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('notif_whatsapps');
    }
};
