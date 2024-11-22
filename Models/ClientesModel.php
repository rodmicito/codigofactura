<?php
class ClientesModel extends Query
{
    private $documentoid, $complementoid, $razon_social, $cliente_email, $tipo_documento, $id_cliente, $estado;
    public function __construct()
    {
        parent::__construct();
    }

    public function get_cliente_id(int $id_cliente){
        $sql="select * from clientes where id_cliente='".$id_cliente."'";
        $data = $this->select($sql);
        return $data;
    }

    public function getClientes()
    {
        $sql = "select * 
        from clientes 
        order by id_cliente asc";
        $data = $this->selectAll($sql);
        return $data;
    }

    public function registrar(string $documentoid, string $complementoid, string $razon_social, string $cliente_email, int $tipo_documento)
    {
        $this->documentoid = $documentoid;
        $this->complementoid = $complementoid;
        $this->razon_social = $razon_social;
        $this->cliente_email = $cliente_email;
        $this->tipo_documento = $tipo_documento;
        $sql = "insert into clientes (documentoid, complementoid, razon_social, cliente_email, tipo_documento) values (?,?,?,?,?)";
        $datos = array($this->documentoid, $this->complementoid,$this->razon_social,$this->cliente_email,$this->tipo_documento);
        $data = $this->save($sql, $datos);
        if ($data == 1) {
            $res = "ok";
        } else {
            $res = "error";
        }
        return $res;
    }

    public function modificar(string $documentoid, string $complementoid, string $razon_social, string $cliente_email, int $tipo_documento, int $id_cliente){
        $this->documentoid = $documentoid;
        $this->complementoid = $complementoid;
        $this->razon_social = $razon_social;
        $this->cliente_email = $cliente_email;
        $this->tipo_documento = $tipo_documento;
        $this->id_cliente = $id_cliente;
        $sql="update clientes set documentoid=?, complementoid=?, razon_social=?, cliente_email=?, tipo_documento=? where id_cliente=?";
        $datos = array($this->documentoid, $this->complementoid,$this->razon_social,$this->cliente_email,$this->tipo_documento,$this->id_cliente);
        $data=$this->save($sql,$datos);
        if($data==1){
            $res="modificado";
        }else{
            $res="error";
        }
        return $res;
    }

    public function accion_estado(int $estado, int $id){
        $this->id_cliente = $id;
        $this->estado = $estado;
        $sql="update clientes set cliente_estado=? where id_cliente=?";
        $datos=array($this->estado,$this->id_cliente);
        $data=$this->save($sql,$datos);
        return $data;
    }
}
