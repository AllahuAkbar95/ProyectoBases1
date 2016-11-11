<?php
class metodosConsultar
{
    function consultar($nomTabla)
    {
        $conection = pg_connect("host=localhost port=5432 dbname=anovack_proyB user=anovack password=bases1234")
                                    or die("<h3 class=\"mensaje\">no se pudo conectar a la base de datos</h3>");
        $qwerty = "select COLUMN_NAME from INFORMATION_SCHEMA.COLUMNS where TABLE_NAME = '$nomTabla'";
        $resultado = pg_exec($conection,$qwerty)
                            or die("<h3>no se pudo realizar la consulta</h3>");
        pg_close($conection);
        $i =0;
        while ($row = pg_fetch_array($resultado))
        {
            $i++;
        }
        $qwerty = "select * from $nomTabla";
        $resultado = pg_exec($conection,$qwerty)
                            or die("<h3>no se pudo realizar la consulta</h3>");
        pg_close($conection);
        whie($row = pg_fetch_array($resultado))
        {
            echo "<tr>";
            for($n =0; $n < $i; $n++)
            {
                $val = $row[0];
                echo "<td>$val</td>";
            }
            echo "</tr>";
        }
    }
}
?>