<?php
class Medidas extends Controller
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
        $data = $this->model->getMedidas();
        for ($i = 0; $i < count($data); $i++) {

            if ($data[$i]['medida_estado'] == 1) {
                $data[$i]['medida_estado'] = '<span class="badge badge-success">Activo</span>';
                $data[$i]['acciones'] = '<button class="btn btn-warning" type="button" onclick="btnEditarMedida(' . $data[$i]['id_medida'] . ')" title="Editar"><i class="fas fa-edit"></i></button>
<button class="btn btn-danger" type="button" onclick="btnInactivaMedida(' . $data[$i]['id_medida'] . ')" title="Inactivar"><i class="fas fa-trash-alt"></i></button>';
            } else {
                $data[$i]['medida_estado'] = '<span class="badge badge-secondary">Inactivo</span>';
                $data[$i]['acciones'] = '<button class="btn btn-warning" type="button" onclick="btnEditarMedida(' . $data[$i]['id_medida'] . ')" title="Editar"><i class="fas fa-edit"></i></button>
<button class="btn btn-success" type="button" onclick="btnActivaMedida(' . $data[$i]['id_medida'] . ')" title="Activar"><i class="fas fa-arrow-alt-circle-up"></i></button>';
            }
        }
        echo json_encode($data);
        die();
    }

    public function registrar()
    {
        $id_medida = $_POST['id_medida'];
        $descripcion_medida = $_POST['descripcion_medida'];
        $descripcion_corta = $_POST['descripcion_corta'];
        $medidaSin = $_POST['medidaSin'];
        if (empty($descripcion_medida) || empty($medidaSin)) {
            $msg = "Todos los campos son obligatorios";
        } else {
            if ($id_medida == "") {
                $data = $this->model->registrar($descripcion_medida, $descripcion_corta, $medidaSin);
                if ($data == "ok") {
                    $msg = "si";
                } else {
                    $msg = "Error al registrar el dato";
                }
            } else {
                $data = $this->model->modificar($descripcion_medida, $descripcion_corta, $medidaSin, $id_medida);
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

    public function get_medida_id($id)
    {
        $data = $this->model->get_medida_id($id);
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
