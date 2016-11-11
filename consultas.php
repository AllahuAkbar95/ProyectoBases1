<!DOCTYPE html>
    <html>
        <head>
            <link href="css/estilo.css" rel="stylesheet" type="text/css">
            <?php include("metodos.php");
                $metodos = new metodos;?>
            <script type="text/javascript" src="Scripts.js"></script>
        </head>
        <body>
            <?php $metodos->encabezado(); ?>
            <center>
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="get">
                    <table>
                        <tr><td><input type="submit" class="boton" value="Numero de empleados asignados por sucursal" name="consulta1"></td>
                            <td><input type="submit" class="boton" value="Empleados que ganan por profesion entre 100000 y 300000" name="consulta2"></td>
                            <td><input type="submit" class="boton" value="Datos de pacientes cuyo nombre empiece por a" name="consulta3"></td>
                            <td><input type="submit" class="boton" value="Numero de sucursales por pais" name="consulta4"></td>
                            <td><input type="submit" class="boton" value="Asignaciones y cuantas tecnicas e instrumentos tienen" name="consulta5"></td>
                        </tr>
                    </table>
                </form>
                <?php
                    echo'<table border="2">';
                    if(isset($_GET['consulta1']))
                    {
                        $conection = pg_connect("host=localhost port=5432 dbname=anovack_proyB user=anovack password=bases1234")
                                    or die("<h3 class=\"mensaje\">no se pudo conectar a la base de datos</h3>");
                        $qwerty = "select nom_sucursal,count(cod_empleado)
                                    from conjunto_empleado,asignacion,sucursal
                                    where asignacion.cod_asignacion = conjunto_empleado.cod_asignacion
                                    and asignacion.cod_sucursal = sucursal.cod_sucursal
                                    group by(nom_sucursal);";
                        $resultado = pg_exec($conection,$qwerty)
                            or die("<h3>no se pudo realizar la consulta</h3>");
                        pg_close($conection);
                        $i =0;
                        echo "<tr>
                                <td>Nombre de la sucursal</td>
                                <td>Numero de empleados asignados</td></tr>";
                        while($row = pg_fetch_array($resultado))
                        {
                            echo"<tr>";
                            while(isset($row[$i]))
                            {
                                echo "<td>".$row[$i]."</td>";
                                $i++;
                            }
                            $i=0;
                            echo"</tr>";
                        }
                    }
                    else if(isset($_GET['consulta2']))
                    {
                        $conection = pg_connect("host=localhost port=5432 dbname=anovack_proyB user=anovack password=bases1234")
                                    or die("<h3 class=\"mensaje\">no se pudo conectar a la base de datos</h3>");
                        $qwerty = "select nom_empleado, sum(salario_profesion)
                                    from empleado,profesion
                                    where empleado.cod_profesion = profesion.cod_profesion
                                    and salario_profesion   between 100000 and 300000
                                    group by (nom_empleado);";
                        $resultado = pg_exec($conection,$qwerty)
                            or die("<h3>no se pudo realizar la consulta</h3>");
                        pg_close($conection);
                        $i =0;
                        echo "<tr>
                                <td>Nombre del empleado</td>
                                <td>Salario por profesion</td></tr>";
                        while($row = pg_fetch_array($resultado))
                        {
                            echo"<tr>";
                            while(isset($row[$i]))
                            {
                                echo "<td>".$row[$i]."</td>";
                                $i++;
                            }
                            $i =0;
                            echo"</tr>";
                        }

                    }
                    else if(isset($_GET['consulta3']))
                    {
                        $conection = pg_connect("host=localhost port=5432 dbname=anovack_proyB user=anovack password=bases1234")
                                    or die("<h3 class=\"mensaje\">no se pudo conectar a la base de datos</h3>");
                        $qwerty = "select * from paciente
                                    where nom_paciente like 'a%';";
                        $resultado = pg_exec($conection,$qwerty)
                            or die("<h3>no se pudo realizar la consulta</h3>");
                        pg_close($conection);
                        $i =0;
                        echo "<tr>
                                <td>Documento</td>
                                <td>nombre</td>
                                <td>apellido</td></</tr>";
                        while($row = pg_fetch_array($resultado))
                        {
                            echo"<tr>";
                            while(isset($row[$i]))
                            {
                                echo "<td>".$row[$i]."</td>";
                                $i++;
                            }
                            $i =0;
                            echo"</tr>";
                        }

                    }
                    else if(isset($_GET['consulta4']))
                    {
                        $conection = pg_connect("host=localhost port=5432 dbname=anovack_proyB user=anovack password=bases1234")
                                    or die("<h3 class=\"mensaje\">no se pudo conectar a la base de datos</h3>");
                        $qwerty = "select nom_pais, count(cod_sucursal)
                                    from sucursal,ciudad,pais
                                    where pais.cod_pais = ciudad.cod_pais
                                    and ciudad.cod_ciudad = sucursal.cod_ciudad
                                    group by(nom_pais);";
                        $resultado = pg_exec($conection,$qwerty)
                            or die("<h3>no se pudo realizar la consulta</h3>");
                        pg_close($conection);
                        $i =0;
                        echo "<tr>
                                <td>pais</td>
                                <td>cantidad de sucursales</td></tr>";
                        while($row = pg_fetch_array($resultado))
                        {
                            echo"<tr>";
                            while(isset($row[$i]))
                            {
                                echo "<td>".$row[$i]."</td>";
                                $i++;
                            }
                            $i =0;
                            echo"</tr>";
                        }

                    }
                    else if(isset($_GET['consulta5']))
                    {
                        $conection = pg_connect("host=localhost port=5432 dbname=anovack_proyB user=anovack password=bases1234")
                                    or die("<h3 class=\"mensaje\">no se pudo conectar a la base de datos</h3>");
                        $qwerty = "select cod_asignacion, count(cod_tecnica) as \"cantidad_tecnicas\", count(cod_instrumento) as \"cantidad_instrumentos\"
                                    from asignacion,tratamiento,conjunto_tecnica,inventario_instrumento
                                    where asignacion.cod_tratamiento = tratamiento.cod_tratamiento
                                    and tratamiento.cod_tratamiento = conjunto_tecnica.cod_tratamiento
                                    and tratamiento.cod_tratamiento = inventario_instrumento.cod_tratamiento
                                    group by (cod_asignacion);";
                        $resultado = pg_exec($conection,$qwerty)
                            or die("<h3>no se pudo realizar la consulta</h3>");
                        pg_close($conection);
                        $i =0;
                        echo "<tr>
                                <td>codigo de la asignacion</td>
                                <td>cantidad de tecnicas</td>
                                <td>cantidad de instrumentos</td></tr>";
                        while($row = pg_fetch_array($resultado))
                        {
                            echo"<tr>";
                            while(isset($row[$i]))
                            {
                                echo "<td>".$row[$i]."</td>";
                                $i++;
                            }
                            $i =0;
                            echo"</tr>";
                        }

                    }
                    echo"</table>";
                ?>
            </center>
        </body>
    </html>