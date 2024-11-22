<?php
class Usuarios extends Controller{
    public function __construct()
    {
        parent::__construct();
    }

    public function index(){
        $data['cajas']=$this->model->getCajas();
        $this->views->getView($this,"index",$data);
    }

    public function listar(){
        $data=$this->model->getUsuarios();
        for($i=0;$i<count($data);$i++){
            
            if($data[$i]['usuario_estado']==1){
                $data[$i]['usuario_estado']='<span class="badge badge-success">Activo</span>';
                $data[$i]['acciones'] = '<button class="btn btn-warning" type="button" onclick="btnEditarUsuario('.$data[$i]['id_usuario'].')" title="Editar"><i class="fas fa-edit"></i></button>
<button class="btn btn-danger" type="button" onclick="btnInactivaUsuario('.$data[$i]['id_usuario'].')" title="Inactivar"><i class="fas fa-trash-alt"></i></button>';
            }else{
                $data[$i]['usuario_estado']='<span class="badge badge-secondary">Inactivo</span>';
                $data[$i]['acciones'] = '<button class="btn btn-warning" type="button" onclick="btnEditarUsuario('.$data[$i]['id_usuario'].')" title="Editar"><i class="fas fa-edit"></i></button>
<button class="btn btn-success" type="button" onclick="btnActivaUsuario('.$data[$i]['id_usuario'].')" title="Activar"><i class="fas fa-arrow-alt-circle-up"></i></button>';
            }
        }
        echo json_encode($data);
        die();
    }

    public function validar(){
        if(empty($_POST['nick']) || empty($_POST['clave'])){
            $msg="Todos los campos son obligatorios";
        }else{
            $nick = $_POST['nick'];
            $clave = $_POST['clave'];
            $data=$this->model->getUsuario($nick,md5($clave));
            if($data){
                $msg="ok";
                $_SESSION['nick'] = $data['nick'];
                $_SESSION['nombre'] = $data['nombre'];
            }else{
                $msg="Usuario o contraseña incorrecta";
            }
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function registrar(){
        $id_usuario=$_POST['id_usuario'];
        $nick=$_POST['nick'];
        $nombre=$_POST['nombre'];
        $clave=$_POST['clave'];
        $confirmar=$_POST['confirmar'];
        $id_caja=$_POST['id_caja'];
        if(empty($nick)||empty($nombre)||empty($clave)){
            $msg="Todos los campos son obligatorios";
        }else{
            if($id_usuario==""){
                if($clave!=$confirmar){
                    $msg="Las constraseñas no coinciden";
                }else{
                    $data=$this->model->registrar($nick,$nombre,md5($clave),$id_caja);
                    if($data=="ok"){
                        $msg="si";
                    }else{
                        $msg="Error al registrar el dato";
                    }
                }
            }else{
                $data=$this->model->modificar($nick,$nombre,$id_caja,$id_usuario);
                if($data=="modificado"){
                    $msg="modif";
                }else{
                    $msg="Error al modificar el dato";
                }
            }            
        }
        echo json_encode($msg,JSON_UNESCAPED_UNICODE);
        die();
    }

    public function get_usuario_id($id){
        $data=$this->model->get_usuario_id($id);
        echo json_encode($data);
        die();
    }

    public function inactivar($id){
        $this->model->accion_estado(0,$id);
    }

    public function activar($id){
        $this->model->accion_estado(1,$id);
    }
}
