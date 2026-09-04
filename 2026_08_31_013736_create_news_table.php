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
        Schema::create('news', function (Blueprint $table) {

            $table->id();

            // Judul berita
            $table->string('title');

            // Isi berita
            $table->text('content');

            // Gambar berita
            $table->string('image')->nullable();

            // Nama pembuat berita
            $table->string('author');

            // Tanggal berita diterbitkan
            $table->date('published_date')->nullable();

            // Lokasi berita
            $table->string('address')->nullable();

            // Kategori berita
            $table->enum('category', [
                'Pengajian',
                'Takziyah',
                'Kegiatan NU',
                'Lembaga NU',
                'Artikel Desa',
                'Informasi Desa',
                'Keagamaan',
                'Sosial',
                'Pendidikan',
                'Kesehatan',
                'lainnya'
            ]);

            // Status persetujuan berita
            $table->enum('status', [
                'draft',
                'pending',
                'published',
                'rejected'
            ])->default('draft');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('news');
    }
};