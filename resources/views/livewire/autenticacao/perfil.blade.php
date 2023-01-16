<div class="col-md-12 mt-4">
    <div class="card">
      <div class="card-header p-2">
          <span class="h4 font-weight-bold d-flex justify-content-start align-items-center">
            <i class="fas fa-user-cog"></i>
            MINHA CONTA
        </span>
      </div><!-- /.card-header -->
      <div class="card-body">
        <div class="col-md-12 d-flex justify-content-center align-items-center">
            <label for="photo">
                <img title="Clicar para selecionar foto" src="{{($photo != null) ? asset('storage/utilizadores/'.auth()->user()->photo) : asset('no-image.gif')}}" class="img-fluid rounded border-info " style="width: 8rem; height:8rem; border:1px solid; cursor: pointer;">
                <button wire:click='upload_foto_perfil' class="btn btn-sm btn-info  " title="clicar para salvar foto" style="margin-top:6rem">
                    <i class="fa fa-save"></i>
                </button>
            </label>
            <input type="file" wire:model="photo"  id="photo" style="display: none">


        </div>
        <p class="h4">Dados da Conta</p>
        <hr>
        <div class="row">
            <div class="col-md-12 d-flex justify-content-center align-items-center flex-wrap">
                <div class="col-md-6">
                    <label for="name">Nome:</label>
                    <input type="text" wire:model="name" id="" class="form-control" placeholder="">
                    @error('name')
                        <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                <div class="col-md-6">
                    <label for="email">E-mail:</label>
                    <input type="email" wire:model="email" id="" class="form-control" placeholder="">
                    @error('email')
                        <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                <div class="col-md-6">
                    <label for="phone">Telefone:</label>
                    <input type="text" wire:model="phone" id="phone" onkeypress="$(this).mask('999-999-999')" class="form-control" placeholder="">
                    @error('phone')
                        <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                <div class="col-md-6">
                    <label for="position">Função:</label>
                    <input type="text" wire:model="position" disabled id="position"  class="form-control" placeholder="">
                </div>
            </div>
            <div class="col-md-12 d-flex justify-content-end align-items-center">
                <button type="button" class=" btn btn-sm btn-info mt-2" style="margin-right: .5rem" wire:click='update_dados_do_perfil'>
                    <div class="fa fa-save"></div>
                    Salvar
                </button>
            </div>
        </div>
        <hr>
        <p class="h4">Actualizar senha</p>
        <hr>
        <div class="row">
            <div class="col-md-12 d-flex justify-content-center align-items-center flex-wrap">
                <div class="col-md-4">
                    <label for="name">Senha actual:</label>
                    <input type="password" wire:model="senha_actual" id="" class="form-control" placeholder="******">
                    @error('senha_actual')
                        <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                <div class="col-md-4">
                    <label for="name">Nova senha:</label>
                    <input type="password" wire:model="nova_senha" id="" class="form-control" placeholder="******">
                    @error('nova_senha')
                        <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                <div class="col-md-4">
                    <label for="name">Confirmar senha:</label>
                    <input type="password" wire:model="confirmar_senha" id="" class="form-control" placeholder="******">
                    @error('confirmar_senha')
                        <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
            </div>
            <div class="col-md-12 d-flex justify-content-end align-items-center">
                <button type="button" class=" btn btn-sm btn-info mt-2" style="margin-right: .5rem" wire:click='update_senha_do_utilizador'>
                    <div class="fa fa-save"></div>
                    Salvar
                </button>
            </div>
        </div>
        </div>
      
      </div>
    </div>
  </div>



  <script>
    //Mensagem de sucesso
    window.addEventListener('success',event=>{
      const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 1500
              });
              
              Toast.fire({
                icon: 'success',
                title: event.detail.message
              })
    })
    //Mensagem de erro
    window.addEventListener('error',event=>{
      const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 1500
              });
              
              Toast.fire({
                icon: 'error',
                title: event.detail.message
              })
    })
    //Mensagem de aviso
    window.addEventListener('warning',event=>{
      const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 1500
              });
              
              Toast.fire({
                icon: 'error',
                title: event.detail.message
              })
    })

    window.addEventListener('reload',event=>{

       window.hr
    })
 
  </script>
