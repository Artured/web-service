<?php

Class db
{
    private $pass = "";
    private $usuario = "";
    private $db = "";
    private $host = "127.0.0.1";

    public function __construct()
    {
        $this->conexion = new mysqli($this->host, $this->usuario, $this->pass,$this->db) or die(mysql_error());
        $this->conexion->set_charset("utf8");
    }

    public function get($data)
    {   
        $id = $data['orden_id'];
        $num_cia = $data['num_cia'];
        $date = $data['fecha'];
 
        $query = $this->conexion->query("
            SELECT
                    *
            FROM
                rappi_ordenes
            WHERE
                orden_id = $id
            AND
                num_cia = $num_cia
            AND
                fecha = '$date'
            ");
    
        if( $query->num_rows > 0){
                
            $resultado = $query->fetch_all(MYSQLI_ASSOC);
           
            return  $resultado;
        }
        
        return false;
    }

    public function add($data)
    {
        $id         = $data['orden_id'];
        $order_id   = $data['order_id'];
        $num_cia    = $data['num_cia'];
        $date       = $data['fecha'];
        $time       = $data['hora'] != '' ? $data['hora'] : null;
        $name       = $data['nombre_cliente'] != '' ? $data['nombre_cliente'] : null;
        $groceries  = $data['articulos'] != '' ? $data['articulos'] : null;
        $i_e        = $data['instrucciones_especiales'] != '' ? $data['instrucciones_especiales'] : null;
        $total      = $data['total'] != '' ? $data['total'] : null;
        $type       = $data['tipo'] != '' ? $data['tipo'] : null;

        $query = $this->conexion->prepare("
            INSERT INTO 
                rappi_ordenes
                (orden_id,order_id,num_cia,fecha,hora,nombre_cliente,articulos,instrucciones_especiales,total,tipo) 
            VALUES 
                (?,?,?,?,?,?,?,?,?,?)
        ");
     
        $query->bind_param('siisssssds', $id,$order_id,$num_cia, $date,$time,$name,$groceries, $i_e,$total,$type);
        $query->execute();
       
        if( $query->affected_rows > 0){

            return  true;
        }

        return false;
    }
   
}