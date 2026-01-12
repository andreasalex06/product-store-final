<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up() {
    Schema::create('coupons', function (Blueprint $table) {
        $table->id();
        $table->string('code')->unique(); // Kode kupon harus unik 
        $table->enum('type', ['fixed', 'percent']); // Potongan tetap atau persen
        $table->decimal('value', 10, 2); // Nilai potongan
        $table->integer('max_uses')->default(0); // Batas penggunaan
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('coupons');
    }
};
