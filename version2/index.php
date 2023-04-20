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

        <h1>SIMULAR UN SELECT OPTION EN UNA MODIFICACIÓN v2</h1><br><br>

        <h3>Versión 2: Usando un unico select</h3>
        <form action="index.php" method="POST">
            <label>Elige el id de la visita: </label><input type="number" name="idvisita">
            <input type="submit" name="buscar" value="Buscar">
        </form>

        <?php

            if(isset($_POST['buscar']))
            {
                $idvisita = $_POST['idvisita'];

                $consulta = 'SELECT ip from visita WHERE idVisita = '.$idvisita.'';

                $datos = $conectar->query($consulta);

                if($datos->num_rows > 0)
                {
                    $filas = mysqli_fetch_array($datos);
                    $ip = $filas['ip'];

                    //echo($ip);



                    //Consulta 2 para sacar los lugares de la tabla lugares
                    $consulta2 = 'SELECT * from lugar';

                    $data = $conectar->query($consulta2);

                    echo('<select>');

                    while($rows = mysqli_fetch_array($data)) //AND $rows['ip'] == $ip) 
                    {
                        if($rows['ip'] == $ip)
                        {
                            echo('<option value="1">'.$rows['lugar'].'</option>');
                            break;
                        }

                        //echo('<option value="1">'.$rows['lugar'].'</option>');
                    }

                    //echo('Hola');

                    $data->data_seek(0); //Movemos el puntero al principio

                    $contador = 2;

                    while($rows = mysqli_fetch_array($data))
                    {
                        if($rows['ip'] <> $ip)
                        {
                            echo('<option value="'.$contador.'">'.$rows['lugar'].'</option>'); 
                        }

                        $contador = $contador + 1;
                    }

                    echo('</select>');

                }
                else{
                    echo('El id '.$idvisita.' no correponde con niguna visita');
                }
                
            }

        ?>

    </body>
</html>