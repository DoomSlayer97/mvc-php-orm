<?php

function validateNombre() {

    $bodyParams = get_body_request();

    $nombre = $bodyParams["Nombre"];

    if ( empty($nombre) ) {

        return set_response([
            "message"           =>          "nombre_is_empty"
        ], 400);

    }

    return true;
    
}

function validateUserSession() {}