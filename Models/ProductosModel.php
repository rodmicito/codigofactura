<?php
class ProductosModel extends Query
{
    private $codigo, $nombre_producto, $costo_compra, $precio_venta, $cantidad, $id_categoria, $id_medida, $id_producto, $estado;
    public function __construct()
    {
        parent::__construct();
    }

    public function get_Producto_id(int $id_producto)
    {
        $sql = "select * from productos where id_producto='" . $id_producto . "'";
        $data = $this->select($sql);
        return $data;
    }

    public function getProductos()
    {
        $sql = "select p.*, c.nombre_categoria, c.codigoProductoSin, m.descripcion_medida, m.medidaSin  
        from productos p 
        inner join categorias c on c.id_categoria = p.id_categoria 
        inner join medidas m on m.id_medida = p.id_medida 
        order by id_producto asc";
        $data = $this->selectAll($sql);
        return $data;
    }

    public function getCategorias()
    {
        $sql = "select * from categorias where categoria_estado=1";
        $data = $this->selectAll($sql);
        return $data;
    }

    public function getMedidas()
    {
        $sql = "select * from medidas where medida_estado=1";
        $data = $this->selectAll($sql);
        return $data;
    }

    public function registrar(string $codigo, string $nombre_producto, float $costo_compra, float $precio_venta, float $cantidad, int $id_categoria, int $id_medida)
    {
        $this->codigo = $codigo;
        $this->nombre_producto = $nombre_producto;
        $this->costo_compra = $costo_compra;
        $this->precio_venta = $precio_venta;
        $this->cantidad = $cantidad;
        $this->id_categoria = $id_categoria;
        $this->id_medida = $id_medida;
        $sql = "insert into productos (codigo, nombre_producto, costo_compra, precio_venta, cantidad, id_categoria, id_medida) values (?,?,?,?,?,?,?)";
        $datos = array($this->codigo, $this->nombre_producto, $this->costo_compra, $this->precio_venta, $this->cantidad, $this->id_categoria, $this->id_medida);
        $data = $this->save($sql, $datos);
        if ($data == 1) {
            $res = "ok";
        } else {
            $res = "error";
        }
        return $res;
    }

    public function modificar(string $codigo, string $nombre_producto, float $costo_compra, float $precio_venta, float $cantidad, int $id_categoria, int $id_medida, int $id_producto)
    {
        $this->codigo = $codigo;
        $this->nombre_producto = $nombre_producto;
        $this->costo_compra = $costo_compra;
        $this->precio_venta = $precio_venta;
        $this->cantidad = $cantidad;
        $this->id_categoria = $id_categoria;
        $this->id_medida = $id_medida;
        $this->id_producto = $id_producto;
        $sql = "update productos set codigo=?, nombre_producto=?, costo_compra=?, precio_venta=?, cantidad=?, id_categoria=?, id_medida=? where id_producto=?";
        $datos = array($this->codigo, $this->nombre_producto, $this->costo_compra, $this->precio_venta, $this->cantidad, $this->id_categoria, $this->id_medida, $this->id_producto);
        $data = $this->save($sql, $datos);
        if ($data == 1) {
            $res = "modificado";
        } else {
            $res = "error";
        }
        return $res;
    }

    public function accion_estado(int $estado, int $id)
    {
        $this->id_producto = $id;
        $this->estado = $estado;
        $sql = "update productos set producto_estado=? where id_producto=?";
        $datos = array($this->estado, $this->id_producto);
        $data = $this->save($sql, $datos);
        return $data;
    }
}
