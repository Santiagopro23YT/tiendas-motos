<?php
include("./conexiones.php");  // Missing semicolon here

$nom_registro = $_POST['nom_registro'];
$ape_registro = $_POST['ape_registro'];
$tel_registro = $_POST['tel_registro'];
$pass_registro = $_POST['pass_registro'];
$ema_registro = $_POST['ema_registro'];

if ($nom_registro && $ape_registro && $tel_registro && $pass_registro && $ema_registro) {
    $sql = "INSERT INTO registro(id_registro, nom_registro, ape_registro, tel_registro, pass_registro, ema_registro, fecha_registro) 
            VALUES (NULL, '$nom_registro', '$ape_registro', '$tel_registro', '$pass_registro', '$ema_registro', CURRENT_TIMESTAMP)";
    // Fixed quotes - use single quotes inside double quotes or escape double quotes

    mysqli_query($mysqli, $sql);  // Missing $ before mysqli_query

    echo "Registro exitoso";
}
else {
    echo "Todos los campos deben estar llenos";
}
?>