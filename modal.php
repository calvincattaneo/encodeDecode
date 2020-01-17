<!-- Modal -->
<div class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <form name="form" id="form" method="post">
        <input type="hidden" name="id" id="id" value="">
        <input type="hidden" name="tipo_option" id="tipo_option" value="">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title"></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="form-group">
              <label for="option">Title</label>
              <textarea class="form-control" id="option" disabled></textarea>
            </div>
            <div class="form-group">
              <label for="convert">Convertido</label>
              <textarea class="form-control" id="convert" disabled></textarea>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
            <button type="submit" class="btn btn-primary">Salvar</button>
          </div>
        </div>
      </form>
    </div>
  </div>