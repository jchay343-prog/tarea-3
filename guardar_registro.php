<?php
$conexion = new mysqli("localhost", "root", "", "restaurante");

$tabla = $_POST['tabla_nombre'];
unset($_POST['tabla_nombre']); // Quitamos el nombre de la tabla para quedarnos solo con los datos

$columnas = implode(", ", array_keys($_POST));
$valores = "'" . implode("', '", array_values($_POST)) . "'";

$sql = "INSERT INTO $tabla ($columnas) VALUES ($valores)";

if ($conexion->query($sql)) {
    echo "<script>
            alert('Registro guardado con éxito');
            window.location.href='mostrar_datos.php?tabla=$tabla';
          </script>";
} else {
    echo "Error al guardar: " . $conexion->error;
}

$conexion->close();
?>