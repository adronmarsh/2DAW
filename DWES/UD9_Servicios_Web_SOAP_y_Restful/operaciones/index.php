<!DOCTYPE html>
<html lang=es>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Operaciones - Servicio Web + PHP + SOAP</title>
    <link rel="stylesheet" type="text/css" href="estilo.css">
</head>

<body>
    <h1>Realizar operaciones</h1>
    <form action="resultadoOperacionesSOAP.php" method="post">
        inserta los números a operar: <br> 
        <input type="text" name="numero1">
        <select name="operacion" id="operacion">
            <option value="suma">+</option>
            <option value="resta">-</option>
            <option value="multiplicacion">*</option>
            <option value="division">/</option>
        </select>
        <input type="text" name="numero2">
        <input type="submit" name="enviar" value="Calcular">
        <br>
    </form>
    <h1>Pasar a Binario</h1>
    <form action="resultadoOperacionesSOAP.php" method="post">
        inserta el número a traducir: <br> 
        <input type="text" name="numero1">
        <input type="submit" name="enviar" value="Calcular">
        <br>
    </form>
</body>
</html>