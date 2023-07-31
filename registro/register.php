
<?php
header('Access-Control-Allow-Origin: *');
if($_SERVER['REQUEST_METHOD']!="POST"){
   header('location: register.html');
   die;}

//Base de datos tabla y conexión
$base = 'proyecto';
$tabla = 'registro';

$bd = new PDO("mysql:dbname=$base;host=localhost", 'root', '');

$preparada = $bd -> prepare("insert into registro(usuario, email, password, fecha) VALUES (?, ?, ?, NOW())");
$preparada -> execute(array($_REQUEST['user'], $_REQUEST['email'], $_REQUEST['password']));

?>