<?php require "Views/Templates/header.php"; ?>
<div class="card">
    <div class="card-header">
        <div class="card-title">Facturas</div>
    </div>
    <div class="card-body">
        <a href="<?=base_url?>Pedidos/nuevo_pedido" class="btn btn-success mb-3"><i class="fas fa-plus"></i> Nuevo pedido</a>
        <table class="table" id="tblFacturas">
            <thead>
                <tr>
                    <th>Razón social</th>
                    <th>NIT/CI</th>
                    <th>Nro. Factura</th>
                    <th>Fecha</th>
                    <th>Total</th>
                    <th>Descuento</th>
                    <th>Estado</th>
                    <th></th>
                </tr>
            </thead>
        </table>
    </div>
</div>
<?php require "Views/Templates/footer.php"; ?>