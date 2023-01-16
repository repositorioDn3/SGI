

  <!-- Modal -->
  <div wire:ignore.self   data-backdrop="static" class="modal fade" id="confirm_nullable" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Anular Venda</h5>
          <button wire:click='resetAllInputes' type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p class="h4">Tem a certeza que deseja anular esta venda?</p>
          <p class="font-weight-bold">Não pode reverter está ação.</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal"  >NÃO <i class="fa fa-times"></i></button>
          <button type="button" class="btn btn-success"  wire:click='anular({{$id_venda}})'>SIM <i class="fa fa-check"></i></button>
        </div>
      </div>
    </div>
  </div>
