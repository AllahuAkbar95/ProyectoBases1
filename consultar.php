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
            <?php //KALDGNDSKÑLGSLDKGJGDKLJGKJLKJL
                if(isset($_GET['selTabla']) || isset($_GET['borrar']))
                {
                    if(isset($_GET['selTabla']))
                    {
                        $nomTabla = $_GET['tablas'];
                    }
                    else
                    {
                        $nomTabla = $_GET['nomTablaE'];
                    }
                    ?>
                    <div id="eliminar">
                        <h3>inserte codigo del elemento a eliminar:</h3>
                        <br>
                        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="get">
                            <input type="hidden" name="nomTablaE" value="<?php if(isset($_GET['nomTablaE'])){ echo $_GET['nomTablaE'];}else{echo $_GET['tablas'];} ?>">
                            <input type="number" name="codigo" class="requerido" required>       
                            <input type="submit" value="Eliminar" name="borrar" class="boton"/>
                        </form>
                        <?php
                        if(isset($_GET['borrar']))
                        {
                            $llave=$metodos->obtenerPK($_GET['nomTablaE']);
                            $metodos->eliminar($_GET['nomTablaE'],$llave,$_GET['codigo']);
                            echo ' <center>Registro Eliminado</center>';
                        }
                        ?>
                    </div>
                    <div id="resultadoConsultar">
                        <table border="2">
                            <?php
                                echo $metodos->consultar($nomTabla);
                            ?>
                        </table>
                    </div>
                    <?php
                }
                else
                {
                    echo '<div style="margin-top: 200px;">
                                <center>
                                    Para consultar los datos almecenados en una tabla de la base de datos, primero seleccione el tipo de elemento en el menú desplegable de arriba y seleccione la opción de seleccionar tabla
                                </center>
                                </div>';
                }
                ?>
        </body>
    </html>