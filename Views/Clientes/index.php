<?php require "Views/Templates/header.php"; ?>
<div class="card">
    <div class="card-header">
        <div class="card-title">Clientes</div>
    </div>
    <div class="card-body">
        <button class="btn btn-success" type="button" onclick="frmCliente()"><i class="fas fa-plus"></i> Nuevo cliente</button>
        <table class="table" id="tblClientes">
            <thead>
                <tr>
                    <th>Razón social</th>
                    <th>NIT/CI</th>
                    <th>Complemento</th>
                    <th>Tipo documento</th>
                    <th>Correo electrónico</th>                    
                    <th>Estado</th>
                    <th></th>
                </tr>
            </thead>
        </table>
    </div>
</div>

<div class="modal fade" id="clienteModal" tabindex="-1" role="dialog" aria-labelledby="clienteModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="title">Nuevo cliente</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="frmCliente">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="razon_social" class="col-form-label">Razón social:</label>
                        <input type="hidden" id="id_cliente" name="id_cliente">
                        <input type="text" class="form-control" id="razon_social" name="razon_social">
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="documentoid" class="col-form-label">NIT/CI:</label>
                                <input type="text" class="form-control" id="documentoid" name="documentoid">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="complementoid" class="col-form-label">Complemento:</label>
                                <input type="text" class="form-control" id="complementoid" name="complementoid">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="tipo_documento" class="col-form-label">Tipo documento:</label>
                        <select name="tipo_documento" id="tipo_documento" class="form-control">
                            <option value="1">CI</option>
                            <option value="5">NIT</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="cliente_email" class="col-form-label">Correo electrónico:</label>
                        <input type="email" class="form-control" id="cliente_email" name="cliente_email">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary" onclick="registroCliente(event)" id="btnAccion">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php require "Views/Templates/footer.php"; ?>