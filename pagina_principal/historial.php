<?php
header('Access-Control-Allow-Origin: *');
if ($_SERVER['REQUEST_METHOD'] != "POST") {
    header('location: raccondecode.php');
    die;
}

session_start();

$usuario = $_SESSION['usuario'];

$base = 'proyecto';
$tabla = 'historial';

//select de los 5 mejores.
$bd = new PDO("mysql:dbname=$base;host=localhost", 'root', '');

$seleccion = $bd->prepare("SELECT usuario, fecha, codificacion, tipo FROM $tabla WHERE usuario=:usuario");
$seleccion->bindParam(':usuario', $usuario);
$seleccion->execute();

foreach ($seleccion as $fila) {
    echo "<style='font-size: 18px;'>Fecha: $fila[fecha], Codificación: $fila[codificacion], Tipo: $fila[tipo]<br>";
}

?>
