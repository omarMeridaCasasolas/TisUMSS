<?php 
    if((strlen($_POST['IdUsuaario'])>0) && (strlen($_POST['IdPassword'])>0)){
        $usuario=$_POST['IdUsuaario'];
        $pass=$_POST['IdPassword'];
        /*ingresar sin conexion a la base de datos    
        if($usuario=='secretaria@gmail.com' && $pass== '123'){
            header("Location:secretaria.php");
        }else{
            echo "persona no encontrada";
        }
        */
        require_once('conexion.php');
        $conn=conectarBaseDeDatos();
        $consulta=pg_query($conn,"SELECT * FROM ADMINISTRATIVO WHERE correo_Administrativo='$usuario' AND password_administrativo='$pass'");
        if(pg_fetch_row($consulta)>0){
            //para iniciar sesion
            $getnombre=pg_query($conn,"SELECT nombre_administrativo FROM ADMINISTRATIVO WHERE correo_Administrativo='$usuario' AND password_administrativo='$pass'");
            $row=pg_fetch_row($getnombre);
            session_start();
            $_SESSION['sesion']=$row[0];
            header("Location:CRUD_publicaciones.php");
        }else{
            echo "Error al autentificar";
            header("Location:index.php?error=x");
        }
    }else{     
    echo "Eror al autentificar";
    header("Location:index.php?error=y");
    }
?>