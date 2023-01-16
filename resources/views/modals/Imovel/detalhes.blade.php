 <!-- Modal  Adicionar Departamento-->
 <div wire:ignore.self class="modal fade" data-backdrop="static" id="detalhes" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">
            Detalhes do Imóvel
          </h5>
          <button type="button" wire:click='resetInputs' class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body" >
         <div class="d-flex justify-content-center align-items-center flex-column flex-wrap">
            <div class="col-md-12 border-info" style="border-bottom: 5px solid">
              <h4 class="font-weight-bold">Descrição</h4>
              <p class="text-justify">
                {{$descricao ?? 'Nenhuma descrição'}}
              </p>
            </div>
            <div class="col-md-12 d-flex justify-content-between align-items-center mt-2">
              <h4><span class="font-weight-bold">Área total:</span> {{$area_total}}</h4>
              <h4><span class="font-weight-bold">Área construida:</span> {{$area_construida}}</h4>
            </div>
         </div>
        </div>
      </div>
    </div>
  </div>

