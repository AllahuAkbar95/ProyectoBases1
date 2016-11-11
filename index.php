<!DOCTYPE html>
    <html>
        <head>
            <link href="css/estilo.css" rel="stylesheet" type="text/css">
            <?php include("metodos.php");
                $metodos = new metodos;?>
        </head>
        <body>
            <?php $metodos->encabezado(); ?>
            <div id="bodyIndex">
                <div id="contIndex">
                    Bienvenido al sistema de gestion de datos de nuestro laboratorio de diagnostico y tratamiento
                </div>
            </div>
        </body>
    </html>