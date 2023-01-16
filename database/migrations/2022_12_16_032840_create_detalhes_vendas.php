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
        Schema::create('detalhes_vendas', function (Blueprint $table) {
            $table->id();
            $table->decimal('preco',20,2);
            $table->integer('quantidade');
            $table->decimal('subtotal',20,2);
            $table->decimal('desconto',10,2)->nullable()->default(0);
            $table->decimal('divida',20,2)->default(0);
            $table->date('prazo_entrega')->nullable();
            $table->decimal('taxa',10,2)->nullable()->default(0.00);

            $table->enum('tipo_fatura',['FP','FT'])->default('FT');
            $table->unsignedBigInteger('id_imovel');
            $table->foreign('id_imovel')->references('id')->on('imoveis');

            $table->unsignedBigInteger('id_venda');
            $table->foreign('id_venda')->references('id')->on('vendas');
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
        Schema::dropIfExists('detalhes_vendas');
    }
};
