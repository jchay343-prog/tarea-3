<?php
$conexion = new mysqli("localhost", "root", "", "restaurante");
$resultado = $conexion->query("SHOW TABLES");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Elegir Tabla</title>
    <style>
        body { font-family: Arial; text-align: center; background: #f4f4f4; }
        .btn { display: block; width: 200px; padding: 15px; margin: 10px auto; background: #27ae60; color: white; text-decoration: none; border-radius: 5px; }
    </style>
</head>
<body>
    <h1>Bienvenido al Restaurante</h1>
    <h3>Seleccione una tabla para ver los datos:</h3>
    <?php
    while($fila = $resultado->fetch_array()) {
        $nombre = $fila[0];
        echo "<a href='mostrar_datos.php?tabla=$nombre' class='btn'>Tabla: $nombre</a>";
    }
    ?>
    <br>
    <a href="login.html" style="color:red;">Cerrar Sesión</a>
</body>
</html>