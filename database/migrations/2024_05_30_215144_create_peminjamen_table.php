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
        Schema::create('peminjamen', function (Blueprint $table) {
            $table->id();
            $table->string('pemohon');
            $table->string('kegiatan')->nullable();
            $table->text('deskripsi')->nullable();
            $table->string('ruangan');
            $table->date('tanggal');
            $table->string('status', 1)->default('1');
            $table->string('surat');
            $table->string('addedby');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('peminjamen');
    }
};
