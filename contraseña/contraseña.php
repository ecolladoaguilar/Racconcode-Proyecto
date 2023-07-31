<?php
header('Access-Control-Allow-Origin: *');
if ($_SERVER['REQUEST_METHOD'] != "POST") {
    header('location: contraseña.html');
    die;
}

// Base de datos, tabla y conexión
$base = 'proyecto';
$tabla = 'registro';

$bd = new PDO("mysql:dbname=$base;host=localhost", 'root', '');

$preparada = $bd->prepare("SELECT * FROM registro WHERE usuario = ?");
$preparada->execute(array($_REQUEST['user']));

if ($preparada->rowCount() > 0) {
    $preparada = $bd->prepare("UPDATE registro SET password = ? WHERE usuario = ?");
    $preparada->execute(array($_REQUEST['password'], $_REQUEST['user']));
    echo 1;
} else {
    echo 2;
}
?>