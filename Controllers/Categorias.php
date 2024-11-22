<?php
class Categorias extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->views->getView($this, "index");
    }

    public function listar()
    {
        $data = $this->model->getCategorias();
        for ($i = 0; $i < count($data); $i++) {

            if ($data[$i]['categoria_estado'] == 1) {
                $data[$i]['categoria_estado'] = '<span class="badge badge-success">Activo</span>';
                $data[$i]['acciones'] = '<button class="btn btn-warning" type="button" onclick="btnEditarCategoria(' . $data[$i]['id_categoria'] . ')" title="Editar"><i class="fas fa-edit"></i></button>
<button class="btn btn-danger" type="button" onclick="btnInactivaCategoria(' . $data[$i]['id_categoria'] . ')" title="Inactivar"><i class="fas fa-trash-alt"></i></button>';
            } else {
                $data[$i]['categoria_estado'] = '<span class="badge badge-secondary">Inactivo</span>';
                $data[$i]['acciones'] = '<button class="btn btn-warning" type="button" onclick="btnEditarCategoria(' . $data[$i]['id_categoria'] . ')" title="Editar"><i class="fas fa-edit"></i></button>
<button class="btn btn-success" type="button" onclick="btnActivaCategoria(' . $data[$i]['id_categoria'] . ')" title="Activar"><i class="fas fa-arrow-alt-circle-up"></i></button>';
            }
        }
        echo json_encode($data);
        die();
    }

    public function registrar()
    {
        $id_categoria = $_POST['id_categoria'];
        $nombre_categoria = $_POST['nombre_categoria'];
        $codigoProductoSin = $_POST['codigoProductoSin'];
        if (empty($nombre_categoria) || empty($codigoProductoSin)) {
            $msg = "Todos los campos son obligatorios";
        } else {
            if ($id_categoria == "") {
                $data = $this->model->registrar($nombre_categoria, $codigoProductoSin);
                if ($data == "ok") {
                    $msg = "si";
                } else {
                    $msg = "Error al registrar el dato";
                }
            } else {
                $data = $this->model->modificar($nombre_categoria, $codigoProductoSin, $id_categoria);
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

    public function get_categoria_id($id)
    {
        $data = $this->model->get_categoria_id($id);
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
