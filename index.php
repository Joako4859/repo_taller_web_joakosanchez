<?php include("conexion.php"); ?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Catálogo de Productos</title>
    <link rel="stylesheet" href="css/estilos.css">
</head>
<body>
    <h1>Catálogo de Productos</h1>

    <form method="GET" class="buscador">
        <input type="text" name="buscar" placeholder="Buscar producto..." value="<?php echo $_GET['buscar'] ?? '' ?>">
        <button type="submit">Buscar</button>
    </form>

    <div class="contenedor-productos">
        <?php
        $busqueda = $_GET['buscar'] ?? '';
        $sql = "SELECT * FROM productos WHERE nombre LIKE '%$busqueda%'";
        $resultado = mysqli_query($conexion, $sql);

        if (mysqli_num_rows($resultado) > 0) {
            while ($fila = mysqli_fetch_assoc($resultado)) {
                echo "
                <div class='producto'>
                    <img src='img/{$fila['imagen']}' alt='{$fila['nombre']}'>
                    <h3>{$fila['nombre']}</h3>
                    <p>{$fila['descripcion']}</p>
                    <span>\${$fila['precio']}</span>
                </div>
                ";
            }
        } else {
            echo "<p>No se encontraron productos.</p>";
        }
        ?>
    </div>

    <footer>
        <a href="./admin/panel.php">Panel de Administración</a>
    </footer>
</body>
</html>