 <!-- Modal  Adicionar Departamento-->
 <div wire:ignore.self class="modal fade" id="editUtilizador"  tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">
            Actualizar Utilizador
          </h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form wire:submit.prevent='update' enctype="multipart/form-data" class="col-md-12 d-flex justify-content-between align-items-center flex-wrap" >
            @csrf
            <div class="col-md-12 d-flex justify-content-center align-items-center flex-wrap">
              
              <div class="col-md-6">
                <label for="">Nome:</label>
                <input type="text" wire:model='name' class="form-control" placeholder="Nome do utilizador">
                @error('name')
                  <span class="text-danger">{{$message}}</span>
                @enderror
              </div>
              <div class="col-md-6">
                <label for="">E-mail:</label>
                <input type="email" wire:model='email' class="form-control" placeholder="exe@gmail.com">
                @error('email')
                  <span class="text-danger">{{$message}}</span>
                @enderror
              </div>
              <div class="col-md-6">
                <label for="">Telefone:</label>
                <input type="phone" wire:model='phone' class="form-control" onkeypress="$(this).mask('999-999-999') " placeholder="exe. 999-999-999">
                @error('phone')
                  <span class="text-danger">{{$message}}</span>
                @enderror
              </div>
              <div class="col-md-6">
                <label for="">Função:</label>
                <input type="text" wire:model='position' class="form-control"  placeholder="Funcão do utilizador">
                @error('position')
                  <span class="text-danger">{{$message}}</span>
                @enderror
              </div>
              <input type="hidden" wire:model="utilizador_id" id="utilizador_id">
          
         
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