<?php
class Views{
    public function getView($controlador,$vista,$data=""){
        $controlador = get_class($controlador);
        if($controlador=="Home"){
            $vista = "Views/".$vista.".php";
        }else{
            $vista = "Views/".$controlador."/".$vista.".php";
        }
        
        if(file_exists($vista)){
            require $vista;
        }else{
            echo "No existe la vista";
        }
    }
}
?>