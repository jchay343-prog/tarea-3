<?php
$conexion = new mysqli("localhost", "root", "", "restaurante");

if ($conexion->connect_error) {
    die("Fallo de conexión");
}

$user = $_POST['usuario'];
$code = $_POST['codigo'];

// Buscamos en tu tabla empleados
$sql = "SELECT * FROM empleados WHERE nombre = '$user' AND cod_empleado = '$code'";
$resultado = $conexion->query($sql);

if ($resultado->num_rows > 0) {
    // Si es correcto, manda a elegir tabla
    header("Location: elegir_tabla.php");
} else {
    echo "<script>alert('Datos incorrectos'); window.location.href='login.html';</script>";
}
$conexion->close();
?>