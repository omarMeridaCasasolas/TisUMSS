<?php
    session_start();
    $var=$_SESSION['sesion'];
    if($var == null || $var = '' ){
        echo "Error al autentificar";
        header("Location:index.php?error=x");
    }
    $nombreArchivo=eliminar_acentos($_FILES['archivo']['name']);
        $rutaTemporal=$_FILES['archivo']['tmp_name'];
        //Datos para la base de datos sin decodificar caracteres
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
        $codigoFecha=date("Ymdhis");
        $direccionBaseDeDatos=('Publicaciones/'.$codigoFecha.$nombreArchivo);
        if(file_exists('Publicaciones')){             
            $myVariable=utf8_encode($nombreArchivo);
            if(move_uploaded_file($rutaTemporal,'Publicaciones/'.$codigoFecha.$nombreArchivo)){                    
                require_once('conexion.php');
                $conn=conectarBaseDeDatos();
                pg_query($conn,"INSERT INTO convocatoria(titulo,fecha,direcccion_pdf,descripcion_convocatoria,activo,fecha_expiracion) VALUES ('$nombreDeConvocatoria','$fechaActual','$direccionBaseDeDatos','$descripcionConvocatoria',TRUE,'$FechaHoraExpiracion')");
                //echo "Se ha añadido el registro exitosamente";
                header("Location:CRUD_publicaciones.php");
            }else{
                echo "No se pudo gradar el archivo";
            }
        }else{
            echo "Carpeta Publicaciones no existe";
        }

function eliminar_acentos($cadena){
		
		//Reemplazamos la A y a
		$cadena = str_replace(
		array('Á', 'À', 'Â', 'Ä', 'á', 'à', 'ä', 'â', 'ª'),
		array('A', 'A', 'A', 'A', 'a', 'a', 'a', 'a', 'a'),
		$cadena
		);
 
		//Reemplazamos la E y e
		$cadena = str_replace(
		array('É', 'È', 'Ê', 'Ë', 'é', 'è', 'ë', 'ê'),
		array('E', 'E', 'E', 'E', 'e', 'e', 'e', 'e'),
		$cadena );
 
		//Reemplazamos la I y i
		$cadena = str_replace(
		array('Í', 'Ì', 'Ï', 'Î', 'í', 'ì', 'ï', 'î'),
		array('I', 'I', 'I', 'I', 'i', 'i', 'i', 'i'),
		$cadena );
 
		//Reemplazamos la O y o
		$cadena = str_replace(
		array('Ó', 'Ò', 'Ö', 'Ô', 'ó', 'ò', 'ö', 'ô'),
		array('O', 'O', 'O', 'O', 'o', 'o', 'o', 'o'),
		$cadena );
 
		//Reemplazamos la U y u
		$cadena = str_replace(
		array('Ú', 'Ù', 'Û', 'Ü', 'ú', 'ù', 'ü', 'û'),
		array('U', 'U', 'U', 'U', 'u', 'u', 'u', 'u'),
		$cadena );
 
		//Reemplazamos la N, n, C y c
		$cadena = str_replace(
		array('Ñ', 'ñ', 'Ç', 'ç'),
		array('N', 'n', 'C', 'c'),
		$cadena
		);
		
		return $cadena;
	}

?>



