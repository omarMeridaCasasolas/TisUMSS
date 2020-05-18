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
    <link rel="stylesheet" href="Vista/header.css">
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
        <h4 class="font-italic"><i class="fas fa-users"></i>  Bienvenda <?php echo $_SESSION['sesion']; ?></h4>
        <a href="form_cerrarSession.php" class="float-right text-dark">cerrar session</a>
    </header>
    <?php
    require_once('conexion.php');
    $conn=conectarBaseDeDatos();
    //Consulta para ordenar por fecha
    $consulta=pg_query($conn,"SELECT titulo,descripcion_convocatoria,fecha,direcccion_pdf,id_convocatoria,fecha_expiracion FROM convocatoria WHERE activo='true' ORDER BY fecha desc");
    if (!$consulta) {
        echo "An error occurred.\n";
        exit;
    }
    
    echo "<main class='container mt-5'>
          <div class='table-responsive'>
            <table class='table table-hover'>
                <h3>Entradas de convocatoria</h3>
                <a href='crearPublicacion.php' class='btn btn-success p-2 rounded-lg m-2' id='nuevaConvocatoria'>Crear nueva convocatoria</a>
                    <thead class='bg-primary'>
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
                            $fechaDeExpiracion=$row[5];
                            /*$valido=strlen($direcccion)-14;
                            $direcccion_pdf=substr($direcccion,0,$valido);*/
                            echo "<tr>
                                <td> $titulo <h6>Publicado: $fecha </h6><h6>Expiracion: $fechaDeExpiracion</h6></td>
                                <td>
                                    <a  href='$direcccion_pdf' target='_blank'>Abrir  $titulo</a>
                                </td>
                                <td>
                                    <a href='form_eliminarConvocatoria.php?id=$idConvocatoria' class='btn btn-danger' title='Eliminar'><i class='fas fa-trash-alt'></i></a>
                                    <a href='editarConvocatoria.php?id=$idConvocatoria' class='btn btn-primary' title='Editar'><i class='fas fa-edit'></i></a>
                                </td>
                            </tr>";
                        }
                    echo "</tbody>
                </table>
        </div>
    </main>";
    ?>

    <footer class="pieIndice">
        <div class="text-center">
            <h6 class="d-inline-block">Contacto: <a href="">correo_del_Administardor@mail.com ,</a> <a href="">  correo_de_la_Empresa@mail.com</a></h6>
            <h6 class="d-inline-block">Telefono: (+591) 72584871 Administrador, (+591) 77581871 Secretaria</h6 >
        </div>
        <div class="text-center">
            <h6>Sitios Relacionados : 
                <a href="http://www.umss.edu.bo/">UMSS</a>
                <a href="http://websis.umss.edu.bo/"> | WEBSISS</a>
                <a href="https://www.facebook.com/UmssBolOficial"> | facebook</a>
                <a href="https://twitter.com/UmssBolOficial"> | Twitter</a>
                <a href="https://www.instagram.com/umssboloficial/"> | Instagram</a>
                <a href="https://www.linkedin.com/school/universidad-mayor-de-san-simon/"> | Linkedin</a>
                <a href="https://www.youtube.com/universidadmayordesansimon"> | Youtube</a>                
            </h6>
        </div>
        <div class="text-center">
            <h6>Derechos Reservados © 2020 · Universidad Mayor de San Simón.</h6>
        </div>
    </footer>

</body>

</html>