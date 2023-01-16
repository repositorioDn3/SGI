 <!-- Modal  Adicionar Departamento-->
 <div wire:ignore.self class="modal fade" id="editCliente" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">
            Actualizar Cliente
          </h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body" wire:submit.prevent='save'>
          <form wire:submit.prevent='update' enctype="multipart/form-data" class="col-md-12 d-flex justify-content-between align-items-center flex-wrap" >
            @csrf
            <div class="col-md-6">
                <label for="department">Nome / Empresa:</label>
                <input type="text" wire:model="nome" id="nome" class="form-control"  placeholder="Digite nome do cliente">
                @error('nome')
                  <span class="text-danger">{{$message}}</span>
                @enderror
            </div>
            <div class="col-md-6">
              <label for="preco">Tipo de Pessoa:</label>
              <select wire:model="tipo_pessoa" id="tipo_pessoa" class="form-control">
                <option value="" selected>selecionar</option>
                <option value="Física">Física </option>
                <option value="Jurídica">Jurídica</option>
              </select>
              @error('tipo_pessoa')
              <span class="text-danger">{{$message}}</span>
              @enderror
            </div>
            <div class="col-md-6">
                <label for="telefone">Telefone:</label>
                <input type="tel" wire:model="telefone" onkeypress="$(this).mask('999-999-999')" id="telefone" class="form-control"  placeholder="exe. 999-999-999">
                @error('telefone')
                  <span class="text-danger">{{$message}}</span>
                @enderror
            </div>
            <div class="col-md-6">
                <label for="department">E-mail:</label>
                <input type="email" wire:model="email"  id="email" class="form-control"  placeholder="exe@gmail.com">
                @error('email')
                  <span class="text-danger">{{$message}}</span>
                @enderror
            </div>
            <div class="col-md-6">
                <label for="department">NIF:</label>
                <input type="text" wire:model="nif"  id="nif" class="form-control"  placeholder="Digite o NIF">
                @error('nif')
                  <span class="text-danger">{{$message}}</span>
                @enderror
            </div>
            <div class="col-md-6">
                <label for="department">Endereço:</label>
                <input type="text" wire:model="endereco"  id="endereco" class="form-control"  placeholder="exe. bairro, rua, casa">
                @error('endereco')
                  <span class="text-danger">{{$message}}</span>
                @enderror
            </div>
            <input type="hidden" wire:model='pessoa_id'>
          
      
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