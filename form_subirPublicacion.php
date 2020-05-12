<?php
    session_start();
    $var=$_SESSION['sesion'];
    if($var == null || $var = '' ){
        echo "Error al autentificar";
        header("Location:index.php?error=x");
    }
    
    $nombreArchivo=utf8_decode($_FILES['archivo']['name']);
        $rutaTemporal=$_FILES['archivo']['tmp_name'];
        //Datos para la base de datos sin decodificar cacteres
        $nombreArchivoBDD=$_FILES['archivo']['name'];
        $nombreDeConvocatoria=$_POST['titulo'];
        $descripcionConvocatoria=$_POST['descripcion'];
        $fechaExpiracion=$_POST['fechaDeExpiracion'];
        $horaExpiracion=$_POST['horaDeExpiracion'];
        $FechaHoraExpiracion= $fechaExpiracion." ".$horaExpiracion;

        date_default_timezone_set('America/La_Paz');
        $fechaActual=date("Y-m-d H:i:s");
        if(empty($fechaExpiracion) || empty($horaExpiracion)){
            $FechaHoraExpiracion=date("Y-m-d H:i:s",strtotime($fechaActual."+ 1 year"));
        }
        /*
        echo $codigoFecha."";
        echo $fechaExpiracion."\n";
        echo $horaExpiracion."\n";
        $FechaHoraExpiracion= $fechaExpiracion." ".$horaExpiracion;
        echo $FechaHoraExpiracion."<br>";
        */
        $direccionBaseDeDatos=('Publicaciones/'.$codigoFecha.$nombreArchivoBDD);
        if(file_exists('Publicaciones')){   
            if(move_uploaded_file($rutaTemporal,'Publicaciones/'.$codigoFecha.$nombreArchivo)){          
                //echo "<br>Se guardo el Archivo";                
                require_once('conexion.php');
                $conn=conectarBaseDeDatos();
                pg_query($conn,"INSERT INTO convocatoria(titulo,fecha,direcccion_pdf,descripcion_convocatoria,activo,fecha_expiracion) VALUES ('$nombreDeConvocatoria','$fechaActual','$direccionBaseDeDatos','$descripcionConvocatoria',TRUE,'$FechaHoraExpiracion')");
                echo "Se ha añadido el registro exitosamente";
                header("Location:CRUD_publicaciones.php");
            }else{
                echo "No se pudo gradar el archivo";
            }
        }else{
            echo "Carpeta Publicaciones no existe";
        }
       
?>



