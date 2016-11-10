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
            <div id="cuerpo">
                <center>
                    <?php
                        if(isset($_GET['selTabla']) || isset($_POST['insertar']))
                        {
                    ?>
                            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                                <table>
                                    <?php
                                    if(isset($_GET['selTabla']))
                                    {
                                        $nomTabla = $_GET['tablas'];
                                    }
                                    else
                                    {
                                        $nomTabla = $_POST['nomTabla'];
                                    }
                                        $metodos->selectTable($nomTabla);
                                    ?>
                                </table>
                                <input type="submit" value="insertar" class="boton" name="insertar" style="width: 70px;">
                            </form>
                    <?php
                        }
                        if(isset($_POST['insertar']))
                        {
                            $i=0;
                            $qwerty = "";
                            $nomTabla = $_POST['nomTabla'];
                            while(isset($_POST[$i+1]))
                            {
                                if($metodos->validarCampo($_POST[$i]) && $_POST[$i+1] !="")//ksjdfkjs
                                {
                                    $qwerty = $qwerty.$_POST[$i].',';
                                }
                                else if($metodos->validarCampo($_POST[$i]))
                                {
                                    $qwerty = $qwerty.$_POST[$i];
                                }
                                else if(!$metodos->validarCampo($_POST[$i]) && $_POST[$i+1] !="")
                                {
                                    $qwerty = $qwerty.'\''.$_POST[$i].'\',';
                                }
                                else
                                {
                                    $qwerty = $qwerty.'\''.$_POST[$i].'\'';
                                }
                                $i ++;
                            }
                            if($_POST[$i] != "")
                            {
                                $qwerty = $qwerty.'\''.$_POST[$i].'\'';
                            }
                            if($nomTabla != "empleado" && $nomTabla != "paciente" && $nomTabla != "conjunto_empleado" && $nomTabla != "conjunto_tecnica" && $nomTabla != "inventario_instrumento") //gggg que pendejo :v
                            {
                                $conection = pg_connect("host=localhost port=5432 dbname=anovack_proyB user=anovack password=bases1234")
                                    or die("<h3 class=\"mensaje\">no se pudo conectar a la base de datos</h3>");
                                $qwertyCol = "select COLUMN_NAME from INFORMATION_SCHEMA.COLUMNS
                                            where TABLE_NAME = '$nomTabla'";
                                $resultado = pg_exec($conection,$qwertyCol);
                                pg_close($conection);
                                $qwertyAux="";
                                $i = 0;
                                while ($row = pg_fetch_array($resultado))
                                {
                                    if($i == 1)
                                    {
                                        if($qwertyAux != "")
                                        {
                                            $qwertyAux = $qwertyAux.",".$row[0];
                                        }
                                        else
                                        {
                                            $qwertyAux = $row[0];
                                        }  
                                    }
                                    else
                                    {
                                        $i++;
                                    }                            
                                }
                                $qwertyEnviar = "insert into $nomTabla ($qwertyAux) values($qwerty)";
                            }
                            else
                            {
                                $qwertyEnviar = "insert into $nomTabla values($qwerty)";
                            }                           
                            $conection = pg_connect("host=localhost port=5432 dbname=anovack_proyB user=anovack password=bases1234")
                                or die("<h3 class=\"mensaje\">no se pudo conectar a la base de datos</h3>");
                            $resultado = pg_exec($conection,$qwertyEnviar)
                                or die("<h3 class=\"mensaje\">no se pudo realizar la consulta</h3>");
                            pg_close();
                            echo"<h3>el registro se ha realizado con exito</h3>";
                        }
                        if(!isset($_GET['selTabla']) && !isset($_POST['insertar']))
                        {
                            echo '<div style="margin-top: 200px;">
                                <center>
                                    Para agregar un elemento a la base de datos, primero seleccione el tipo de elemento en el menú desplegable de arriba y seleccione la opción de seleccionar tabla
                                </center>
                                </div>';
                        }
                    ?>
                </center>
            </div>
        </body>
    </html>