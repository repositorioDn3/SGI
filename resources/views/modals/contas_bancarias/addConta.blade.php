 <!-- Modal  Adicionar Departamento-->
 <div wire:ignore.self class="modal fade" id="addConta" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">
            Cadastrar Conta Bancaria
          </h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body" wire:submit.prevent='save'>
          <form wire:submit.prevent='save' enctype="multipart/form-data" class="col-md-12 d-flex justify-content-between align-items-center flex-wrap" >
            @csrf
            <div class="col-md-6">
                <label for="department">Banco:</label>
                <input type="text" wire:model="banco" id="banco" class="form-control"  placeholder="Digite a categoria">
                @error('banco')
                  <span class="text-danger">{{$message}}</span>
                @enderror
            </div>
            <div class="col-md-6">
                <label for="numero">Número da conta:</label>
                <input type="text" wire:model="numero" id="numero" class="form-control"  placeholder="Nº da conta">
                @error('numero')
                  <span class="text-danger">{{$message}}</span>
                @enderror
            </div>
            <div class="col-md-12">
                <label for="ibam">Ibam:</label>
                <input type="text" wire:model="ibam" id="ibam" class="form-control"  placeholder="Nº da conta">
                @error('ibam')
                  <span class="text-danger">{{$message}}</span>
                @enderror
            </div>





        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-info">
            <i class="fa fa-save"></i>
            Salvar
          </button>
        </form>
        </div>
      </div>
    </div>
  </div>
