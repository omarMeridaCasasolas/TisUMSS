<?php
    session_start();
    $var=$_SESSION['sesion'];
    if($var == null || $var = '' ){
        echo "Erro al autentificar";
        header("Location:index.php?error=x");
    }
?>
<?php
     require_once('conexion.php');
     $conn=conectarBaseDeDatos();
    if(isset($_GET['id'])){
        $id=$_GET['id'];  
        $consulta=pg_query($conn,"SELECT titulo,descripcion_convocatoria,fecha,direcccion_pdf,id_convocatoria FROM convocatoria WHERE id_convocatoria='$id'");
        if (!$consulta) {
            echo "An error occurred.\n";
            exit;
        }else{
            $row=pg_fetch_row($consulta);
        }

    }else{
        echo "Error";
    }
    //
    if(isset($_POST['update'])){
        $nuevoTitulo=$_POST['titulo'];
        $nuevaDescrpcion=$_POST['descripcion'];
        date_default_timezone_set('America/La_Paz');
        $nuevaFecha=date("Y-m-d H:i:s");
        $Actualizar=pg_query($conn,"UPDATE convocatoria SET titulo='$nuevoTitulo', descripcion_convocatoria='$nuevaDescrpcion' ,fecha='$nuevaFecha' WHERE id_convocatoria=$id");
        if (!$Actualizar) {
            echo "An error occurred.\n";
            exit;
        }else{
            header("Location:CRUD_publicaciones.php");
        }

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
            <script src="https://kit.fontawesome.com/d848ccec99.js" crossorigin="anonymous"></script>
        </head>

        <body class="cuerpo">
            <header class="bg-info w-100 p-4">
                <h4 class="font-italic"><i class="fas fa-users"></i>  Bienvenda <?php echo $_SESSION['sesion']; ?></h4>
                <a href="CRUD_publicaciones.php" class="float-right text-dark">Convocatorias</a>
                <br>
                <a href="form_cerrarSession.php" class="float-right text-dark">cerrar session</a>
            </header>

            <div id="idConvicatoria" class="mx-auto w-75 p-4 my-5 border border-primary bg-secondary">
            <h1>Editar Convocatoria</h1>
            <form action="editarConvocatoria.php?id=<?php echo $id; ?>" method="post" enctype="multipart/form-data">
                <input type="text" name="titulo" id="titulo" placeholder="Titulo" autocomplete="off" required value='<?php echo $row[0] ?>'>
                <br>
                <br>
                <textarea id="descripcion" rows="10" cols="190" name="descripcion" style="resize:none; width:100%;"><?php echo $row[1] ?></textarea>
                <br>
                <br>
                <input type="file" name="archivo" id="archivo" accept='.pdf'> 
                <br>
                <br>
                <button class="d-block mx-auto btn btn-primary" name="update">Actualizar</button>
            </form>
            </div>
        </body>

    <footer class="pieIndice">
        <div class="text-center">
            <h6 class="d-inline-block">Contacto: <a href="">correo_del_Administardor@mail.com ,</a> <a href="">  correo_de_la_Empresa@mail.com</a></h6>
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
</html>