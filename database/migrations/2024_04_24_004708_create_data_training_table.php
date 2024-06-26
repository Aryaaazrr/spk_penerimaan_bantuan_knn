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
        Schema::create('data_training', function (Blueprint $table) {
            $table->id('id_training');
            $table->unsignedBigInteger('id_penduduk')->required();
            $table->foreign('id_penduduk')->references('id_penduduk')->on('penduduk')->onDelete('cascade')->onUpdate('cascade');
            $table->enum('keputusan', ['Layak', 'Tidak Layak'])->nullable();
            $table->double('distance')->nullable();
            $table->integer('rangking')->nullable();
            $table->enum('pilihan', ['Ya', 'Tidak'])->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_training');
    }
};