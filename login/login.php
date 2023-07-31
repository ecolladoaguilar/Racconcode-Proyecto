<?php
//Iniciar sesión
session_start();
header('Access-Control-Allow-Origin: *');
if ($_SERVER['REQUEST_METHOD'] != "POST") {
    header('location: login.html');
    die;}

// Base de datos, tabla y conexión
$base = 'proyecto';
$tabla = 'registro';

$bd = new PDO("mysql:dbname=$base;host=localhost", 'root', '');

$preparada = $bd->prepare("select * from $tabla where usuario = ?");
$preparada->execute(array($_REQUEST['user']));

if ($preparada->rowCount() > 0) {
    $fila = $preparada->fetch();
    if ($fila['password'] == $_REQUEST['password']) {
        echo "1"; // Usuario y contraseña son correctos
    } else{
        echo "2"; // Contraseña incorrecta
    }
} else {
    echo "0"; // El usuario no existe
}

//variable de sesion
$_SESSION["usuario"] = $_REQUEST['user'];

?>