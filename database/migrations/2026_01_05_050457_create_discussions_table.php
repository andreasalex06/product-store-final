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
        Schema::create('discussions', function (Blueprint $table) {
            $table->id();
            // Data Penanya
            $table->foreignId('user_id')->constrained()->onDelete('cascade');

            // Konten Pertanyaan
            $table->string('subject'); // Judul singkat
            $table->text('question');  // Isi detail

            // Data Jawaban (Nullable karena awal dibuat pasti belum dijawab)
            $table->text('answer')->nullable();
            $table->foreignId('admin_id')->nullable()->constrained('users'); // Siapa admin yang jawab

            // Status
            $table->boolean('is_answered')->default(false);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('discussions');
    }
};
