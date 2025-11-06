<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  public function up(): void {
    Schema::create('trash_readings', function (Blueprint $t) {
      $t->id();
      $t->string('device_id')->index();
      $t->float('bin_height_cm');
      $t->float('distance_cm');
      $t->float('fill_pct');
      $t->json('payload')->nullable();
      $t->timestamp('measured_at')->index();
      $t->timestamps();
    });
  }
  public function down(): void {
    Schema::dropIfExists('trash_readings');
  }
};
