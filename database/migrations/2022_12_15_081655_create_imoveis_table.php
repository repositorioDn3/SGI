<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('imoveis', function (Blueprint $table) {
            $table->id();
            $table->decimal('preco_inicial',65,2);
            $table->decimal('preco_final',65,2);
            $table->decimal('preco_total',65,2);
            $table->string('area_total');
            $table->string('area_construida');
            $table->integer('quantidade');
            $table->text('descricao')->nullable();
            $table->unsignedBigInteger('categoria');
            $table->foreign('categoria')->references('id')->on('categorias');
            $table->enum('esta_desponivel',['sim','nao'])->default('sim');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('imoveis');
    }
};
