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
        Schema::create('wargas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('no action')->onUpdate('cascade');
            $table->foreignId('rt_id')->nullable()->constrained('rukun_tetangga')->onDelete('no action')->onUpdate('cascade');
            $table->string('nik')->unique();
            $table->string('no_kk')->nullable();
            $table->string('nama_lengkap');
            $table->string('blok')->nullable();        // ✅ Blok
            $table->string('no_rumah')->nullable();    // ✅ Nomor rumah
            $table->string('no_hp')->nullable();
            $table->string('jenis_kelamin')->nullable();
            $table->date('tanggal_lahir')->nullable();
            $table->text('alamat')->nullable();
            $table->string('pekerjaan')->nullable();
            $table->string('status_perkawinan')->nullable();
            $table->boolean('is_aktif')->default(true); // ✅ Status aktif
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wargas');
    }
};
