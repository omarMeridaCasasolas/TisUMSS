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
        $nuevaFecha=date("Y-m-d H:i:s", (strtotime ("-6 Hours")));
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
        </head>
        <body>
        <header class="bg-info w-100 p-4">
        <h4 class="font-italic">Bienvenda <?php echo $_SESSION['sesion']; ?></h4>
        <a href="form_cerrarSession.php" class="float-right text-dark">cerrar session</a>
    </header>
            <div id="idConvicatoria" class="mx-auto w-75 p-4 my-5 border border-primary">
            <h1>Publicar Convocatoria</h1>
            <form action="editarConvocatoria.php?id=<?php echo $id; ?>" method="post" enctype="multipart/form-data">
                <input type="text" name="titulo" id="titulo" placeholder="Titulo" autocomplete="off" required value='<?php echo $row[0] ?>'>
                <br>
                <br>
                <textarea id="descripcion" rows="10" cols="190" name="descripcion" style="resize:none;"><?php echo $row[1] ?></textarea>
                <br>
                <br>
                <input type="file" name="archivo" id="archivo" accept='.pdf'> 
                <br>
                <br>
                <button class="d-block mx-auto btn btn-primary" name="update">Actualizar</button>
            </form>
            </div>
        </body>
</html>