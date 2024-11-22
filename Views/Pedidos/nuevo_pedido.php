<?php require "Views/Templates/header.php"; ?>
<div class="card">
    <div class="card-header">
        <div class="card-title">Nuevo pedido</div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="form-group row col-md-9">
                <div class="form-group col-md-3">
                    <label for="nrofactura">Nro. Factura</label>
                    <input type="hidden" id="usuario" name="usuario" value="<?=$_SESSION['nombre']?>">
                    <input type="number" class="form-control" id="nrofactura" name="nrofactura">
                </div>
                <div class="form-group col-md-4">
                    <label for="actEconomica">Act. Económica</label>
                    <input type="text" class="form-control" id="actEconomica" name="actEconomica" value="692000" readonly>
                </div>
                <div class="form-group col-md-5">
                    <label for="documentoid">NIT/CI</label>
                    <div class="input-group-append">
                        <input type="text" class="form-control" id="documentoid" name="documentoid">
                        <input type="hidden" id="complementoid" name="complementoid">
                        <input type="hidden" id="id_cliente" name="id_cliente">
                        <button class="btn btn-outline-secondary" type="button" onclick="buscarCliente()"><i class="fas fa-search"></i></button>
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <label for="razon_social">Razón social</label>
                    <input type="hidden" id="tipo_documento" name="tipo_documento">
                    <input type="text" class="form-control" id="razon_social" name="razon_social" readonly>
                </div>
                <div class="form-group col-md-6">
                    <label for="cliente_email">Correo electrónico</label>
                    <input type="email" class="form-control" id="cliente_email" name="cliente_email" readonly>
                </div>
            </div>
            <div class="form-group row col-md-3">
                <div class="card">
                    <div class="input-group">
                        <span class="input-group-text">S. total</span>
                        <input type="number" class="form-control" id="subtotal" name="subtotal" step="0.01" value="0.00" min="0.00" style="text-align: right;" readonly>
                    </div>
                    <div class="input-group">
                        <span class="input-group-text">Desc. Add.</span>
                        <input type="number" class="form-control" id="descAdicional" name="descAdicional" step="0.01" value="0.00" min="0.00" style="text-align: right;" onchange="calcularstotal()" onkeyup="calcularstotal()">
                    </div>
                    <div class="input-group">
                        <span class="input-group-text">Total</span>
                        <input type="number" class="form-control" id="total" name="total" step="0.01" value="0.00" min="0.00" style="text-align: right;" readonly>
                    </div>
                    <div class="input-group">
                        <span id="comunicacion" class="badge badge-secondary">DESCONECTADO</span>
                        <p id="cuisp">CUIS inexistente</p>
                        <span class="badge badge-secondary" id="cufd">No existe CUFD vigente</span>
                        <?php if(isset($_SESSION['scufd'])){?>
                        <input type="hidden" id="cufdvalor" name="cufdvalor" value="<?=$_SESSION['scufd']?>">
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="card">
    <div class="card-header">
        <div class="card-title">Agregar productos</div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="form-group col-md-2">
                <label for="codigo">Cod. Producto</label>
                <div class="input-group-append">
                    <input type="hidden" id="codigoProductoSin" name="codigoProductoSin">
                    <input type="text" class="form-control" id="codigo" name="codigo">
                    <button class="btn btn-outline-secondary" type="button" onclick="buscarProducto()"><i class="fas fa-search"></i></button>
                </div>
            </div>
            <div class="form-group col-md-4">
                <label for="nombre_producto">Producto</label>
                <input type="text" class="form-control" id="nombre_producto" name="nombre_producto">
            </div>
            <div class="form-group col-md-1">
                <label for="descripcion_corta">U. med.</label>
                <input type="hidden" id="medidaSin" name="medidaSin">
                <input type="text" class="form-control" id="descripcion_corta" name="descripcion_corta">
            </div>
            <div class="form-group col-md-1">
                <label for="precio_venta">Precio</label>
                <input type="number" class="form-control" step="0.01" min="0.01" id="precio_venta" name="precio_venta" onchange="calcularstotal()" onkeyup="calcularstotal()">
            </div>
            <div class="form-group col-md-1">
                <label for="cantidad">Cantidad</label>
                <input type="number" class="form-control" step="0.01" min="0.01" id="cantidad" name="cantidad" onchange="calcularstotal()" onkeyup="calcularstotal()">
            </div>
            <div class="form-group col-md-1">
                <label for="descProducto">Desc.</label>
                <input type="number" class="form-control" step="0.01" min="0.00" id="descProducto" name="descProducto" onchange="calcularstotal()" onkeyup="calcularstotal()">
            </div>
            <div class="form-group col-md-1">
                <label for="sTotal">S. total</label>
                <input type="number" class="form-control" step="0.01" min="0.01" id="sTotal" name="sTotal" readonly>
            </div>
            <div class="form-group col-md-1">
                <label for="">&nbsp;</label>
                <div class="input-group">
                    <button class="btn btn-info" type="button" onclick="cargarProductos()"><i class="fas fa-plus"></i></button>
                </div>
            </div>
        </div>
    </div>
    <div class="card-footer">
        <button class="btn btn-success" type="button" onclick="emitirFactura()">Emitir Factura</button>
    </div>
</div>
<div class="card">
    <div class="card-body">
        <table class="table">
            <thead>
                <tr>
                    <th>Código</th>
                    <th>Producto</th>
                    <th>Precio</th>
                    <th>Cantidad</th>
                    <th>Descuento</th>
                    <th>S. Total</th>
                    <th></th>
                </tr>
            </thead>
            <tbody id="detalles">

            </tbody>
        </table>
    </div>
</div>
<?php require "Views/Templates/footer.php"; ?>
<script src="<?=base_url?>Assets/js/facturacion.js"></script>