<?php
class metodos
{
    //var $tablas = array("asignacion","ciudad","conjunto_empleado","conjunto_tecnica","empleado","especialidad","instrumento","inventario_instrumento","paciente","pais","profesion","sucursal","tecnica","tratamiento");
    var $tipoPaciente = array("number","text","text","text");
    var $tipoEmpleado = array("number","text","text","number","number");
    var $tipoProfesion = array("text","number");
    var $tipoAsignacion = array("number","number","number");
    var $tipoInventarioInstrumento = array("number","number","number"); //sobra
    var $tipoCiudad = array("number","text");
    var $tipoPais = array("text");
    
    function encabezado()
    {
        ?>
            <div id="cabecera">
                <img src="css/logoU.png" alt="Universidad El Bosque" id="logoU" style="margin-left: 100px;">
                <div id ="contenidoCabecera">
                    <ul>
                        <li><a href="insertar.php">Insertar</a></li>
                        <li><a href="modificar.php">Modificar</a></li>
                        <li><a href="consultar.php">Consultar y eliminar</a></li>
                        <li><a href="consultas.php">Consultas</a></li>
                    </ul>
                </div>
                <div id="seleccionTabla">
                    <form id="fTablas" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="get">
                        <select name="tablas">
                            <option value="paciente">Paciente</option>
                            <option value="empleado">Empleado</option>
                            <option value="profesion">Profesion</option>
                            <option value="especialidad">Especializacion</option>
                            <option value="sucursal">Sucursal</option>
                            <option value="ciudad">Ciudad</option>
                            <option value="pais">Pais</option>
                            <option value="instrumento">Instrumento</option>
                            <option value="tecnica">Tecnica</option>
                            <option value="tratamiento">Tratamiento</option>
                            <option value="asignacion">Asignacion</option>
                            <option value="conjunto_empleado">conjunto de empleados</option>
                            <option value="conjunto_tecnica">conjunto de tecnicas</option>
                            <option value="inventario_instrumento">inventario de instrumentos</option>
                        </select>
                        <input type="submit" value="Seleccionar Tabla" class="boton" name="selTabla">
                    </form>
                </div>
            </div>
        <?php
    }
    
    function auxTabla($tablas, $tablas2)
    {
        if($tablas)
        {
            return true;
        }
        else
        {
            return false;
        }
    }
    
    function selectTable($nomTabla)
    {
        //automatizar con un for
        /*for($i =0; $i<13; $i++)
        {
            if($nomTabla == $this->tablas[$i])
            {
                if($nomTabla == "paciente" || $nomTabla == "empleado"  || $nomTabla == "tratamiento" || $nomTabla == "pais" || $nomTabla == "instrumento")
                {
                    echo "<tr><th colspan=\"2\"><h3>Datos del nuevo $nomTabla</h3></th></tr>";
                }
                else if()
                {
                    
                }
            }
        }*/
        echo "<input type=\"hidden\" name=\"nomTabla\" value=\"$nomTabla\">";
        if($nomTabla == "paciente")
        {
            $paciente = array("documento: ","nombre: ","apellido: ");
            echo '<tr><th colspan="2"><h3>Datos del paciente</h3></th></tr>';
            $this->tablaInsertar($paciente,$this->tipoPaciente);
        }
        else if($nomTabla == "empleado")
        {
            $empleado = array("documento: ","nombre: ", "apellido: ","profesion: ");
            echo '<tr><th colspan="2"><h3>Datos del empleado</h3></th></tr>';
            $this->tablaInsertar($empleado,$this->tipoEmpleado);
            //if insertar
            ?>
                <td id="especializacion">especialización: </td>
                <td><input type="number" class="requerido" name="4" id="4" placeholder="codigo de la esp" ></td>
            <?php
            //consultar profesiones y especializaciones
        }
        else if($nomTabla == "profesion")
        {
            $profesion = array("nombre: ","salario: ");
            echo '<tr><th colspan="2"><h3>Datos de la nueva profesion</h3></th></tr>';
            $this->tablaInsertar($profesion,$this->tipoProfesion);
        }
        else if($nomTabla == "especialidad")
        {
            $profesion = array("nombre: ","salario: ");
            echo '<tr><th colspan="2"><h3>Datos de la nueva especialidad</h3></th></tr>';
            $this->tablaInsertar($profesion,$this->tipoProfesion);
        }
        else if($nomTabla == "conjunto_empleado")
        {
            $conjunto_empleado = array("codigo del conjunto de empleados:", "codigo del empleado:","codigo de la asignacion:");
            echo '<tr><th colspan="2"><h3>Datos del nuevo conjunto de empleados</h3></th></tr>';
            $this->tablaInsertar($conjunto_empleado,$this->tipoAsignacion);
        }
        else if($nomTabla == "conjunto_tecnica")
        {
            $conjunto_tecnica = array("codigo del conjunto de tecnicas:", "codigo de la tecnica:","codigo del tratamiento:");
            echo '<tr><th colspan="2"><h3>Datos del nuevo conjunto de tecnicas</h3></th></tr>';
            $this->tablaInsertar($conjunto_tecnica,$this->tipoAsignacion);
        }
        else if($nomTabla == "inventario_instrumento")
        {
            $inventario_instrumento = array("codigo del conjunto de instrumentos:", "codigo del instrumento:","codigo del tratamiento:");
            echo '<tr><th colspan="2"><h3>Datos del  nuevo conjunto de instrumentos</h3></th></tr>';
            $this->tablaInsertar($inventario_instrumento,$this->tipoAsignacion);
        }        
        else if($nomTabla == "asignacion")
        {
            $asignacion = array("documento del paciente: ","codigo del tratamiento: ","codigo de la sucursal: ");
            echo '<tr><th colspan="2"><h3>Datos de la nueva asignacion</h3></th></tr>';
            $this->tablaInsertar($asignacion,$this->tipoAsignacion);
        }
        else if($nomTabla == "tratamiento")
        {
            $tratamiento = array("nombre de la enfermedad que trata:");
            echo '<tr><th colspan="2"><h3>Datos del nuevo trtamiento</h3></th></tr>';
            $this->tablaInsertar($tratamiento,$this->tipoPais);
        }
        else if($nomTabla == "sucursal")
        {
            $sucursal = array("codigo de la ciudad: ", "nombre de la sucursal:");
            echo '<tr><th colspan="2"><h3>Datos de la nueva sucursal</h3></th></tr>';
            $this->tablaInsertar($sucursal,$this->tipoCiudad);
        }
        else if($nomTabla == "ciudad")
        {
            $ciudad = array("codigo del pais: ","nombre de la ciudad: ");
            echo '<tr><th colspan="2"><h3>Datos de la nueva ciudad</h3></th></tr>';
            $this->tablaInsertar($ciudad,$this->tipoCiudad);
        }
        else if($nomTabla == "pais")
        {
            $pais = array("nombre del pais: ");
            echo '<tr><th colspan="2"><h3>Datos del nuevo pais</h3></th></tr>';
            $this->tablaInsertar($pais,$this->tipoPais);
        }
        else if($nomTabla == "instrumento")
        {
            $instrumento = array("nombre: ");
            echo '<tr><th colspan="2"><h3>Datos del nuevo instrumento</h3></th></tr>';
            $this->tablaInsertar($instrumento,$this->tipoPais);
        }
        else if($nomTabla == "tecnica")
        {
            $instrumento = array("nombre: ");
            echo '<tr><th colspan="2"><h3>Datos de la nueva tecnica</h3></th></tr>';
            $this->tablaInsertar($instrumento,$this->tipoPais);
        }
    }
    
    function tablaInsertar($columnas,$tipos)
    {
        for($i =0; $i <count($columnas);$i++)
        {
            $dato = $columnas[$i];
            ?>
                <tr>
                    <td id="<?php echo $dato ?>"><?php echo $dato ?></td>
                    <td><input type="<?php echo $tipos[$i]; ?>" class="requerido" name="<?php echo $i ?>" id="<?php echo $i ?>" placeholder="<?php echo $dato ?>" required></td>
                </tr>
            <?php
        }
    }
    
    function tablaModificar($nomTabla,$codigo)
    {
        $columnas = $this->obtenerNomCol($nomTabla);
        $llave = $this->obtenerPK($nomTabla);
        $conection = pg_connect("host=localhost port=5432 dbname=anovack_proyB user=anovack password=bases1234")
                                    or die("<h3 class=\"mensaje\">no se pudo conectar a la base de datos</h3>");
        $qwerty = "select * from $nomTabla where $llave = $codigo";
        $resultado = pg_exec($conection,$qwerty)
                            or die("<h3>no se pudo realizar la consulta</h3>");
        pg_close($conection);
        if($row = pg_fetch_array($resultado))
        {
            for($n =0; $n<count($columnas); $n++)
            {
                ?>
                <tr>
                    <td><?php echo $columnas[$n]; ?></td>
                    <td><input type="text" name="<?php echo $n; ?>" value="<?php echo $row[$n]; ?>" class="requerido" required></td>
                </tr>
                <?php
            }
        }
    }
    
    function modificar($qwerty)
    {
        $conection = pg_connect("host=localhost port=5432 dbname=anovack_proyB user=anovack password=bases1234")
                                    or die("<h3 class=\"mensaje\">no se pudo conectar a la base de datos</h3>");
        $resultado = pg_exec($conection,$qwerty)
                            or die("<h3>no se pudo realizar la consulta</h3>");
        pg_close($conection);                    
    }
    
    function obtenerNomCol($nomTabla)
    {
        $conection = pg_connect("host=localhost port=5432 dbname=anovack_proyB user=anovack password=bases1234")
                                    or die("<h3 class=\"mensaje\">no se pudo conectar a la base de datos</h3>");
        $qwerty = "select COLUMN_NAME from INFORMATION_SCHEMA.COLUMNS where TABLE_NAME = '$nomTabla'";
        $resultado = pg_exec($conection,$qwerty)
                            or die("<h3>no se pudo realizar la consulta</h3>");
        pg_close($conection);
        $i = 0;
        $arregloCol;
        while ($row = pg_fetch_array($resultado))
        {
            $arregloCol[$i] =  $row[0];
            $i ++;
        }
        return  $arregloCol;
    }
    
    function validarCampo($dato)
    {
        if(filter_var($dato,FILTER_VALIDATE_INT) === FALSE)
        {
            return false;
        }
        else
        {
            return true;
        }
    }
    
    function consultar($nomTabla)
    {
        $arregloCol = $this->obtenerNomCol($nomTabla);
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
        $conection = pg_connect("host=localhost port=5432 dbname=anovack_proyB user=anovack password=bases1234")
                                    or die("<h3 class=\"mensaje\">no se pudo conectar a la base de datos</h3>");
        $qwerty = "select * from $nomTabla";
        $resultado = pg_exec($conection,$qwerty)
                            or die("<h3>no se pudo realizar la consulta</h3>");
        pg_close($conection);
        echo "<h3>Datos almacenados en la tabla $nomTabla</h3>";
        echo "<tr>";
        for($in =0; $in <count($arregloCol); $in++)
        {
            echo "<td>$arregloCol[$in]</td>";
        }
        echo "</tr>";
        
        while($row = pg_fetch_array($resultado))
        {
            echo "<tr>";
            for($n =0; $n < $i; $n++)
            {
                $val = $row[$n];
                echo "<td>$val</td>";
            }
            echo "</tr>";
        }
    }
    
    function eliminar($nomTabla,$llave,$codigo){   
        $conection = pg_connect("host=localhost port=5432 dbname=anovack_proyB user=anovack password=bases1234")
                                    or die("<h3 class=\"mensaje\">no se pudo conectar a la base de datos</h3>");
        $qwerty = "delete from $nomTabla where $llave = $codigo";
        $resultado = pg_exec($conection,$qwerty)
                            or die("<h3>no se pudo realizar la consulta</h3>");
        pg_close($conection);
    }
    function obtenerPK($nomTabla)
    {
        $conection = pg_connect("host=localhost port=5432 dbname=anovack_proyB user=anovack password=bases1234")
                                    or die("<h3 class=\"mensaje\">no se pudo conectar a la base de datos</h3>");
        $llave = $nomTabla."_pkey";                        
        $qwerty = "select column_name from information_schema.key_column_usage where TABLE_NAME='$nomTabla' and constraint_name='$llave'";
        $resultado = pg_exec($conection,$qwerty)
                            or die("<h3>no se pudo realizar la consulta</h3>");
        pg_close($conection);
        if($row = pg_fetch_array($resultado))
        {
            $valor = $row[0];
            return $valor;
        }
    }
    
    
}
?>