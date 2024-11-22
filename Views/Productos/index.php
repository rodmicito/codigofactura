<?php require "Views/Templates/header.php"; ?>
<div class="card">
    <div class="card-header">
        <div class="card-title">Productos</div>
    </div>
    <div class="card-body">
        <button class="btn btn-success" type="button" onclick="frmProducto()"><i class="fas fa-plus"></i> Nuevo producto</button>
        <table class="table" id="tblProductos">
            <thead>
                <tr>
                    <th>Código</th>
                    <th>Producto</th>
                    <th>Código SIN</th>
                    <th>Categoría</th>
                    <th>U. medida</th>
                    <th>Cantidad</th>
                    <th>Costo</th>
                    <th>Precio</th>
                    <th>Estado</th>
                    <th></th>
                </tr>
            </thead>
        </table>
    </div>
</div>

<div class="modal fade" id="productoModal" tabindex="-1" role="dialog" aria-labelledby="productoModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="title">Nuevo producto</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="frmProducto">
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group col-md-3">
                            <label for="codigo" class="col-form-label">Código:</label>
                            <input type="hidden" id="id_producto" name="id_producto">
                            <input type="text" class="form-control" id="codigo" name="codigo">
                        </div>
                        <div class="form-group col-md-9">
                            <label for="nombre_producto" class="col-form-label">Producto:</label>
                            <input type="text" class="form-control" id="nombre_producto" name="nombre_producto">
                        </div>

                        <div class="form-group col-md-6">
                            <label for="costo_compra" class="col-form-label">Costo:</label>
                            <input type="number" step="0.01" class="form-control" id="costo_compra" name="costo_compra">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="precio_venta" class="col-form-label">Precio:</label>
                            <input type="number" step="0.01" class="form-control" id="precio_venta" name="precio_venta">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="cantidad" class="col-form-label">Cantidad:</label>
                            <input type="number" step="0.01" class="form-control" id="cantidad" name="cantidad">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="id_medida" class="col-form-label">U. Medida:</label>
                            <select name="id_medida" id="id_medida" class="form-control">
                                <?php foreach ($data['medidas'] as $c) { ?>
                                    <option value="<?= $c['id_medida'] ?>"><?= $c['descripcion_medida'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="id_categoria" class="col-form-label">Categoría:</label>
                        <select name="id_categoria" id="id_categoria" class="form-control">
                            <?php foreach ($data['categorias'] as $c) { ?>
                                <option value="<?= $c['id_categoria'] ?>"><?= $c['nombre_categoria'] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary" onclick="registroProducto(event)" id="btnAccion">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php require "Views/Templates/footer.php"; ?>