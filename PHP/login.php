<?php
// PHP/login.php
header('Content-Type: application/json');
$conn = new mysqli('localhost', "root", "", 'login');
if ($conn->connect_error) { echo json_encode(['success'=>false]); exit; }
$usuario = $_POST['usuario'] ?? '';
$contrasena = $_POST['contrasena'] ?? '';
$stmt = $conn->prepare("SELECT * FROM datos WHERE usuario=? AND contrasena=?");
$stmt->bind_param('ss', $usuario, $contrasena);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows > 0) echo json_encode(['success'=>true]);
else echo json_encode(['success'=>false]);
?>
