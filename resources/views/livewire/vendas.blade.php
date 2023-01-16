<div class="col-md-12 mt-3">
    <div class="card col-md-12 mt-3">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center flex-wrap">
             <h5 class="font-weight-bold">VENDAS REALIZADAS</h5>
              <button class=" btn btn-sm btn-info" data-toggle="modal" data-target="#addVenda">
                <i class="fa fa-plus"></i>
                Nova Venda
              </button>
            </div>
            <div class="d-flex justify-content-start align-items-center flex-wrap">
              <form class="form-inline ml-3 mt-3">
                  <div class="input-group input-group-sm">
                      <input class="form-control form-control-navbar" wire:model='search' type="search" placeholder="Pesquisar..." aria-label="Search">
                      <div class="input-group-append">
                        <button class="btn btn-info" type="submit">
                          <i class="fas fa-search"></i>
                        </button>
                      </div>
                  </div>
                </form>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table style="width: 90vw" class="table table-striped table-hover text-center">
                    <thead class="table-secondary col-md-12 table-secondary ">
                        <tr>
                            <th>#</th>
                            <th>Imóvel</th>
                            <th>Vendedor</th>
                            <th>Data</th>
                            <th>Cliente</th>
                            <th>Total</th>
                            <th>Tipo Pagamento</th>
                            <th>Banco</th>
                            <th>Opções</th>
                        </tr>
                    </thead>
                    <tbody class="cursor-pointer">
                      @if ($vendas->count() > 0)
                        @foreach ($vendas as $item)
                        <tr>
                            <td>{{$item->id}}</td>
                            <td>{{$item->imovel}}</td>
                            <td>{{$item->operador->name}}</td>
                            <td class="font-weight-bold"
                            >{{Carbon\Carbon::parse($item->created_at)->format('d/m/Y H:i:s')}}</td>
                            <td>{{$item->cliente->nome}}</td>
                            <td class="font-weight-bold"
                            >{{number_format($item->total,2,',','.')}} AKZ</td>
                            <td>{{$item->tipo_pagamento}}</td>
                            <td>{{$item->banco}}</td>
                            <td class="d-flex justify-content-center align-items-center flex-wrap">
                                <button data-toggle="modal" wire:click="detalhes({{$item->id}})" data-target="#detalhes"   title="Detalhes da venda" class="btn btn-sm btn-info"><i class="fa fa-list"></i></button>
                                <button data-toggle="modal" data-target="#confirm_nullable" title="Anular Venda" wire:click="confirm({{$item->id}})" class="btn btn-sm btn-danger mx-1"><i class="fa fa-times"></i></button>
                            </td>
                        </tr>
                        @endforeach
                        @else
                        <tr class="alert alert-info bg-info">
                            <td colspan="14" class="text-light text-center">Nenhuma venda realizada</td>
                        </tr>
                        @endif
                    </tbody>
                </table>
                <div>
                </div>
            </div>
        </div>
        <div class="card-footer">
             {{$vendas->links('pagination::bootstrap-5')}}
        </div>




    @include('includes.alerts')
    @include('modals.vendas.addVenda')
    @include('modals.vendas.detalhes')
    @include('modals.vendas.confirm')
    @include('modals.vendas.liquidar_divida')

    </div>
    </div>
    <script>
        window.addEventListener('close-modal',()=>{
            $('#confirm').modal('hide')
        })
        window.addEventListener('close-modal',()=>{
            $('#confirm_nullable').modal('hide')
        })
        window.addEventListener('show-modal',()=>{
            $('#addVenda').modal('show')
        })
        window.addEventListener('confirm',()=>{
           $('#yes').removeClass('d-none');
        })

        function onlynumber(evt) {
        var theEvent = evt || window.event;
        var key = theEvent.keyCode || theEvent.which;
        key = String.fromCharCode( key );
        //var regex = /^[0-9.,]+$/;
        var regex = /^[0-9.]+$/;
        if( !regex.test(key) ) {
            theEvent.returnValue = false;
            if(theEvent.preventDefault) theEvent.preventDefault();
        }
}



    </script>


