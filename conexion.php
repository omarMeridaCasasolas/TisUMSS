<?php
    //Conexion a un servidor Onlinea
    function conectarBaseDeDatos(){
        $connexion=pg_connect("host=ec2-52-201-55-4.compute-1.amazonaws.com port=5432 dbname=ddm5k6l3g5nntm user=erpgwqxdcmmizk password=d764438378b6a33d99872ff2f4321949530f5f26e8271e10fb80ece8311e701a") or die ('No se ha podido conectar: '.pg_last_error());
        return $connexion;
    }
     //Connecion mediante localHost
    /* 
    function conectarBaseDeDatos(){
        $connexion=pg_connect("host=localhost port=5433 dbname=tis user=postgres password=kirium") or die ('No se ha podido conectar: '.pg_last_error());
        return $connexion;
    }
    */
?>