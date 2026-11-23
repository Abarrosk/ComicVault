<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('comics', function (Blueprint $table) {
            $table->id();
            $table->string('titulo', 255);
            $table->string('editor', 100);
            $table->string('isbn', 20)->nullable()->unique();
            $table->string('formato', 50)->nullable();
            $table->string('caminho_capa', 255)->nullable();
            $table->text('descricao')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('comics');
    }
};
