<?php

class Persona extends PDOClass {

    protected $table = "persona";

    protected $columns = [
        "Nombre",
        "ApellidoPaterno",
        "ApellidoMaterno",
        "Telefono",
        "Correo",
        "Status",
    ];
    
}