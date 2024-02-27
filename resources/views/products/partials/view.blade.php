<div class="modal fade" id="modal-view-product">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div class="modal-header bg-primary">
          <h4 class="modal-title">Información del producto</h4>
          <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="row">
                <input type="hidden" name="id" id="id">
                <div class="col-md-3">
                    <h4 class="mb-3">SKU</h4>
                    <h4 class="mb-3">Nombre</h4>
                    <h4 class="mb-3">Categoría</h4>
                    <h4 class="mb-3">Cantidad en Stock</h4>
                    <h4 class="mb-3">Precio de Compra</h4>
                    <h4 class="mb-3">Precio de Venta</h4>
                    <h4 class="mb-3">Estado</h4>
                    <h4 class="mb-3">Descripción</h4>
                </div>
                <div class="col-md-5">
                    <div class="col-md-12">
                        <input type="text" class="form-control mb-2" name="sku" id="sku" readonly>
                        <input type="text" class="form-control mb-2" name="name" id="name" readonly>
                        <input type="text" class="form-control mb-2" name="category_id" id="category_id" readonly>
                        <input type="text" class="form-control mb-2" name="quantity" id="quantity" readonly>
                        <input type="text" class="form-control mb-2" name="cost" id="cost" readonly>
                        <input type="text" class="form-control mb-2" name="price" id="price" readonly>
                        <input type="text" class="form-control mb-2" name="status" id="status" readonly>
                        <textarea class="form-control mb-2" name="description" id="description" rows="3" readonly></textarea>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label class="form-label" for="image">Imagen</label>
                        <img id="image" class="img-fluid pad rounded border d-block" src="{{ asset('img/AdminLTELogo.png') }}" alt="" width="350">
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-success" data-dismiss="modal">Cerrar</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
