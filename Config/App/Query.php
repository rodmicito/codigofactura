<?php
class Query extends Conexion{
    private $pdo, $conexion, $sql, $datos;
    public function __construct()
    {
        $this->pdo = new Conexion();
        $this->conexion = $this->pdo->conect();
    }

    public function select(string $sql){
        $this->sql = $sql;
        $resultado = $this->conexion->prepare($this->sql);
        $resultado->execute();
        $data=$resultado->fetch(PDO::FETCH_ASSOC);
        return $data;
    }

    public function selectAll(string $sql){
        $this->sql = $sql;
        $resultado = $this->conexion->prepare($this->sql);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }

    public function save(string $sql, array $datos){
        $this->sql = $sql;
        $this->datos = $datos;
        $insert=$this->conexion->prepare($this->sql);
        $data=$insert->execute($this->datos);
        if($data){
            $res=1;
        }else{
            $res=0;
        }
        return $res;
    }
}
?>