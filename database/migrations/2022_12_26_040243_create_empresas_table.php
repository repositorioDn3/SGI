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
        Schema::create('empresas', function (Blueprint $table) {
            $table->id();
            $table->string('nome',255);
            $table->string('nif',15);
            $table->string('provincia',255);
            $table->string('municipio',255);
            $table->enum('regime',['Simplificado','Geral','Exclusao'])->default('Exclusao');
            $table->text('detalhes_localizacao',255);
            $table->string('telefone',15);
            $table->string('logotipo',255)->nullable();
            $table->string('telefone_alternativo',15)->nullable();
            $table->string('email');
            $table->string('website')->nullable();
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
        Schema::dropIfExists('empresas');
    }
};
