<div class="col-md-12 mt-3">
    <div class="card col-md-12 mt-3">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center flex-wrap">
             <h5 class="font-weight-bold">UTILIZADORES DO SISTEMA</h5>
              <button class=" btn btn-sm btn-info" data-toggle="modal" data-target="#addUtilizador">
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
                <table class="table table-striped table-hover text-center">
                    <thead class="table-secondary col-md-12 table-secondary ">
                        <tr>
                            <th>#</th>
                            <th>Foto</th>
                            <th>Nome</th>
                            <th>E-mail</th>
                            <th>Phone</th>
                            <th>Funcão</th>
                            <th>Ação</th>
                        </tr>
                    </thead>
                    <tbody class="cursor-pointer">
                      @if ($utilizadores->count() > 0)
                        @foreach ($utilizadores as $utilizador)
                        <tr>
                            <td>{{$utilizador->id}}</td>
                            <td>
                                <img src="{{($utilizador->photo != '')? asset('storage/utilizadores/'.$utilizador->photo) : 'no-image.gif'}}" alt="" style="width: 5rem;height: 5rem" class="shadow rounded">
                            </td>
                            <td>{{$utilizador->name ?? 'Indisponível'}}</td>
                            <td>{{$utilizador->email ?? 'Indisponível'}}</td>
                            <td>{{$utilizador->phone  ?? 'Indisponível'}}</td>
                            <td>{{$utilizador->position ?? 'Indisponível'}}</td>
                            <td class="">
                                <button title="Editar Imóvel" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#editUtilizador" wire:click='edit({{$utilizador->id}})'>
                                    <i class="fa fa-edit"></i>
                                </button>
                                <button title="Excluir Imóvel" class="btn btn-sm btn-danger" onclick='confirm({{$utilizador->id}})'>
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </td>
                        </tr>
                        @endforeach
                        @else
                        <tr class="alert alert-info bg-info">
                            <td colspan="14" class="text-light text-center">Nenhuma categoria encontrada</td>
                        </tr>
                        @endif
                    </tbody>
                </table>
                <div>
                </div>
            </div>
        </div>
        <div class="card-footer">
            {{$utilizadores->links('pagination::simple-bootstrap-5')}}
        </div>
  
     

    
       
        {{-- @include('includes.alerts') --}}
        @include('modals.utilizadores.addUtilizador')
        @include('modals.utilizadores.editUtilizador')

    </div>
    </div>

    <script>
    window.addEventListener('DOMContentLoaded',function(){
        window.addEventListener('users_modal_hide',event=>{
        $('#editUtilizador').modal('hide')
        })

        //Confirme 

        function confirm(id){
            swal({
                title:'Confirmar',
                text:'Deseja realmente excluir esse registro',
                type:'Warning',
                ShowCancelButton:true,
                CancelButtonText:'NÃO',
                CancelButtonColor:'#c82333',
                ConfirmButtonColor:'#0069d9',
                ConfirmButtonText:'OK',
            }).then((result)=>{
                if(result.value){
                    window.livewire.emit('deleteRow',id)
                    swal.close()
                }
            })
        }


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
    })
    </script>

