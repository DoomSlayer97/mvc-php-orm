<?php
require_once "./models/db.php";
require_once "./helpers/helpers.php";
require_once "./middleware/middlewares.php";
require_once "./config/router.php";
require_once "./controller/persona.php";
require_once "./controller/login.php";

$router = new Router();

$router -> get("test", "LoginController@test",);
$router -> get("", "LoginController@showIndex",);
$router -> get("/personal", "PersonaController@showListar",);
$router -> get("crear", "PersonaController@showCrear");
$router -> get("editar", "PersonaController@showEditar");

/* API */

/* Login */
$router -> post("api/auth", "LoginController@auth");

/* Personal */
$router -> post("api/crear", "PersonaController@create", ["validateNombre"]);
$router -> post("api/actualizar", "PersonaController@update");
$router -> post("api/eliminar", "PersonaController@deleteOne");
$router -> get("api/listar", "PersonaController@list");
$router -> get("api/buscar", "PersonaController@findOne");

$router -> run();