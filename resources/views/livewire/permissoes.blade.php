<div class="col-md-12 mt-3">
    <div class="card col-md-12 mt-3">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center flex-wrap">
             <h5 class="font-weight-bold">PERMISSÕES DE UTILIZADOR</h5>
            </div>
        </div>
        <div class="card-body">
            <div class="col-md-12 d-flex justify-content-center align-items-center flex-wrap">
                <div class="col-md-6">
                    <label for="search_user">Pesquisar Utilizador</label>
                    <input type="search" wire:model="search_user" id="search_user" class="form-control" placeholder="Pesquisar Utilizador">
                </div>
                <div class="col-md-6">
                    <label for="search_user">Selecionar Utilizador</label>
                    <select wire:model='utilizador' id="utilizador" class="form-control">
                       
                        <option value="">Selecionar</option>
                        @foreach ($utilizadores as $item)
                        <option value="{{$item->id}}">{{$item->name}}</option>
                        @endforeach
                    </select>
                </div>
                <hr>
                <div class="col-md-12 mt-5">
               
                    <div class="form-check d-flex text-md col-md-4">
                        <input class="form-check-input" type="checkbox" id="gridCheck">
                        <label class="form-check-label" for="gridCheck">
                          Cadastrar Imóvel
                        </label>
                      </div>
                    <div class="form-check d-flex text-md col-md-4">
                        <input class="form-check-input" type="checkbox" id="gridCheck">
                        <label class="form-check-label" for="gridCheck">
                          Cadastrar Imóvel
                        </label>
                      </div>
                  
                </div>
            </div>
         </div>
</div>
</div>

