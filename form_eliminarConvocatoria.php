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
        //Eliminar registro DELETE FROM convocatoria where id_convocatoria=$id
        $consulta=pg_query($conn,"UPDATE convocatoria SET activo=false WHERE id_convocatoria=$id");
        if (!$consulta) {
            echo "An error occurred.\n";
            exit;
        }else{
            header("Location:CRUD_publicaciones.php");
        }

    }else{
        echo "Error";
    }


?>