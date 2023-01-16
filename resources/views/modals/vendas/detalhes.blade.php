 <!-- Modal  Adicionar Departamento-->
 <div wire:ignore.self class="modal fade" id="detalhes" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">
            Detalhes da venda
          </h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
           <div class="table-responsive">
            <table class="table table-striped table-hover text-center">
                <thead>
                    <tr>
                        <th>Preço</th>
                        <th>Quantidade</th>
                        <th>Subtotal</th>
                        <th>Taxa</th>
                        <th>Desconto</th>
                        <th>Divida</th>
                        <th>Prazo de Entrega</th>
                    </tr>
                </thead>
                <tbody class="font-weight-bold">
                    @if (isset($detalhes) && count($detalhes) > 0)
                    @foreach ($detalhes as $item)
                        <tr>
                            <td>{{number_format($item->preco,2,',','.')}} AKZ</td>
                            <td>{{number_format($item->quantidade,2,',','.')}}</td>
                            <td>{{number_format($item->subtotal,2,',','.')}} AKZ</td>
                            <td>{{$item->taxa}}</td>
                            <td>{{($item->desconto > 0) ? $item->desconto .' AKZ':'0.00'}}</td>
                            <td class=" {{($item->divida > 0) ? 'bg-danger text-light':'bg-success text-light'}}"
                                >{{($item->divida  != 0) ? $item->divida .' AKZ':'Sem divida'}}</td>
                            <td>{{$item->prazo_entrega}}</td>
                            @if($item->divida > 0)
                            <td class="bg-info">
                                <button data-toggle="modal" data-target="#liquidar_divida" class=" btn btn-sm btn-info font-weight-bold" wire:click='encontrar({{$item->id}})'>
                                    <i class="fa fa-hand-holding-usd"></i>
                                    Liquidar
                                </button>
                            </td>
                            @endif
                        </tr>
                    @endforeach
                    @else
                    <tr class="alert alert-info bg-info">
                        <td colspan="14" class="text-light text-center">Detalhes de venda não encontrados</td>
                    </tr>
                    @endif

                </tbody>
            </table>
           </div>



        </div>
      </div>
    </div>
  </div>
