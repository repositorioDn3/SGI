
<div class="col-md-12 mt-3">
    <div class="card col-md-12 mt-3">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center flex-wrap">
             <h5 class="font-weight-bold">IMÓVEIS DISPONÍVEIS</h5>
              <button class=" btn btn-sm btn-info" data-toggle="modal" data-target="#addImovel">
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
                <table class="table table-striped table-hover text-center" >
                    <thead class="table-secondary col-md-12 table-secondary ">
                        <tr>
                            <th>#</th>
                            <th>Categoria</th>
                            <th>Quantidade</th>
                            <th>Preço total</th>
                            <th>Preço inicial</th>
                            <th>Preço final</th>
                           
                            <th>Opções</th>
                        </tr>
                    </thead>
                    <tbody class="cursor-pointer">
                      @if ($imoveis->count() > 0)
                        @foreach ($imoveis as $imovel)
                        <tr>
                            <td>{{$imovel->id}}</td>
                            <td>{{$imovel->categoria}}</td>
                            <td>{{number_format($imovel->quantidade,2,',','.')}}</td>
                            <td>{{number_format($imovel->preco_total,2,',','.')}} AKZS</td>
                            <td>{{number_format($imovel->preco_inicial,2,',','.')}} AKZS</td>
                            <td>{{number_format($imovel->preco_final,2,',','.')}} AKZS</td>
                            <td class="">
                                <button title="Galeria de Imagens do imóvel" class="btn btn-sm btn-primary" wire:click="galeria({{$imovel->id}})" data-toggle="modal" data-target="#galeria">
                                    <i class="fa fa-images"></i>
                                </button>
                                <button title="Editar Imóvel" class="btn btn-sm btn-info" data-toggle="modal" data-target="#editImovel" wire:click='edit({{$imovel->id}})'>
                                    <i class="fa fa-edit"></i>
                                </button>
                                <button title="Outras informações" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#detalhes" wire:click='edit({{$imovel->id}})'>
                                    <i class="fas fa-list"></i>
                                </button>
                                <button title="Excluir Imóvel" class="btn btn-sm btn-danger" wire:click='delete({{$imovel->id}})'>
                                    <i class="fas fa-times"></i>
                                </button>
                            </td>
                        </tr>
                        @endforeach
                        @else
                        <tr class="alert alert-info bg-info">
                            <td colspan="14" class="text-light text-center">Nenhum imóvel encontrado</td>
                        </tr>
                        @endif
                    </tbody>
                </table>
                </div>
            </div>
        </div>
        <div class="card-footer">
            {{$imoveis->links('pagination::bootstrap-5')}}
        </div>
        
            @include('includes.alerts')
            @include('modals.Imovel.addImovel')
            @include('modals.Imovel.editImovel')
            @include('modals.galeria.galeria')
            @include('modals.Imovel.detalhes')
    </div>



