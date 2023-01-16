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
        Schema::create('vendas', function (Blueprint $table) {
            $table->id();
            $table->string('imovel');
            $table->decimal('total',10,2)->default(0);
            $table->enum('anular',['sim','nao'])->default('nao');
            $table->string('banco')->nullable();
            $table->enum('tipo_pagamento',['TPA','TRANFERÊNCIA'])->default('TPA')->nullable();
            $table->unsignedBigInteger('id_pessoa');
            $table->foreign('id_pessoa')->references('id')->on('pessoas');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
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
        Schema::dropIfExists('vendas');
    }
};
