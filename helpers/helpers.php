<?php

function set_response($data = [], $code = 200) {

    http_response_code($code);

    header("Content-Type: application/json");
    echo json_encode($data);
    
    return;
    
}

function get_body_request() {
    
    $data = json_decode(file_get_contents('php://input'), true);

    return $data;

}