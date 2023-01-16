<div class="col-md-12 mt-3">
    <div class="card col-md-12 mt-3">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center flex-wrap">
             <h5 class="font-weight-bold">CONTAS BANCARIAS </h5>
              <button class=" btn btn-sm btn-info" data-toggle="modal" data-target="#addConta">
                <i class="fa fa-plus"></i>
                Cadastrar
              </button>
            </div>
            <div class="d-flex justify-content-start align-items-center flex-wrap">
              <form class="form-inline ml-3 mt-3">
                  <div class="input-group input-group-sm">
                      <input class="form-control form-control-navbar" wire:model='search' type="search" placeholder="Pesquisar..." aria-label="Search">
                      <div class="input-group-append">
                        <span class="btn btn-info" >
                          <i class="fas fa-search"></i>
                        </span>
                      </div>
                  </div>
                </form>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-hover text-center">
                    <thead class="table-secondary col-md-12 table-secondary ">
                        <tr>
                            <th>#</th>
                            <th>Banco</th>
                            <th>Número da conta</th>
                            <th>Ibam</th>
                            <th>Opções</th>
                        </tr>
                    </thead>
                    <tbody class="cursor-pointer">
                      @if ($contas->count() > 0)
                        @foreach ($contas as $item)
                        <tr>
                            <td>{{$item->id}}</td>
                            <td>{{$item->banco}}</td>
                            <td>{{$item->numero ?? 'Nenhuma descrição'}}</td>
                            <td>{{$item->ibam ?? 'Nenhuma descrição'}}</td>
                            <td class="">
                                <button title="Editar Imóvel" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#editConta" wire:click='edit({{$item->id}})'>
                                    <i class="fa fa-edit"></i>
                                </button>
                                <button title="Excluir Imóvel" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#confirmContas" wire:click='confirm({{$item->id}})'>
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </td>
                        </tr>
                        @endforeach
                        @else
                        <tr class="alert alert-info bg-info">
                            <td colspan="14" class="text-light text-center">Nenhuma conta encontrada</td>
                        </tr>
                        @endif
                    </tbody>
                </table>
                <div>
                </div>
            </div>
        </div>
        <div class="card-footer">
            {{$contas->links('pagination::bootstrap-5')}}
        </div>




        @include('modals.contas_bancarias.addConta')
        @include('modals.contas_bancarias.editConta')
        @include('modals.contas_bancarias.confirm')
        @include('includes.alerts')

    </div>
    </div>

    <script>
        window.addEventListener('close-modal',event=>{
            $('#editConta').modal('hide');
        })

        window.addEventListener('close-modal',event=>{
            $('#confirmContas').modal('hide');
        })
    </script>

