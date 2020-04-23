<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="CSS/bootstrap.css">
</head>
<body class="bg-info">
<?php
    if(isset($_GET['error'])){
        echo "<script>";
        echo    "alert('Error al autentificar');";
        echo "</script>";
    }
?>
    <div class="d-inline-block w-25 m-5 border border-dark p-2">
    <form action="verificarUsuario.php" method="post">
        <p>Login: <input type="mail" name="IdUsuaario" id="" pattern="^([a-z0-9_\.-]+)@([\da-z\.-]+)\.([a-z\.]{2,6})$" autocomplete='off'></p>
        <p>Password: <input type="password" name="IdPassword" id="" pattern="^[a-z0-9_-]{3,30}"></p>
        <input type="submit" value="Entrar">
    </form>
    </div>
    <div class="m-4 d-inline-block w-50 ">
        <h1 class="text-center" >Publicaciones</h1>
        <?php
            require_once('conexion.php');
            $conn=conectarBaseDeDatos();
            //Consulta para ordenar por fecha
            $consulta=pg_query($conn,"SELECT titulo,descripcion_convocatoria,fecha,direcccion_pdf FROM convocatoria WHERE activo='true' ORDER BY fecha desc");
            if (!$consulta) {
                echo "An error occurred.\n";
                exit;
            }
            while($row = pg_fetch_row($consulta)){
                $titulo=$row[0];
                $descripcion=$row[1];
                $fecha=$row[2];
                $direcccion_pdf=$row[3];
                echo "<h2>$titulo</h2>";
                echo "<h5>Descripcion del documento</h5>";
                echo "<h6>$descripcion</h6>";
                echo "<a href='$direcccion_pdf' target='_blank' >Abrir archivo $titulo</a>";
                echo "<p class='float-right'>$fecha</p>";
                echo "<hr>";
            }
        ?>
    </div>

</body>
</html>