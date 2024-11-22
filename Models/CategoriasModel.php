<?php
class CategoriasModel extends Query
{
    private $nombre_categoria, $codigoProductoSin, $id_categoria, $estado;
    public function __construct()
    {
        parent::__construct();
    }

    public function get_categoria_id(int $id_categoria){
        $sql="select * from categorias where id_categoria='".$id_categoria."'";
        $data = $this->select($sql);
        return $data;
    }

    public function getCategorias()
    {
        $sql = "select * 
        from categorias 
        order by id_categoria asc";
        $data = $this->selectAll($sql);
        return $data;
    }

    public function registrar(string $nombre_categoria, string $codigoProductoSin)
    {
        $this->nombre_categoria = $nombre_categoria;
        $this->codigoProductoSin = $codigoProductoSin;
        $sql = "insert into categorias (nombre_categoria, codigoProductoSin) values (?,?)";
        $datos = array($this->nombre_categoria, $this->codigoProductoSin);
        $data = $this->save($sql, $datos);
        if ($data == 1) {
            $res = "ok";
        } else {
            $res = "error";
        }
        return $res;
    }

    public function modificar(string $nombre_categoria, string $codigoProductoSin, int $id_categoria){
        $this->nombre_categoria = $nombre_categoria;
        $this->codigoProductoSin = $codigoProductoSin;
        $this->id_categoria = $id_categoria;
        $sql="update categorias set nombre_categoria=?, codigoProductoSin=? where id_categoria=?";
        $datos = array($this->nombre_categoria, $this->codigoProductoSin, $this->id_categoria);
        $data=$this->save($sql,$datos);
        if($data==1){
            $res="modificado";
        }else{
            $res="error";
        }
        return $res;
    }

    public function accion_estado(int $estado, int $id){
        $this->id_categoria = $id;
        $this->estado = $estado;
        $sql="update categorias set categoria_estado=? where id_categoria=?";
        $datos=array($this->estado,$this->id_categoria);
        $data=$this->save($sql,$datos);
        return $data;
    }
}
