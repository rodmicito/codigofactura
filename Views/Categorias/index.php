<?php require "Views/Templates/header.php"; ?>
<div class="card">
    <div class="card-header">
        <div class="card-title">Categorias</div>
    </div>
    <div class="card-body">
        <button class="btn btn-success" type="button" onclick="frmCategoria()"><i class="fas fa-plus"></i> Nueva categoria</button>
        <table class="table" id="tblCategorias">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Categoría</th>
                    <th>Código SIN</th>                  
                    <th>Estado</th>
                    <th></th>
                </tr>
            </thead>
        </table>
    </div>
</div>

<div class="modal fade" id="categoriaModal" tabindex="-1" role="dialog" aria-labelledby="categoriaModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="title">Nueva categoria</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="frmCategoria">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nombre_categoria" class="col-form-label">Categoría:</label>
                        <input type="hidden" id="id_categoria" name="id_categoria">
                        <input type="text" class="form-control" id="nombre_categoria" name="nombre_categoria">
                    </div>
                    <div class="form-group">
                        <label for="codigoProductoSin" class="col-form-label">Código SIN:</label>
                        <input type="number" class="form-control" id="codigoProductoSin" name="codigoProductoSin">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary" onclick="registroCategoria(event)" id="btnAccion">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php require "Views/Templates/footer.php"; ?>