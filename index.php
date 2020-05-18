<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Universidad Mayor de San simon</title>
    <link rel="stylesheet" href="Vista/bootstrap.css">
    <link rel="stylesheet" href="Vista/header.css">
</head>
<body>
    <?php
        if(isset($_GET['error'])){
            echo "<script>";
            echo    "alert('Error al autentificar');";
            echo "</script>";
        }
    ?>

    <header>    
        <nav class="navegador d-block h-50">
            <ul class="menu">
                <li><a href="">Inicio</a></li>
                <li><a href="">Personal</a></li>
                <li> Descripcion
                    <ul class="submenu">
                        <li><a href="">Descripcion</a></li>
                        <li><a href="">Descripcion</a></li>
                        <li><a href="">Descripcion</a></li>
                        <li><a href="">Descripcion</a></li>
                    </ul>
                </li>
                <li><a href="">Contactenos</a></li>
                <li><a href="login.php">Inicio session</a></li>
                <div id="contenedorDeBusqueda" class="bg-danger float-right m-1 p-1">
                    <form action=""  class="d-flex" method="get">
                        <input  type="search" name="buscadorConvocatorias" id="buscadorConvocatorias" placeholder="&#8981;"> 
                        <input  type="submit" value="Buscador">
                    </form>
                </div>
            </ul>
        </nav>
    </header>

    <!--Convocatorias-->
    <section>
        <div class="d-block w-75 mx-auto">
            <h2 class="text-center" >Publicaciones de Convocatorias</h2>
        
            <?php
                require_once('conexion.php');
                $conn=conectarBaseDeDatos();
                //Consulta para ordenar por fecha
                date_default_timezone_set('America/La_Paz');
                $fechaActual=date("Y-m-d H:i:s");
                $consulta=pg_query($conn,"SELECT titulo,descripcion_convocatoria,fecha,direcccion_pdf FROM convocatoria WHERE activo='true' AND '$fechaActual' <= fecha_expiracion ORDER BY fecha desc");
                if (!$consulta) {
                    echo "An error occurred.\n";
                    exit;
                }
                $variable=pg_num_rows($consulta);
                if($variable>0){
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
                }
            ?>
        </div>

    </section>

    <footer class="pieIndice">
        <div class="text-center">
            <h6 class="d-inline-block">Contacto: <a  href="mailto:elcorreoquequieres@correo.com">correo_del_Administardor@mail.com ,</a> <a  href="mailto:elcorreoquequieres@correo.com">  correo_de_la_Empresa@mail.com</a></h6>
            <h6 class="d-inline-block">Telefono: (+591) 72584871 Administrador, (+591) 77581871 Secretaria</h6 >
        </div>
        <div class="text-center">
            <h6>Sitios Relacionados : 
                <a href="http://www.umss.edu.bo/" target="_blank">UMSS</a>
                <a href="http://websis.umss.edu.bo/" target="_blank"> | WEBSISS</a>
                <a href="https://www.facebook.com/UmssBolOficial" target="_blank"> | facebook</a>
                <a href="https://twitter.com/UmssBolOficial" target="_blank"> | Twitter</a>
                <a href="https://www.instagram.com/umssboloficial/" target="_blank"> | Instagram</a>
                <a href="https://www.linkedin.com/school/universidad-mayor-de-san-simon/" target="_blank"> | Linkedin</a>
                <a href="https://www.youtube.com/universidadmayordesansimon" target="_blank"> | Youtube</a>                
            </h6>
        </div>
        <div class="text-center">
            <h6>Derechos Reservados © 2020 · Universidad Mayor de San Simón.</h6>
        </div>
    </footer>
</body>
</html>