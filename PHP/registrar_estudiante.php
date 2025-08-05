<?php
// Configura tu conexión
$conn = new mysqli('localhost', "root", "", 'login');
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Procesar datos del formulario
$cod_estudiante = $_POST['cod_estudiante'];
$nom_estudiante = $_POST['nom_estudiante'];
$tel_estudiante = $_POST['tel_estudiante'];
$email_estudiante = $_POST['email_estudiante'];

// Procesar la imagen
$foto_url = "";
if (isset($_FILES['foto_estudiante']) && $_FILES['foto_estudiante']['error'] == 0) {
    $ruta_destino = "../img/estudiantes/";
    if (!file_exists($ruta_destino)) {
        mkdir($ruta_destino, 0777, true);
    }
    $nombre_archivo = uniqid() . "_" . basename($_FILES['foto_estudiante']['name']);
    $ruta_archivo = $ruta_destino . $nombre_archivo;
    if (move_uploaded_file($_FILES['foto_estudiante']['tmp_name'], $ruta_archivo)) {
        // Guardar la URL relativa para acceso web
        $foto_url = "img/estudiantes/" . $nombre_archivo;
    }
}

$sql = "INSERT INTO estudiantes (cod_estudiante, nom_estudiante, tel_estudiante, email_estudiante, foto_estudiante) VALUES (?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("isiss", $cod_estudiante, $nom_estudiante, $tel_estudiante, $email_estudiante, $foto_url);

if ($stmt->execute()) {
    // Registro exitoso, redireccionar a tabla.html
    header("Location: ../registro-est/tabla.php");
    exit;
} else {
    // Si hay error, mostrar mensaje y link para volver
    echo "<div class='alert alert-danger'>Error: " . $conn->error . "</div>";
    echo "<a href='../registro-est/registro.html'>Volver al registro</a>";
}


$stmt->close();
$conn->close();
?>
