

  <!-- Modal -->
  <div wire:ignore.self class="modal fade"  data-backdrop="static" id="confirmContas" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Excluir Estudante</h5>
          <button wire:click='resetInputs' type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p class="h4">Tem a certeza que deseja excluir esta conta bancaria?</p>
          <p class="font-weight-bold">Não pode reverter está ação.</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal" wire:click='resetInputs' >NÃO <i class="fa fa-times"></i></button>
          <button type="button" class="btn btn-sm btn-success" wire:click='delete'>SIM <i class="fa fa-check"></i></button>
        </div>
      </div>
    </div>
  </div>
