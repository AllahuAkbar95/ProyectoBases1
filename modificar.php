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
            <div id="modificar">
                <?php
                    if(isset($_GET['selTabla']) || isset($_GET['aceptarModificar']))
                    {
                        if(isset($_GET['selTabla']))
                        {
                            $nomTabla = $_GET['tablas'];
                        }
                        else
                        {
                            $nomTabla = $_GET['nombreTabla'];
                        }
                        ?>
                        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="get">
                            <table>
                                <tr>
                                    <td><input type="hidden" name="nombreTabla" value="<?php echo $nomTabla; ?>"></td>
                                    <td>Codigo del elemento que desea modificar:</td>
                                    <td><input type="number" name="codigo" class="requerido" required></td>
                                </tr>
                                <tr>
                                    <td><input type="submit" name="aceptarModificar" value="Aceptar" class="boton"/></td>
                                </tr>
                            </table>
                        </form>
                        <?php
                        if(isset($_GET['aceptarModificar']))
                        {
                            ?>
                            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                                <table>
                                    <tr><td><input type="hidden" name="nombreTabla2" value="<?php echo $nomTabla; ?>"></td></tr>
                                    <?php $metodos->tablaModificar($nomTabla,$_GET['codigo']); ?>
                                    <tr><td><input type="submit" name="modificar" value="Aceptar" class="boton"/></td></tr>
                                </table>    
                            </form>
                            <?php     
                        }
                    }
                    else if(isset($_POST['modificar']))
                    {
                        $iterador =0;
                        $nomTabla = $_POST['nombreTabla2'];
                        $arregloValores;
                        $qwertyDatos="";
                        $arregloCampos = $metodos ->obtenerNomCol($nomTabla);
                        while(isset($_POST[$iterador+1]))
                        {
                            $arregloValores[$iterador] = $_POST[$iterador];
                            $qwertyDatos = $qwertyDatos.$arregloCampos[$iterador]." = '".$arregloValores[$iterador]."' , "; 
                            $iterador++;
                        }
                        $arregloValores[$iterador] = $_POST[$iterador];
                        $qwertyDatos = $qwertyDatos.$arregloCampos[$iterador]." = '".$arregloValores[$iterador]."'";
                        $iterador = 0;
                        $qwertyEnviar = "update $nomTabla set ".$qwertyDatos." where $arregloCampos[$iterador] = '$arregloValores[$iterador]'";
                        //echo $qwertyEnviar;
                        $metodos->modificar($qwertyEnviar);
                        echo "<h3>Registro modificado correctamente</h3>";
                    }
                ?>
            </div>
        </body>
    </html>