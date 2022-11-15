<?php

include('../db/connect.php');
use Medoo\Medoo;

$rs = new Resultado();

$rs->verificar("nombre,nivel,tipo,comentario,token");

$database = new Medoo([
    'type' => 'mysql',
    'host' => DB_HOST,
    'database' => DB_NAME,
    'username' => DB_USER,
    'password' => DB_PASS
]);

$tnpx = $database->select('maestro',['id'],['token' => $_POST['token']]);

if(count($tnpx) == 0){
    $rs->exitos = false;
    $rs->ms = "Error de validacion";
    $rs->finalizar();
}

$maestro = $tnpx[0];

$pokemon = [];
$pokemon ["nombre"] = $_POST["nombre"];
$pokemon ["nivel"] = $_POST["nivel"];
$pokemon ["tipo"] = $_POST["tipo"];
$pokemon ["comentario"] = $_POST["comentario"];
$pokemon ["maestro"] = $maestro["id"];

$database->insert('pokemon', $pokemon);
$rs->ms = "Se registro efectivamente";
$rs->finalizar();