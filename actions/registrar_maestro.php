<?php
include('../db/connect.php');

use Medoo\Medoo;

$rs = new Resultado();

$rs->verificar("correo, clave, nombre, apellido");

$database = new Medoo([
    'type' => 'mysql',
    'host' => DB_HOST,
    'database' => DB_NAME,
    'username' => DB_USER,
    'password' => DB_PASS
]);

$posible = $database->select('maestro','*',['correo' => $_POST['correo']]);

if(count($posible)>0){
    $rs->exito = false;
    $rs->mensaje = "El correo ya existe";
    $rs->finalizar();
}

$maestro = [];

$maestro["correo"] = $_POST["correo"];
$maestro["clave"] = md5($_POST["clave"] . SALT_PKM);
$maestro["nombre"] = $_POST["nombre"];
$maestro["apellido"] = $_POST["apellido"];


$database->insert("maestro", $maestro);

$rs->mensaje = "Maestro registrado con exito";

$rs->finalizar();