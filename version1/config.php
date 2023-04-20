<?php
    //Archivo de configuracion donde generamos los datos para l aconexion con la base de datos

    /* Forma correcta de generar los datos de conexion con la base de datos */ 
    DEFINE ('SERVIDOR', '2daw.esvirgua.com');
    DEFINE ('USUARIO', 'user2daw_19');
    DEFINE ('PASSWORD', 'M^wPDCC_z3~0');
    DEFINE ('BBDD', 'user2daw_BD1-19');

    /* Forma incorrecta de generar los datos de conexion con la base de datos
    $servidor = '2daw.esvirgua.com';
    $usuario = 'user2daw_19';
    $password = 'M^wPDCC_z3~0';
    $bbdd = 'user2daw_BD1-19'; 
    */


    //Ahora realizamos el proceso de conexion

    //$conectar = new mysqli($servidor, $usuario, $password, $bbdd);
    $conectar = new mysqli(SERVIDOR, USUARIO, PASSWORD, BBDD);
    $conectar->set_charset('utf8'); 

?>