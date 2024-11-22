<?php
class MedidasModel extends Query
{
    private $descripcion_medida, $descripcion_corta, $medidaSin, $id_medida, $estado;
    public function __construct()
    {
        parent::__construct();
    }

    public function get_medida_id(int $id_medida){
        $sql="select * from medidas where id_medida='".$id_medida."'";
        $data = $this->select($sql);
        return $data;
    }

    public function getMedidas()
    {
        $sql = "select * 
        from medidas 
        order by id_medida asc";
        $data = $this->selectAll($sql);
        return $data;
    }

    public function registrar(string $descripcion_medida, string $descripcion_corta, int $medidaSin)
    {
        $this->descripcion_medida = $descripcion_medida;
        $this->descripcion_corta = $descripcion_corta;
        $this->medidaSin = $medidaSin;
        $sql = "insert into medidas (descripcion_medida, descripcion_corta, medidaSin) values (?,?,?)";
        $datos = array($this->descripcion_medida, $this->descripcion_corta, $this->medidaSin);
        $data = $this->save($sql, $datos);
        if ($data == 1) {
            $res = "ok";
        } else {
            $res = "error";
        }
        return $res;
    }

    public function modificar(string $descripcion_medida, string $descripcion_corta, int $medidaSin, int $id_medida){
        $this->descripcion_medida = $descripcion_medida;
        $this->descripcion_corta = $descripcion_corta;
        $this->medidaSin = $medidaSin;
        $this->id_medida = $id_medida;
        $sql="update medidas set descripcion_medida=?, descripcion_corta=?, medidaSin=? where id_medida=?";
        $datos = array($this->descripcion_medida, $this->descripcion_corta, $this->medidaSin, $this->id_medida);
        $data=$this->save($sql,$datos);
        if($data==1){
            $res="modificado";
        }else{
            $res="error";
        }
        return $res;
    }

    public function accion_estado(int $estado, int $id){
        $this->id_medida = $id;
        $this->estado = $estado;
        $sql="update medidas set medida_estado=? where id_medida=?";
        $datos=array($this->estado,$this->id_medida);
        $data=$this->save($sql,$datos);
        return $data;
    }
}
