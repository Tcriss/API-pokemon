<?php
include('../db/connect.php');
use Medoo\Medoo;

$database = new Medoo([
    'type' => 'mysql',
    'host' => DB_HOST,
    'database' => DB_NAME,
    'username' => DB_USER,
    'password' => DB_PASS
]);

$data = $database->select('maestro',['nombre','apellido','correo']);

$rs = new Resultado($data);

$rs->finalizar();