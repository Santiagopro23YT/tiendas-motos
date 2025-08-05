<?php
$mysqli = mysqli_connect("localhost","root","","tiendas-motos");

if ($mysqli->connect_errno) {
    prinf ("Fallo la conexion: %s\n",
    $mysqli->connect_error);
    exit();
}
?>