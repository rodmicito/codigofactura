<?php require "Views/Templates/header.php"; ?>
<div class="card">
    <div class="card-header">
        <div class="card-title">Medidas</div>
    </div>
    <div class="card-body">
        <button class="btn btn-success" type="button" onclick="frmMedida()"><i class="fas fa-plus"></i> Nueva medida</button>
        <table class="table" id="tblMedidas">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Medida</th>
                    <th>Abreviatura</th>   
                    <th>U. med. SIN</th>               
                    <th>Estado</th>
                    <th></th>
                </tr>
            </thead>
        </table>
    </div>
</div>

<div class="modal fade" id="medidaModal" tabindex="-1" role="dialog" aria-labelledby="medidaModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="title">Nueva medida</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="frmMedida">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="descripcion_medida" class="col-form-label">Unidad de medida:</label>
                        <input type="hidden" id="id_medida" name="id_medida">
                        <input type="text" class="form-control" id="descripcion_medida" name="descripcion_medida">
                    </div>
                    <div class="form-group">
                        <label for="descripcion_corta" class="col-form-label">Abreviatura:</label>
                        <input type="text" class="form-control" id="descripcion_corta" name="descripcion_corta">
                    </div>
                    <div class="form-group">
                        <label for="medidaSin" class="col-form-label">U. medida SIN:</label>
                        <input type="number" class="form-control" id="medidaSin" name="medidaSin">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary" onclick="registroMedida(event)" id="btnAccion">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php require "Views/Templates/footer.php"; ?>