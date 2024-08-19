<?php
    class database{
public $db;
protected $resultado;
protected $prep;
protected $consulta;

public function __construct($dbhost,$dbuser,$dbpass,$dbname,$charset){
    $this->db=new mysqli ($dbhost,$dbuser,$dbpass,$dbname);

    if($this->db->connect_error){
        trigger_error("Error en la conexion a la base de datos.Tipo error -> 
        ({$this->db->connect_error})",E_USER_ERROR);
    }
    $this->db->set_charset($charset);
}
public function getUsuarios(){
    $this->resultado=$this->db->query("SELECT *FROM usuario");
    return $this->resultado->fetchAll();
}
    }
?>