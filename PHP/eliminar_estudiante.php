<?php
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $conn = new mysqli('localhost', "root", "", 'login');
    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }
    // Opcional: primero elimina la imagen del servidor (si existe)
    $res = $conn->query("SELECT foto_estudiante FROM estudiantes WHERE id_estudiante=$id");
    if ($row = $res->fetch_assoc()) {
        $ruta_foto = "../" . $row['foto_estudiante'];
        if (file_exists($ruta_foto)) {
            unlink($ruta_foto);
        }
    }
    // Elimina el registro
    $conn->query("DELETE FROM estudiantes WHERE id_estudiante=$id");
    $conn->close();
}
header("Location: ../registro-est/tabla.php");
exit;
