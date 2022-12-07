<?php

require_once './models/persona.php';

class PersonaController {

    public function showListar() {
        require_once "./view/persona/list.php";
    }

    public function showCrear() {

        $isNew = true;

        require_once "./view/persona/form.php";   
        
    }

    public function showEditar () {

        $isNew = false;

        require_once "./view/persona/form.php";   

    }

    public function create() {

        $data = get_body_request();

        $persona = new Persona();

        $createdPersona = $persona -> create($data);

        if ( !$createdPersona ) return set_response([
            "error"             =>          "create_error"
        ], 500);

        return set_response([
            "message"           =>          "persona_created"
        ], 201);

    }

    public function update() {

        $id = $_GET["id"];

        $data = get_body_request();

        $persona = new Persona();

        $updatedPersona = $persona -> update($data, $id);

        if ( !$updatedPersona ) return set_response([
            "error"             =>          "update_error"
        ], 500);

        return set_response([
            "message"           =>          "persona_updated"
        ]);

    }

    public function list() {

        $persona = new Persona();

        $listaPersonas = $persona -> query()
            -> where("Status", "=", 1)
            -> getList();

        return set_response($listaPersonas);

    }
	
    public function findOne() {
        
        $id = $_GET["id"];

        $persona = new Persona();

        $findedPersona = $persona -> findOne($id);

        return set_response($findedPersona);

    }

    public function deleteOne() {

        $id = $_GET["id"];

        $persona = new Persona();

        $deletedPersona = $persona -> update(["Status" => 0], $id);

        if (!$deletedPersona) return set_response([
            "error"             =>          "delete_error"
        ], 500);

        return set_response([ "message" => "deleted_persona" ]);

    }

}