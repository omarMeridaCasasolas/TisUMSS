<?php
    session_start();
    $var=$_SESSION['sesion'];
    if($var == null || $var = '' ){
        echo "Erro al autentificar";
        header("Location:index.php?error=x");
    }
    $nombreArchivo=utf8_decode($_FILES['archivo']['name']);
        $rutaTemporal=$_FILES['archivo']['tmp_name'];
        //Datos para la base de datos sin decodificar cacteres
        $nombreArchivoBDD=$_FILES['archivo']['name'];
        $nombreDeConvocatoria=$_POST['titulo'];
        $descripcionConvocatoria=$_POST['descripcion'];
        date_default_timezone_set('America/La_Paz');
        $fechaActual=date("Y-m-d H:i:s");
        $codigoFecha=date("YmdHis");
        //echo "$nombreArchivo";
        $direccionBaseDeDatos=('Publicaciones/'.$codigoFecha.$nombreArchivoBDD);
        if(file_exists('Publicaciones')){   
            if(move_uploaded_file($rutaTemporal,'Publicaciones/'.$codigoFecha.$nombreArchivo)){          
                //echo "<br>Se guardo el Archivo";                
                require_once('conexion.php');
                $conn=conectarBaseDeDatos();
                pg_query($conn,"INSERT INTO convocatoria(titulo,fecha,direcccion_pdf,descripcion_convocatoria,activo) VALUES ('$nombreDeConvocatoria','$fechaActual','$direccionBaseDeDatos','$descripcionConvocatoria',TRUE)");
                header("Location:CRUD_publicaciones.php");
            }else{
                echo "No se pudo gradar el archivo";
            }
        }else{
            echo "Carpeta Publicaciones no existe";
        }
?>



