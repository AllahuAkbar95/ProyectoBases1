<?php
class metodos
{
    var $paciente = array("documento: ","nombre: ","apellido: ");
    var $tipoPaciente = array("number","text","text","text");
    var $empleado = array("documento: ","nombre: ", "apellido: ","profesion: ");
    var $tipoEmpleado = array("number","text","text","number","number");
    var $sucursal = array("codigo del pais: ", "codigo de la ciudad: ", "nombre de la sucursal:");
    var $tipoSucursal = array("number","number","text");
    function encabezado()
    {
        ?>
            <div id="cabecera">
                <img src="css/logoU.png" alt="Universidad El Bosque" id="logoU" style="margin-left: 100px;">
                <div id ="contenidoCabecera">
                    <ul>
                        <li><a href="insertar.php">Insertar</a></li>
                        <li><a href="modificar.php">Modificar</a></li>
                        <li><a href="eliminar.php">Consultar y eliminar</a></li>
                    </ul>
                </div>
                <div id="seleccionTabla">
                    <form id="fTablas" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                        <select name="tablas">
                            <option value="paciente">Paciente</option>
                            <option value="empleado">Empleado</option>
                            <option value="profesion">Profesion</option>
                            <option value="especializacion">Especializacion</option>
                            <option value="sucursal">Sucursal</option>
                            <option value="ciudad">Ciudad</option>
                            <option value="pais">Pais</option>
                            <option value="instrumento">Instrumento</option>
                            <option value="tecnica">Tecnica</option>
                            <option value="tratamiento">Tratamiento</option>
                            <option value="asignacion">Asignacion</option>
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
        echo "<input type=\"hidden\" name=\"nomTabla\" value=\"$nomTabla\">";
        if($nomTabla == "paciente")
        {
            echo '<tr><th colspan="2"><h3>Datos del paciente</h3></th></tr>';
            $this->tablaInsertar($this->paciente,$this->tipoPaciente);
        }
        else if($nomTabla == "empleado")
        {
            echo '<tr><th colspan="2"><h3>Datos del empleado</h3></th></tr>';
            $this->tablaInsertar($this->empleado,$this->tipoEmpleado);
            //if insertar
            ?>
                <td id="cantEsp">especialización: </td>
                <td><input type="number" class="requerido" name="4" id="4" placeholder="codigo de la esp" ></td>
            <?php
            //consultar profesiones y especializaciones
        }
        else if($nomTabla == "sede")
        {
            echo '<tr><th colspan="2"><h3>Datos de la nueva sede</h3></th></tr>';
            
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
    function insertar()
    {
        
    }
}
?>