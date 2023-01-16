 <!-- Modal  Adicionar Departamento-->
 <div wire:ignore.self class="modal fade" id="addCategoria" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog " role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">
            Cadastrar Tipologia
          </h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body" wire:submit.prevent='save'>
          <form wire:submit.prevent='save' enctype="multipart/form-data" class="col-md-12 d-flex justify-content-between align-items-center flex-wrap" >
            @csrf
            <div class="col-md-12">
                <label for="department">Tipologia:</label>
                <input type="text" wire:model="nome" id="nome" class="form-control"  placeholder="Digite a categoria">
                @error('nome')
                  <span class="text-danger">{{$message}}</span>
                @enderror
            </div>
           
            <div class="col-md-12">
                <label for="preco">Descrição:</label>
                <textarea wire:model="descricao" id="" cols="30" rows="3" class="form-control" placeholder="Digite a descrição" style="resize: none"></textarea>
                @error('descricao')
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