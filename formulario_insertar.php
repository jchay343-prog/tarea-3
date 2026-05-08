<?php
$conexion = new mysqli("localhost", "root", "", "restaurante");
$tabla = $_GET['tabla'];
$resultado = $conexion->query("DESCRIBE $tabla"); // Esto saca los nombres de las columnas
?>
<!DOCTYPE html>
<html>
<head>
    <title>Insertar en <?php echo $tabla; ?></title>
    <style>
        body { font-family: Arial; background: #f4f4f4; text-align: center; }
        .form-box { background: white; padding: 20px; display: inline-block; border-radius: 10px; margin-top: 50px; box-shadow: 0 4px 8px rgba(0,0,0,0.1); }
        input { display: block; width: 250px; padding: 10px; margin: 10px auto; border: 1px solid #ddd; }
        input[type="submit"] { background: #27ae60; color: white; border: none; cursor: pointer; }
    </style>
</head>
<body>
    <div class="form-box">
        <h2>Nuevo Registro: <?php echo $tabla; ?></h2>
        <form action="guardar_registro.php" method="POST">
            <input type="hidden" name="tabla_nombre" value="<?php echo $tabla; ?>">
            
            <?php
            while($col = $resultado->fetch_assoc()) {
                // No pedimos el ID si es autoincrementable (llave primaria)
                if($col['Extra'] != 'auto_increment') {
                    echo "<label>".$col['Field']."</label>";
                    echo "<input type='text' name='".$col['Field']."' placeholder='".$col['Field']."' required>";
                }
            }
            ?>
            <input type="submit" value="GUARDAR DATOS">
        </form>
        <a href="mostrar_datos.php?tabla=<?php echo $tabla; ?>">Cancelar</a>
    </div>
</body>
</html>