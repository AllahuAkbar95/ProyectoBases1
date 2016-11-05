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
                        if(isset($_POST['selTabla']) || isset($_POST['insertar']))
                        {
                    ?>
                            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                                <table>
                                    <?php
                                    if(isset($_POST['selTabla']))
                                    {
                                        $nomTabla = $_POST['tablas'];
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
                                if($metodos->validarCampo($_POST[$i]))
                                {
                                    $qwerty = $qwerty.$_POST[$i].',';
                                }
                                else
                                {
                                    $qwerty = $qwerty.'\''.$_POST[$i].'\',';
                                }
                                $i ++;
                            }
                            $qwerty = $qwerty.'\''.$_POST[$i].'\'';
                            $qwertyEnviar = "insert into $nomTabla values($qwerty)";
                            //$conection =$metodos->conectar();
                            $conection = pg_connect("host=localhost port=5432 dbname=anovack_proyB user=anovack password=bases1234")
                                or die("<h3 class=\"mensaje\">no se pudo conectar a la base de datos</h3>");
                            $resultado = pg_exec($conection,$qwertyEnviar)
                                or die("<h3 class=\"mensaje\">no se pudo realizar la consulta</h3>");
                            pg_close();
                            echo"<h3>el registro se ha realizado con exito</h3>";
                        }
                        if(!isset($_POST['selTabla']) && !isset($_POST['insertar']))
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