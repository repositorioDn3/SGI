 <!-- Modal  Adicionar Departamento-->
 <div wire:ignore.self class="modal fade" id="liquidar_divida" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog " role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">
           Liquidar divida
          </h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form wire:submit.prevent='liquidar_divida' enctype="multipart/form-data" class="col-md-12 d-flex justify-content-between align-items-center flex-wrap" >
            @csrf
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
                <label for="preco">Tipo de Fatura:</label>
                <select wire:model="tipo_fatura" id="tipo_fatura" class="form-control ">
                  <option  selected>Selecionar</option>
                  <option value="a4">A4</option>
                  <option value="ticket"> RECIBO</option>
                </select>
                @error('tipo_pagamento')
                <span class="text-danger">{{$message}}</span>
                @enderror
              </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-info">
            <i class="fa fa-hand-holding-usd"></i>
            OK
          </button>

        </form>
        </div>
      </div>
    </div>
  </div>
