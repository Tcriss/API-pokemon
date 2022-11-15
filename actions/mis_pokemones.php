<?php
include('../db/connect.php');
use Medoo\Medoo;

$rs = new Resultado($data);

$rs->verificar('token');

$database = new Medoo([
    'type' => 'mysql',
    'host' => DB_HOST,
    'database' => DB_NAME,
    'username' => DB_USER,
    'password' => DB_PASS
]);

$data = $database->select('pokemon','*');
$rs->datos = $data;
$rs->finalizar();