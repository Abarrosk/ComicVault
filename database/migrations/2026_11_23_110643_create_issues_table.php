<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('issues', function (Blueprint $table) {
            $table->id();

            $table->foreignId('id_comic')
                ->constrained('comics')
                ->cascadeOnDelete();

            $table->string('nome_serie', 255);
            $table->string('numero_edicao', 20);
            $table->string('titulo', 255)->nullable();
            $table->date('data_publicacao')->nullable();
            $table->string('caminho_capa', 255)->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('issues');
    }
};
