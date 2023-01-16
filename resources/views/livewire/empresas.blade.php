
<div class="col-md-12 mt-3">
    <div class="card col-md-12 mt-3">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center flex-wrap">
             <h5 class="font-weight-bold">DADOS DA EMPRESA</h5>
            </div>
        </div>
        <div class="card-body">
            <form wire:submit.prevent='save' method="post" enctype="multipart/form-data">
            <div class="col-md-12 d-flex justify-content-center align-items-center flex-wrap">
                    @csrf
                    @method('POST')
                <div class="col-md-2">
                    <label for="logotipo">
                        @if ($nome_logo !='')
                        <img class=" rounded shadow border-info" src="{{asset('storage/logotipo/'.$nome_logo)}}" alt="logotipo da empresa" style="width: 8rem; height:8rem; border:1px solid">
                        @else
                        <img class=" rounded shadow border-info" src="{{($logotipo)? $logotipo->temporaryUrl(): 'no-image.gif'}}" alt="logotipo da empresa" style="width: 8rem; height:8rem; border:1px solid">
                        @endif
                    </label>
                    <input type="file" wire:model="logotipo" id="logotipo" class="d-none">
                </div>
                <div class="col-md-10">
                    <label for="nome">Denominação:</label>
                    <input type="text" wire:model="nome" id="nome" class="form-control" placeholder="Nome da empresa">
                    @error('nome') <span class="text-danger">{{$message}}</span> @enderror

                </div>
                <div class="col-md-6">
                    <label for="nif">NIF:</label>
                    <input type="text" wire:model="nif" id="nif" class="form-control" placeholder="Nº de Identificação Fiscal">
                    @error('nif') <span class="text-danger">{{$message}}</span> @enderror
                </div>
                <div class="col-md-6">
                    <label for="regime">Regime:</label>
                    <select wire:model="regime" id="regime" class="form-control">
                        <option value="" >Selecionar</option>
                        <option value="Exclusão" >Exclusão</option>
                        <option value="Geral">Geral</option>
                        <option value="Simplificado">Simplificado</option>
                    </select>
                    @error('regime') <span class="text-danger">{{$message}}</span> @enderror
                </div>
                <div class="col-md-6">
                    <label for="province">Provincia:</label>
                    <select wire:model='province'   wire:change='ShowMunicipality' id="province" class="form-control @error('province') is-invalid @enderror"  maxlength="255">
                        <option value="" >Selecionar</option>
                        @foreach ($provinces as $item)
                            <option  value="{{$item->id}}">{{$item->name}}</option>
                        @endforeach
                    </select>
                    @error('province') <span class="text-danger">{{$message}}</span> @enderror
                </div>
                <div class="col-md-6">
                    <label for="municipality">Município:</label>
                    <select wire:model.defer="municipality" id="municipality" class="form-control @error('municipality') is-invalid @enderror"  maxlength="255">
                        <option value="" >Selecionar</option>
                        @if($municipalities)
                         @foreach ($municipalities as $item)
                         <option  value="{{$item->name}}">{{$item->name}}</option>
                         @endforeach
                         @endif
                         <option  value="{{$municipio ?? ''}}" selected>{{$municipio ?? ''}}</option>
                    </select>
                    @error('municipality') <span class="text-danger">{{$message}}</span> @enderror
                </div>
                <div class="col-md-12">
                    <label for="detalhes_localizacao">Outras indicações:</label>
                    <input type="text" wire:model="detalhes_localizacao" id="detalhes_localizacao" class="form-control" placeholder="Detalhe a localização da empresa">
                    @error('detalhes_localizacao') <span class="text-danger">{{$message}}</span> @enderror

                </div>
                <div class="col-md-6">
                    <label for="telefone">Telefone:</label>
                    <input type="tel" wire:model="telefone" id="telefone" onkeypress="$(this).mask('999-999-999')" class="form-control" placeholder="exe. 999-999-999">
                    @error('telefone') <span class="text-danger">{{$message}}</span> @enderror

                </div>
                <div class="col-md-6">
                    <label for="telefone">Telefone alternativo:</label>
                    <input type="tel" wire:model="telefone_alternativo" id="telefone_alternativo" onkeypress="$(this).mask('999-999-999')" class="form-control" placeholder="exe. 999-999-999">
                    @error('telefone_alternativo') <span class="text-danger">{{$message}}</span> @enderror

                </div>
                <div class="col-md-6">
                    <label for="email">E-mail:</label>
                    <input type="text" wire:model="email" id="email" class="form-control" placeholder="exe@gmail.com">
                    @error('email') <span class="text-danger">{{$message}}</span> @enderror

                </div>
                <div class="col-md-6">
                    <label for="telefone">website:</label>
                    <input type="text" wire:model="website" id="website" class="form-control" placeholder="www.exemplo.com">
                    @error('website') <span class="text-danger">{{$message}}</span> @enderror

                </div>
            </div>
        </div>
        <div class="card-footer d-flex justify-content-end align-items-center">
                <button type="button" wire:click='edit' class="btn btn-md btn-info">
                    <i class="fa fa-edit"></i>
                    Editar
                </button>
                <button type="submit" class="btn btn-md btn-info mx-2">
                    <i class="fa fa-save"></i>
                    Salvar
                </button>
        </div>
    </form>
    </div>




