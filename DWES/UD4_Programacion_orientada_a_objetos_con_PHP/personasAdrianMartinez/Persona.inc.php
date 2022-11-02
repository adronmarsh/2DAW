<?php
class Persona {
    private $idContacto;
    private $nombre;
    private $apellido1;
    private $apellido2;
    private $telefono;

    public function __construct($idContacto, $nombre, $apellido1, $apellido2, $telefono){
        $this->idContacto = $idContacto;
        $this->nombre = $nombre;
        $this->apellido1 = $apellido1;
        $this->apellido2 = $apellido2;
        $this->telefono = $telefono;
    }
    //Creacion de getters
    public function getIdContacto(){
       return $this->idContacto;
    }
    public function getNombre(){
        return $this->nombre;
    }
    public function getApellido1(){
        return $this->apellido1;
    }
    public function getApellido2(){
        return $this->apellido2;
    }
    public function getTelefono(){
        return $this->telefono;
    }

    //Creacion de setters
    public function setIdContacto($idContacto){
        $this->idContacto = $idContacto;
    }
    public function setNombre($nombre){
        $this->nombre = $nombre;
    }
    public function setApellido1($apellido1){
        $this->apellido1 = $apellido1;
    }
    public function setApellido2($apellido2){
        $this->apellido2 = $apellido2;
    }
    public function setTelefono($telefono){
        $this->telefono = $telefono;
    }

    //Método __toString
    public function __toString(){
        return $this->idContacto.' | '.$this->nombre.' '.$this->apellido1.' '.$this->apellido2.' | '.$this->telefono.'<br>';
    }
}