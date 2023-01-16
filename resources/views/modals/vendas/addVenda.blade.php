 <!-- Modal  Adicionar Departamento-->
 <div wire:ignore.self class="modal fade" data-backdrop="static" id="addVenda" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content" >
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">
            Nova Venda
          </h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close" >
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body" wire:submit.prevent='save'>
        <form  enctype="multipart/form-data" class="col-md-12 d-flex justify-content-between align-items-center flex-wrap" >
            @csrf
            <div class="border-info  rounded mt-5 col-md-12 d-flex justify-content-between align-items-center flex-wrap " style="border: 1px solid; padding: 1rem">
            <div class="col-md-6">
                <label for="selecionar_cliente">Pesquisar cliente:</label>
                <input type="text" wire:model="selecionar_cliente" id="selecionar_cliente" class="form-control"  placeholder="Pesquisar">
            </div>
            <div class="col-md-6">
                <label for="cliente">Selecionar Cliente:</label>
                <select wire:model="cliente" id="cliente" class="form-control bg-secondary">
                  <option value="">Selecionar</option>
                    @foreach ($clientes as $item)
                        <option value="{{$item->id}}">{{$item->nome}}</option>
                    @endforeach
                </select>
                @error('cliente')
                  <span class="text-danger">{{$message}}</span>
                @enderror
            </div>
            <div class="col-md-6">
              <label for="preco">Forma de Pagamento:</label>
              <select wire:model="tipo_pagamento" id="tipo_pagamento" class="form-control ">
                <option  selected>Selecionar</option>
                <option value="TPA">TPA</option>
                <option value="TRANSFÊRENCIA">TRANSFÊRENCIA</option>
              </select>
              @error('tipo_pagamento')
              <span class="text-danger">{{$message}}</span>
              @enderror
            </div>
            <div class="col-md-6">
              <label for="preco">Banco Associado:</label>
              <select wire:model="banco_associado" id="banco_associado" class="form-control ">
                <option value="" selected>Selecionar</option>
                @if ($contas_bancaris)
                @foreach ($contas_bancaris as $item)
                <option value="{{$item->banco}}" selected>{{$item->banco}}</option>
                @endforeach
                @endif
              </select>
              @error('banco_associado')
              <span class="text-danger">{{$message}}</span>
              @enderror
            </div>
            </div>

            <div class="border-info  rounded mt-5 col-md-12 d-flex justify-content-between align-items-center flex-wrap " style="border: 1px solid; padding: 1rem">

              <div class="border-info  rounded col-md-12 mt-3 mb-3 shadow-sm d-flex justify-content-center align-items-center flex-wrap " style="border:1px solid">
                <div class="col-md-12 mt-3 mb-3">
                  <label for="">Pagar por:</label>

                  <select wire:model="pagar_por" id="pagar_por" class="form-control" wire:change='informacoes_do_produto_selecionado'>
                    <option selected value="valor por parcela">Valor por Parcela</option>
                    <option value="valor total">Valor total</option>
                  </select>
                </div>

              </div>
              <div class="col-md-6">
                <label for="selecionar_imovel">Pesquisar Imóvel:</label>
                <input type="text" wire:model="selecionar_imovel" id="selecionar_imovel" class="form-control"  placeholder="Pesquisar">
              </div>

              <div class="col-md-6 ">
                  <label for="imovel_id">Imóveis:</label>
                  <select  wire:model="imovel" id="imovel" class="form-control" wire:change='informacoes_do_produto_selecionado'>
                    <option value="">Selecionar</option>
                    @foreach ($imoveis as $item)
                        <option value="{{$item->id}}">{{$item->categorias->nome}}</option>
                    @endforeach
                  </select>
                  @error('imovel')
                    <span class="text-danger">{{$message}}</span>
                  @enderror
              </div>


              <div class="col-md-6">
                <label for="estoque">Estoque:</label>
                <input type="number" disabled wire:model="estoque"  id="estoque" class="form-control"  placeholder="0,00" >
                @error('estoque')
                  <span class="text-danger">{{$message}}</span>
                @enderror
            </div>



              <div class="col-md-6">
                <label for="preco">Preço:</label>
                <input type="number" disabled wire:model="preco"  id="preco" class="form-control"  placeholder="0,00">
                @error('preco')
                  <span class="text-danger">{{$message}}</span>
                @enderror
              </div>
              <div class="col-md-6">
                <label for="desconto">Quantidade:</label>
                <input type="number" wire:model="quantidade" onkeypress="onlynumber()"  id="quantidade" class="form-control"  placeholder="0,00">
                @error('quantidade')
                <span class="text-danger">{{$message}}</span>
                @enderror
              </div>
              <div class="col-md-6">
                <label for="desconto">Desconto:</label>
                <input type="number" onkeypress="onlynumber()" wire:model="desconto"  id="desconto" class="form-control"  placeholder="0,00">
                @error('desconto')
                <span class="text-danger">{{$message}}</span>
                @enderror
              </div>
          <div class="col-md-12 mt-3 d-flex justify-content-between">
            <p class="font-weight-bold text-lg text-success">Total: {{number_format(abs($total),2,',','.')}} AKZS</p>
            <button type="button" class="btn btn-info" wire:click='adicionar_imovel_no_carrinho'>
              <i class="fa fa-hand-holding-usd"></i>
               Adicionar
            </button>
          </div>
        </div>
        <div class="table-responsive">
          <table class="table table-striped table-hover text-center">
            <thead>
              <tr>
                <th>Nome</th>
                <th>Preço</th>
                <th>Quantidade</th>
                <th>Desconto</th>
                <th>Opção</th>
              </tr>
            </thead>
            <tbody style="text-transform:uppercase">
              @if (isset($carts) && count($carts))
                @foreach ($carts as $Key=>$item)
                <tr>
                  <td>{{$item->name}}</td>
                  <td>{{number_format($item->price,2,',','.')}} Akzs</td>
                  <td>{{number_format($item->quantity,2,',','.')}}</td>
                  <td>{{number_format($item->attributes['desconto'],2,',','.')}}</td>
                  <td>
                    <button type="button" class="btn btn-sm btn-danger"  wire:click='confirm({{$item->id}})'>
                      <i class="fa fa-trash"></i>
                    </button>
                    <button   type="button" class="btn btn-sm btn-success d-none" id="yes"  wire:click='delete' title="Clicar para cponfirmar">
                      <i class="fa fa-check"></i>
                    </button>
                  </td>
                </tr>
               @endforeach
              @else
              <tr>
                <td  class="alert alert-info font-weight-bold" colspan="5">Nenhum Imóvel adicionado de momento</td>
              </tr>
              @endif
            </tbody>
          </table>
        </div>


    </form>

</div>
    <div class="modal-footer d-flex justify-content-center align-items-center flex-wrap">
            <button type="button" class="btn btn-info" wire:click='faturar("proforma")'>
                <i class="fa fa-file-pdf"></i>
            Fatura Proforma
            </button>
            <button type="button" class="btn btn-info" wire:click='faturar("a4")'>
                <i class="fa fa-file-pdf"></i>
                Fatura A4
            </button>
            <button type="button" class="btn btn-info" wire:click='faturar("ticket")'>
                <i class="fa fa-ticket-alt"></i>
                Fatura Recibo
            </button>
        </div>
        </div>
      </div>
    </div>
  </div>
