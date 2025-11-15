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
        Schema::table('users', function (Blueprint $table) {
            
            if (Schema::hasColumn('users', 'name'))  $table->dropColumn('name');
            if (Schema::hasColumn('users', 'email')) {
                $table->dropUnique('users_email_unique'); // index default Laravel
                $table->dropColumn('email');
            }
            if (Schema::hasColumn('users', 'email_verified_at')) $table->dropColumn('email_verified_at');
            if (Schema::hasColumn('users', 'remember_token'))    $table->dropRememberToken();
            if (Schema::hasColumns('users', ['created_at','updated_at'])) $table->dropTimestamps();
            
            if (!Schema::hasColumn('users', 'username'))     $table->string('username', 50)->unique()->after('id');
            if (!Schema::hasColumn('users', 'pegawai_id'))   $table->unsignedInteger('pegawai_id')->unique()->after('password');
            if (!Schema::hasColumn('users', 'role'))         $table->enum('role', ['Admin','Spv','Petugas Kebersihan'])->default('Petugas Kebersihan')->after('pegawai_id');
            if (!Schema::hasColumn('users', 'last_login'))   $table->timestamp('last_login')->nullable()->after('role');
            if (!Schema::hasColumn('users', 'status'))       $table->enum('status', ['Active','Inactive'])->default('Active')->after('last_login');
            if (!Schema::hasColumn('users', 'created_at'))   $table->timestamps()->nullable()->after('status');
            if (!Schema::hasColumn('users', 'updated_at'))   $table->timestamps()->nullable()->after('created_at');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Balikin seperti semula (sesuaikan kebutuhan)
            $table->dropColumn(['pegawai_id','role','last_login','status','username','created_at','updated_at']);
            $table->string('name')->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }
};