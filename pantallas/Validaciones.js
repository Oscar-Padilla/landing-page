function validacion_first(first_name)
{ 
    var letras = /^[A-Za-z ]+$/;
    if(first_name.value.match(letras))
    {
        return true;
    }
    else
    {
        alert('Solo ingresa letras');
        document.getElementById("first_name").value = "";
        return false;
    }
}

function validacion_last(last_name)
{ 
    var letras = /^[A-Za-z ]+$/;
    if(last_name.value.match(letras))
    {
        return true;
    }
    else
    {
        alert('Solo ingresa letras');
        document.getElementById("last_name").value = "";
        return false;
    }
}

function validacion_edad(edad)
{ 
    var numeros = /^[0-9]+$/;
    if(edad.value.match(numeros))
    {
        return true;
    }
    else
    {
        alert('Solo ingresa numeros');
        document.getElementById("edad").value = "";
        return false;
    }
}

function validacion_tel(tel)
{ 
    var numeros = /^[0-9-]+$/;
    if(tel.value.match(numeros))
    {
        return true;
    }
    else
    {
        alert('Solo ingresa numeros');
        document.getElementById("phone").value = "";
        return false;
    }
}

function mayusculas(curp) 
{
    curp.target.value=curp.target.value.toUpperCase();    
}