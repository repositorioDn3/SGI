
 <!-- Modal  Adicionar Departamento-->
 <div wire:ignore.self class="modal fade" data-backdrop="static" id="galeria" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">
            <i class="fa fa-images"></i>
            Galeria de Fotos
          </h5>
          <button type="button" class="close" wire:click='resetInputs' data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">

           
            <div class=" col-md-12 col-sm-12  d-flex justify-content-center align-items-center flex-wrap" >
                @if($fotos->count() > 0)
                @foreach ($fotos as $item)
                <div class="col-md-4 mt-3" >
                    <img src="{{asset('storage/imagens/'.$item->imagem)}}"  style="width: 22rem;height: 22rem;" class="rounded img-fluid">
                    <span title="Excluir" wire:click='excluirFoto({{$item->id}})' class="badge badge-danger navbar-badge" style="margin-top: -.5rem; cursor: pointer;">
                        <i class="fa fa-times fa-2x"></i>
                    </span>
                </div>
                @endforeach
                @else
                <p class="text-cente font-weight-bold text-lg">
                    Nenhuma imagem na galeria
                </p>
                @endif
            </div>   
               
        </div>
       <div class="card-footer">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="exampleInputFile">Adicionar Imagens </label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" wire:model='addfoto' class="custom-file-input" id="exampleInputFile" multiple>
                        <label class="custom-file-label" for="exampleInputFile" >Selecionar Imagem</label>
                    </div>
                    <div class="input-group-append">
                        <button wire:click='adicionarFotoNaGaleria' class="input-group-text btn btn-sm btn-info font-weight-bold" style="cursor: pointer">Salvar</button>
                    </div>
                </div>
                @error('addfoto') <span class="text-danger">{{$message}}</span>@enderror
                </div>
            </div>
       </div>
      </div>
    </div>
  </div>