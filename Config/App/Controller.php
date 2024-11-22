<?php
class Controller{
    
    public function __construct()
    {
        $this->cargarModel();
        $this->views = new Views();
    }

    public function cargarModel(){
        $model = get_class($this)."Model";
        $ruta = "Models/".$model.".php";
        if(file_exists($ruta)){
            require_once $ruta;
            $this->model = new $model;
        }else{
            echo "No existe el modelo";
        }
    }
}
?>