<?php

    include('config.php');

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    <h1>SIMULAR UN SELECT OPTION EN UNA MODIFICACIÓN v1</h1><br><br>

    <h3>Versión 1: Usando dos selects</h3>
    <form action="index.php" method="POST">
        <label>Elige el id de la visita: </label><input type="number" name="idvisita">
        <input type="submit" name="buscar" value="Buscar">
    </form>

    <?php

        if(isset($_POST['buscar'])) // && isset($_POST['idvisita'])
        {
            
            $idvisita = $_POST['idvisita'];

            //$consulta = 'SELECT ip FROM visita WHERE idVisita = '.$idvisita.''; La hice primero para ir haciendo el ejercicio poco a poco

            //$consulta = 'SELECT lugar.ip, lugar FROM lugar INNER JOIN visita ON lugar.ip = visita.ip WHERE idVisita = '.$idvisita.''; // ERROR ES MUCHO ES MEJOR HACERLO CON DOS CONSULTAS INDEPENMDIENTES 
            //PRIEMRO UNA QUE SAQUE EL IP DE LA TABLA VISITA Y LUEGO OTRA QUE SAQUE EL NOMBRE CON EL IP ANTERIOR DE LA TABLA LUGARES
            //CON ESTA SOLUCIÓN GANAMOS MUCHO RENDIMIENTO
            $consulta0 = 'SELECT ip from visita WHERE idVisita = '.$idvisita.'';

            $query = $conectar->query($consulta0);

            if($query->num_rows > 0)
            {

                $file = mysqli_fetch_array($query);

                $ip10 = $file['ip'];

                $consulta = "SELECT lugar from lugar WHERE ip = '".$ip10."'";

                $dato = $conectar->query($consulta); //ESTO DEVUELBE UN  OBJETO MYSQLI_RESULT

                
                //TIENE QUE HABER UN SELECT Y UN OPTION FIJOS
                // Y DENTRO DEBE HABER UN OPTION DINAMICO DENTRO DE UN WHILE Y DENTRO UN IF PARA SABER QUE NO SE REPITA POR EJEMPLO SI NO QUEREMOS 
                //MOSTRAR EL IP(LUGAR) = 3 DECIMOS QUE LO RECORRA (QUE MUESTRE LAS FILAS) SI EL IP<>3 IF($_POST['ip']<>3) que muestre los lugares

                if($dato->num_rows > 0) //NUM_ROWS ES DE LA CLASE 
                {
                    
                    // $contador = 2;

                    while($fila = $dato->fetch_array())//($fila = mysqli_fetch_array(($dato), MYSQLI_ASSOC)) //ERROR GUARDAR UN VALOR EN UNA VARIABLE DENTRO DE UN WHILE NO TIENE
                    //MUCHO SENTIDO YA QUE ES UN PROCESO QUE SE VA REPETIR Y SE GUARDARÁ EL ULTIMO VALOR QUE ESTE AL RECORRER EL WHILE POR ULTIMA
                    //VEZ, EN ESTE CASO EL WHILE SOLO SE VA A EJECUTAR UNA UNICA VEZ POR ESO ES MAS CORRECTO QUITAR EL WHILE
                    {

                        var_dump($dato);

                        echo('<br/><br/>');

                        //echo($fila['ip']);

                        //$ip = $fila['ip'];
                        $ip = $ip10;

                        echo('<select><option value="1">'.$fila['lugar'].'</option>'); //</select>
                    }



                    //$consulta2 = "SELECT lugar from lugar WHERE ip NOT IN ('$ip')"; //ERROR EL IN ES PARA UNA LISTA DE VALORES, HAY QUE PONER UN IGUAL O DESIGUAL
                    $consulta2 = "SELECT lugar from lugar WHERE ip <> ('$ip')"; //Si solo queremos decirle que sea direfente a un solo valor usamos el operador '<>'

                    $datos2 = $conectar->query($consulta2);

                    if($datos2->num_rows > 0)
                    {
                        //echo('<select>');
                        $contador3 = 1;

                        while($filas = mysqli_fetch_array(($datos2), MYSQLI_ASSOC))
                        {
                            echo('<option value="'.$contador3.'">'.$filas['lugar'].'</option>');
                            $contador3 = $contador3 + 1;
                        }

                        echo('</select>');
                    }

                    /*if($fila['ip'] <> $ip)
                    {
                        echo('<select><option value="'.$contador.'">'.$fila['lugar'].'</option></select>');
                    }

                    $contador = $contador + 1; */
                    
                }
                else{
                    echo('Este id no corresponde a ninguna visita');
                }
            }
            else{
                echo('El id '.$idvisita.' no corresponde a ninguna visita');
            }

            /*
            $consulta2 = 'SELECT lugar, visita.ip FROM lugar INNER JOIN visita ON lugar.ip = visita.ip';

            $dato2 = $conectar->query($consulta2);

            $contador = 1;

            echo('<select>');

            while($fila2 = mysqli_fetch_array(($dato2), MYSQLI_ASSOC))
            {
                echo('<option value="'.$contador.'">'.$fila2['lugar'].'</option>');

                $contador = $contador + 1;
            }

            echo('</select>');*/
        }

    ?>


    

</body>
</html>