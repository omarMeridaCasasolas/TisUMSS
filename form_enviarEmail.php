<?php 
    if(isset($_POST['reenvio_Pass'])){
        $correDestino=$_POST['reenvio_Pass'];
        require_once('conexion.php');
        $conn=conectarBaseDeDatos();
        $consulta=pg_query($conn,"SELECT * FROM ADMINISTRATIVO WHERE correo_Administrativo='$correDestino'");
        if(pg_fetch_row($consulta)>0){
            $getPassword=pg_query($conn,"SELECT password_administrativo FROM ADMINISTRATIVO WHERE correo_Administrativo='$correDestino'");
            $resultado=pg_fetch_row($getPassword);
            $mensaje=" Saludos ".$correDestino." aqui su contraseña correspondiente ".$resultado[0];
            echo "Se envio correctamente el mensaje".$mensaje;
            //email($correDestino,"Recuperacion de password",$mensaje);
        }else{
            header("Location:login.php?error=y");
        }
    }else{
        header("Location:login.php?error=x");
    }
?>