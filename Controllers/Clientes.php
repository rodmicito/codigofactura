<?php
class Clientes extends Controller
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
        $data = $this->model->getClientes();
        for ($i = 0; $i < count($data); $i++) {

            if ($data[$i]['cliente_estado'] == 1) {
                $data[$i]['cliente_estado'] = '<span class="badge badge-success">Activo</span>';
                $data[$i]['acciones'] = '<button class="btn btn-warning" type="button" onclick="btnEditarCliente(' . $data[$i]['id_cliente'] . ')" title="Editar"><i class="fas fa-edit"></i></button>
<button class="btn btn-danger" type="button" onclick="btnInactivaCliente(' . $data[$i]['id_cliente'] . ')" title="Inactivar"><i class="fas fa-trash-alt"></i></button>';
            } else {
                $data[$i]['cliente_estado'] = '<span class="badge badge-secondary">Inactivo</span>';
                $data[$i]['acciones'] = '<button class="btn btn-warning" type="button" onclick="btnEditarCliente(' . $data[$i]['id_cliente'] . ')" title="Editar"><i class="fas fa-edit"></i></button>
<button class="btn btn-success" type="button" onclick="btnActivaCliente(' . $data[$i]['id_cliente'] . ')" title="Activar"><i class="fas fa-arrow-alt-circle-up"></i></button>';
            }
            if($data[$i]['tipo_documento']==1){
                $data[$i]['tipo_documento']='Cedula ID';
            }else{
                $data[$i]['tipo_documento']='NIT';
            }
        }
        echo json_encode($data);
        die();
    }

    public function registrar()
    {
        $id_cliente = $_POST['id_cliente'];
        $documentoid = $_POST['documentoid'];
        $complementoid = $_POST['complementoid'];
        $razon_social = $_POST['razon_social'];
        $cliente_email = $_POST['cliente_email'];
        $tipo_documento = $_POST['tipo_documento'];
        if (empty($documentoid) || empty($razon_social)) {
            $msg = "Todos los campos son obligatorios";
        } else {
            if ($id_cliente == "") {
                $data = $this->model->registrar($documentoid, $complementoid, $razon_social, $cliente_email, $tipo_documento);
                if ($data == "ok") {
                    $msg = "si";
                } else {
                    $msg = "Error al registrar el dato";
                }
            } else {
                $data = $this->model->modificar($documentoid, $complementoid, $razon_social, $cliente_email, $tipo_documento, $id_cliente);
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

    public function get_cliente_id($id)
    {
        $data = $this->model->get_cliente_id($id);
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
