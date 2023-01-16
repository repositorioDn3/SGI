<div class="col-md-12 mt-3">
    <div class="card  mt-3">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center flex-wrap">
             <h5 class="font-weight-bold">GERAR RELATÓRIOS</h5>
            </div>
        </div>
        <div class="card-body">
            <form  method="post" wire:submit.prevent='filtrarDados'>
                @method('POST')

                <div class="row">
                    <div class="col-md-12 d-flex justify-content-start align-items-center flex-wrap">
                        <div class="col-md-3">
                            <label for="tipo_relatorio">Vendedor</label>
                            <select wire:model="utilizador" id="utilizador" class="form-control">
                                <option value="">Selecionar</option>
                                <option value="todos">Todos</option>
                                @if($utilizadores->count() > 0)
                                    @foreach ($utilizadores as $item)
                                         <option value="{{$item->id}}">{{$item->name}}</option>
                                    @endforeach
                                @endif

                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="dt_inicio">Data de Início</label>
                            <input type="date" wire:model="dt_inicio" id="dt_inicio" class="form-control">
                        </div>
                        <div class="col-md-3">
                            <label for="dt_fim">Data de fim</label>
                            <input type="date" wire:model="dt_fim" id="dt_fim" class="form-control">
                        </div>
                    </div>
                </div>
        </form>
        <hr>
        @if(isset($dados))
        <div class="table-responsive">
            <div class="d-flex justify-content-end align-items-center flex-wrap mb-2">
                <button wire:click='imprimir' class="btn btn-sm btn-info">
                    <i class="fa fa-print"></i>
                    Imprimir
                </button>
            </div>
            <table class="table table-bordered table-hover  text-center">
                <thead>
                    <tr>
                        <th>Data</th>
                        <th>Vendedor</th>
                        <th>Imóvel</th>
                        <th>Preço</th>
                        <th>Qtd.</th>
                        <th>Total</th>
                        <th>Pago Por</th>
                        <th>Cliente</th>

                    </tr>
                </thead>
                <tbody>
                    @if ($dados->count() > 0)
                        @foreach ($dados as $item)
                            <tr>
                                <td>{{\carbon\Carbon::parse($item->data)->format('d-m-Y')}}</td>
                                <td>{{$item->usuario}}</td>
                                <td>{{$item->imovel}}</td>
                                <td>{{number_format($item->preco,2,',','.')}} Kzs</td>
                                <td>{{number_format($item->quantidade,2,',','.')}}</td>
                                <td>{{number_format($item->total,2,',','.')}} Kzs</td>
                                <td>{{$item->tipo_pagamento}}</td>
                                <td>{{$item->nome}}</td>
                            </tr>
                        @endforeach
                        @else
                        <tr class="text-center">
                            <td colspan="8">Nenhum resultado foi encontrado...</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>

        @endif
        </div>
        <div class="card-footer">
            <i class="fa fa-info text-info"></i>
            <span class="text-uppercase font-weight-bold">Para gerar um relatório deve filtrar os dados e clicar em imprimir</span>
        </div>
        @include('includes.alerts')

    </div>
    </div>


