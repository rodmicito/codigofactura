<?php
class Home extends Controller {
    public function __construct()
    {
        parent::__construct();
    }

    public function index(){
        if(isset($_SESSION['nick'])){
            $data['usuarios']=$this->model->getUsuarios();
            $this->views->getView($this,"index",$data);
        }else{
            header('location: '.$this->login());
        }
        
    }

    public function login(){
        $this->views->getView($this,"login");
    }

    public function cerrar_sesion(){
        session_destroy();
        $this->login();
    }
}
?>