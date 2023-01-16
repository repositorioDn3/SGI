<div class="col-md-12 mt-3">
    <div class="card col-md-12 mt-3">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center flex-wrap">
             <h5 class="font-weight-bold">CLIENTES DISPONÍVEIS</h5>
              <button class=" btn btn-sm btn-info" data-toggle="modal" data-target="#addCategoria">
                <i class="fa fa-plus"></i>
                Cadastrar
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
                <table class="table table-striped table-hover text-center">
                    <thead class="table-secondary col-md-12 table-secondary ">
                        <tr>
                            <th>#</th>
                            <th>Nome</th>
                            <th>Entidade</th>
                            <th>NIF</th>
                            <th>Telefone</th>
                            <th>E-mail</th>
                            <th>Endereço</th>
                            <th>Ação</th>
                        </tr>
                    </thead>
                    <tbody class="cursor-pointer">
                      @if ($pessoas->count() > 0)
                        @foreach ($pessoas as $pessoa)
                        <tr>
                            <td>{{$pessoa->id}}</td>
                            <td>{{$pessoa->nome}}</td>
                            <td>{{$pessoa->tipo_pessoa}}</td>
                            <td>{{$pessoa->nif}}</td>
                            <td>{{$pessoa->telefone}}</td>
                            <td>{{$pessoa->email}}</td>
                            <td>{{$pessoa->endereco}}</td>
                            <td class="">
                                <button title="Editar Imóvel" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#editCliente" wire:click='edit({{$pessoa->id}})'>
                                    <i class="fa fa-edit"></i>
                                </button>
                                <button title="Excluir Imóvel" class="btn btn-sm btn-danger" wire:click='delete({{$pessoa->id}})'>
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </td>
                        </tr>
                        @endforeach
                        @else
                        <tr class="alert alert-info bg-info">
                            <td colspan="14" class="text-light text-center">Nenhuma cliente encontrado</td>
                        </tr>
                        @endif
                    </tbody>
                </table>
                <div>
                </div>
            </div>
        </div>
        <div class="card-footer">
            {{$pessoas->links('pagination::simple-bootstrap-5')}}
        </div>
  
     

    
    @include('includes.alerts')
    @include('modals.pessoa.addPessoa')
    @include('modals.pessoa.editPessoa')

    </div>
    </div>

