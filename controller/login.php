<?php

require_once './models/persona.php';

class LoginController {

    public function showIndex() {

        require_once "./view/login/login.php";

    }

    public function test() {

        $personaModel = new Persona();

        $personaList = $personaModel -> query()
            -> select("Nombre, ApellidoPaterno, ApellidoMaterno")
            -> where("Status", "=", 1)
            -> and()
            -> where("Nombre", "=", "Jose")
            -> getList();
             
        $persona = $personaModel -> query()
            -> select("Nombre, ApellidoPaterno, ApellidoMaterno")
            -> where("Status", "=", 1)
            -> and()
            -> where("Nombre", "=", "Jose")
            -> get();

        return set_response([
            "personas"          =>          $personaList,
            "persona"           =>          $persona
        ]);

    }

    public function auth() {

        $bodyParams = get_body_request();

        $persona = new Persona();

        $persona -> findOneByQuery();


    }

}