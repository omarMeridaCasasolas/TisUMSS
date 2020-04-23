<?php
    session_start();
    $var=$_SESSION['sesion'];
    if($var == null || $var = '' ){
        echo "Erro al autentificar";
        header("Location:index.php?error=x");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="Vista/bootstrap.css">
    <style type="text/css">
        #nuevaConvocatoria:link
        {
        text-decoration:none;
        }
    </style>
    <!-- 
    <script src="js/all.min.js"></script>
    -->
    <!--
        Iconos Onlinea con la respectiva cuenta
    -->
        <script src="https://kit.fontawesome.com/d848ccec99.js" crossorigin="anonymous"></script>
    
</head>
<body>
    <header class="bg-info w-100 p-4">
        <h4 class="font-italic">Bienvenda <?php echo $_SESSION['sesion']; ?></h4>
        <a href="form_cerrarSession.php" class="float-right text-dark">cerrar session</a>
    </header>
    <?php
    require_once('conexion.php');
    $conn=conectarBaseDeDatos();
    //Consulta para ordenar por fecha
    $consulta=pg_query($conn,"SELECT titulo,descripcion_convocatoria,fecha,direcccion_pdf,id_convocatoria FROM convocatoria WHERE activo='true' ORDER BY fecha desc");
    if (!$consulta) {
        echo "An error occurred.\n";
        exit;
    }

    echo "<main class='container mt-5'>
          <div class='table-responsive'>
            <table class='table table-hover'>
                <h3>Entradas de convocatoria</h3>
                <a href='secretaria.php' class='btn btn-success p-2 rounded-lg m-2' id='nuevaConvocatoria'>Crear nueva convocatoria</a>
                    <thead>
                        <tr>
                            <th>Entrada</th>
                            <th>PDF</th>
                            <th>Opciones</th>

                        </tr>
                    </thead>
                    <tbody>";
                        while($row=pg_fetch_row($consulta)){
                            $titulo=$row[0];
                            $fecha=$row[2];
                            $direcccion_pdf=$row[3];
                            $idConvocatoria=$row[4];
                            /*$valido=strlen($direcccion)-14;
                            $direcccion_pdf=substr($direcccion,0,$valido);*/
                            echo "<tr>
                                <td>$titulo<br>$fecha</td>
                                <td><a href='$direcccion_pdf' target='_blank'>$titulo</a></td>
                                <td>
                                    <a href='eliminarConvocatoria.php?id=$idConvocatoria' class='btn btn-danger' title='Eliminar'><i class='fas fa-trash-alt'></i></a>
                                    <a href='editarConvocatoria.php?id=$idConvocatoria' class='btn btn-primary' title='Editar'><i class='fas fa-edit'></i></a>
                                </td>
                            </tr>";
                        }
                    echo "</tbody>
                </table>
        </div>
    </main>";
    ?>
    
</body>

</html>