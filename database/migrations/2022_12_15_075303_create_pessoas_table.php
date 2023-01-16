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
        Schema::create('pessoas', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->enum('tipo_pessoa',['FÍSICA','JURÍDICA']);
            $table->text('endereco');
            $table->string('telefone');
            $table->string('email')->unique();
            $table->string('nif');
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
        Schema::dropIfExists('pessoas');
    }
};
