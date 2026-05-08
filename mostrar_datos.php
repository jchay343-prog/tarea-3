<?php
// 1. Conexión a la base de datos
$conexion = new mysqli("localhost", "root", "", "restaurante");

if ($conexion->connect_error) {
    die("Fallo de conexión: " . $conexion->connect_error);
}

// 2. Obtener el nombre de la tabla que elegiste en el menú
if(isset($_GET['tabla'])) {
    $tabla = $_GET['tabla'];
} else {
    // Si no hay tabla elegida, regresa al menú
    header("Location: menu.php");
}

// 3. Consultar los datos de esa tabla
$resultado = $conexion->query("SELECT * FROM $tabla");
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Datos de <?php echo $tabla; ?></title>
    <style>
        body { font-family: 'Segoe UI', Arial, sans-serif; background-color: #f4f7f6; margin: 0; padding: 20px; text-align: center; }
        h2 { color: #2c3e50; text-transform: uppercase; }
        
        /* Estilo de la tabla */
        table { border-collapse: collapse; width: 90%; margin: 20px auto; background: white; box-shadow: 0 4px 8px rgba(0,0,0,0.1); }
        th, td { border: 1px solid #ddd; padding: 12px; text-align: left; }
        th { background-color: #d35400; color: white; }
        tr:nth-child(even) { background-color: #f9f9f9; }
        tr:hover { background-color: #f1f1f1; }

        /* Estilo de los botones */
        .btn-insertar { 
            display: inline-block; background-color: #27ae60; color: white; 
            padding: 10px 20px; text-decoration: none; border-radius: 5px; 
            font-weight: bold; margin-bottom: 20px;
        }
        .btn-insertar:hover { background-color: #2ecc71; }
        .btn-volver { color: #3498db; text-decoration: none; font-weight: bold; }
    </style>
</head>
<body>

    <h2>Registros en la tabla: <?php echo $tabla; ?></h2>
    
    <a href="formulario_insertar.php?tabla=<?php echo $tabla; ?>" class="btn-insertar">
        + AÑADIR NUEVO REGISTRO
    </a>

    <br>
    <a href="menu.php" class="btn-volver">← Volver al Menú de Tablas</a>

    <table>
        <thead>
            <tr>
                <?php
                // Obtener y mostrar los nombres de las columnas automáticamente
                $campos = $resultado->fetch_fields();
                foreach ($campos as $columna) {
                    echo "<th>" . strtoupper($columna->name) . "</th>";
                }
                ?>
            </tr>
        </thead>
        <tbody>
            <?php
            // Mostrar los datos de cada fila
            if ($resultado->num_rows > 0) {
                while($fila = $resultado->fetch_assoc()) {
                    echo "<tr>";
                    foreach($fila as $valor) {
                        echo "<td>" . $valor . "</td>";
                    }
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='20' style='text-align:center;'>No hay datos en esta tabla</td></tr>";
            }
            ?>
        </tbody>
    </table>

</body>
</html>