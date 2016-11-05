function validarRequ(var campo)
{
    if(Document.getElementById(campo).invalid)
    {
        document.writeln("bien");
    }
}

function alerta(var mensaje)
{
    alert(mensaje);
}