<?php require "Views/Templates/header.php"; ?>
<div class="card">
    <div class="card-header">
        <div class="card-title">USUARIOS</div>
    </div>
    <div class="card-body">
        <button class="btn btn-success" type="button" onclick="frmUsuario()"><i class="fas fa-plus"></i> Nuevo usuario</button>
        <table class="table" id="tblUsuarios">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nick</th>
                    <th>Nombre</th>
                    <th>Caja</th>
                    <th>Estado</th>
                    <th></th>
                </tr>
            </thead>
        </table>
    </div>
</div>

<div class="modal fade" id="usuarioModal" tabindex="-1" role="dialog" aria-labelledby="usuarioModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="title">Nuevo usuario</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="frmUsuario">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nick" class="col-form-label">Nick:</label>
                        <input type="hidden" id="id_usuario" name="id_usuario">
                        <input type="text" class="form-control" id="nick" name="nick">
                    </div>
                    <div class="form-group">
                        <label for="nombre" class="col-form-label">Nombre:</label>
                        <input type="text" class="form-control" id="nombre" name="nombre">
                    </div>
                    <div class="row" id="claves">
                        <div class="form-group col-md-6">
                            <label for="clave" class="col-form-label">Clave:</label>
                            <input type="password" class="form-control" id="clave" name="clave">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="confirmar" class="col-form-label">Confirmar clave:</label>
                            <input type="password" class="form-control" id="confirmar" name="confirmar">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="id_caja" class="col-form-label">Caja:</label>
                        <select name="id_caja" id="id_caja" class="form-control">
                            <?php foreach ($data['cajas'] as $c) { ?>
                                <option value="<?= $c['id_caja'] ?>"><?= $c['caja'] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary" onclick="registroUsuario(event)" id="btnAccion">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php require "Views/Templates/footer.php"; ?>