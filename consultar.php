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
                if(isset($_GET['selTabla']))
                {
                    ?>
                    <div id="resultadoConsultar">
                        <table>
                            <?php
                                echo $metodos->consultar($_GET['tablas']);
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