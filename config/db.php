<?php 

$host='localhost';
$contraseña='';
$usuario='root';
$db='divino_niño';

try {
    $conexion = new PDO("mysql:host=$host;dbname=$db", $usuario, $contraseña);
} catch( PDOException $ex ){
    echo $ex->getMessage();
}
return $conexion;

?>