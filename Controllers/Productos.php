<?php
class Productos extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $data['categorias'] = $this->model->getCategorias();
        $data['medidas'] = $this->model->getMedidas();
        $this->views->getView($this, "index", $data);
    }

    public function listar()
    {
        $data = $this->model->getProductos();
        for ($i = 0; $i < count($data); $i++) {

            if ($data[$i]['producto_estado'] == 1) {
                $data[$i]['producto_estado'] = '<span class="badge badge-success">Activo</span>';
                $data[$i]['acciones'] = '<button class="btn btn-warning" type="button" onclick="btnEditarProducto(' . $data[$i]['id_producto'] . ')" title="Editar"><i class="fas fa-edit"></i></button>
<button class="btn btn-danger" type="button" onclick="btnInactivaProducto(' . $data[$i]['id_producto'] . ')" title="Inactivar"><i class="fas fa-trash-alt"></i></button>';
            } else {
                $data[$i]['producto_estado'] = '<span class="badge badge-secondary">Inactivo</span>';
                $data[$i]['acciones'] = '<button class="btn btn-warning" type="button" onclick="btnEditarProducto(' . $data[$i]['id_producto'] . ')" title="Editar"><i class="fas fa-edit"></i></button>
<button class="btn btn-success" type="button" onclick="btnActivaProducto(' . $data[$i]['id_producto'] . ')" title="Activar"><i class="fas fa-arrow-alt-circle-up"></i></button>';
            }
        }
        echo json_encode($data);
        die();
    }

    public function registrar()
    {
        $id_producto = $_POST['id_producto'];
        $codigo = $_POST['codigo'];
        $nombre_producto = $_POST['nombre_producto'];
        $costo_compra = $_POST['costo_compra'];
        $precio_venta = $_POST['precio_venta'];
        $cantidad = $_POST['cantidad'];
        $id_categoria = $_POST['id_categoria'];
        $id_medida = $_POST['id_medida'];
        if (empty($codigo) || empty($nombre_producto) || empty($cantidad)) {
            $msg = "Todos los campos son obligatorios";
        } else {
            if ($id_producto == "") {
                $data = $this->model->registrar($codigo, $nombre_producto, $costo_compra, $precio_venta, $cantidad, $id_categoria, $id_medida);
                if ($data == "ok") {
                    $msg = "si";
                } else {
                    $msg = "Error al registrar el dato";
                }
            } else {
                $data = $this->model->modificar($codigo, $nombre_producto, $costo_compra, $precio_venta, $cantidad, $id_categoria, $id_medida, $id_producto);
                if ($data == "modificado") {
                    $msg = "modif";
                } else {
                    $msg = "Error al modificar el dato";
                }
            }
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function get_producto_id($id)
    {
        $data = $this->model->get_producto_id($id);
        echo json_encode($data);
        die();
    }

    public function inactivar($id)
    {
        $this->model->accion_estado(0, $id);
    }

    public function activar($id)
    {
        $this->model->accion_estado(1, $id);
    }
}
