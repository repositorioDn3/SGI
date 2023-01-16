 <!-- Modal  Adicionar Departamento-->
 <div wire:ignore.self class="modal fade" data-backdrop="static" id="editImovel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">
            Actualizar Imóvel
          </h5>
          <button type="button" wire:click='resetInputs' class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body" >
          <form wire:submit.prevent='update' enctype="multipart/form-data" class="col-md-12 d-flex justify-content-between align-items-center flex-wrap" >
            @csrf
            <div class="col-md-6">
                <label for="department">Categorias:</label>
                <select wire:model='categoria' id="categorias" class="form-control">
                  <option value="" selected> Selecionar</option>
                  @foreach ($categorias as $categoria)
                  <option value="{{$categoria->id}}">{{$categoria->nome}}</option>
                  @endforeach
                </select>
                @error('categoria')
                  <span class="text-danger">{{$message}}</span>
                @enderror
            </div>
            <div class="col-md-6">
              <label for="preco">Quantidade:</label>
            <input type="number" wire:model="quantidade" id="quantidade" class="form-control" min="0" placeholder="0,00">
              @error('quantidade')
                <span class="text-danger">{{$message}}</span>
              @enderror
          </div>
            <div class="col-md-4">
                <label for="preco_inicial">Preço inicial:</label>
              <input type="number" wire:model="preco_inicial" id="preco_inicial" class="form-control" min="0" placeholder="0,00">
                @error('preco_inicial')
                  <span class="text-danger">{{$message}}</span>
                @enderror
            </div>
          
            <div class="col-md-4">
                <label for="preco_final">Preço final:</label>
              <input type="number"  wire:model="preco_final" id="preco_final" class="form-control" min="0" placeholder="0,00">
                @error('preco_final')
                  <span class="text-danger">{{$message}}</span>
                @enderror
            </div>
            <div class="col-md-4">
              <label for="preco_total">Preço total:</label>
            <input type="number" wire:model="preco_total" id="preco_inicial" class="form-control" min="0" placeholder="0,00">
              @error('preco_total')
                <span class="text-danger">{{$message}}</span>
              @enderror
          </div>
            <div class="col-md-6">
              <label for="area_total">Área total:</label>
              <input type="text" wire:model="area_total" id="area_total" class="form-control"  placeholder="Inform a área total ">
              @error('area_total')
                <span class="text-danger">{{$message}}</span>
              @enderror
          </div>
          <div class="col-md-6">
              <label for="area_construida">Área construida:</label>
              <input type="text" wire:model="area_construida" id="area_construida" class="form-control"  placeholder="Inform a área construida">
              @error('area_construida')
                <span class="text-danger">{{$message}}</span>
              @enderror
          </div>
          <input type="hidden" wire:model="imovel_id">
            <div class="col-md-12 mt-3">
                <label for="preco">Descrição:</label>
                <textarea wire:model="descricao" id="descricao" cols="30" rows="5" class="form-control" placeholder="Descreve o imóvel" style="resize: none"></textarea>
                @error('descricao')
                  <span class="text-danger">{{$message}}</span>
                @enderror
            </div>
      
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-info">
            <i class="fa fa-save"></i>
            Actualizar
          </button>
        </form>
        </div>
      </div>
    </div>
  </div>