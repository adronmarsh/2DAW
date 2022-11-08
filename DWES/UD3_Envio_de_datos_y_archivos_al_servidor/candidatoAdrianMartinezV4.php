<?php

    //Mensajes de error
    $mensajeError='<span class="error">ERROR: Este campo no puede estar vacío.</span><br>';
    $errorUsuario='<span class="error">ERROR: Este campo debe tener como mínimo 3 letras y no puede contener espacios!</span><br>';
    $errorNombre='<span class="error">ERROR: Este campo debe tener como mínimo 3 letras y no puede contener decimales!</span><br>';
    $errorDNI='<span class="error">ERROR: Este campo debe tener 7 u 8 dígitos y a continuación una letra!</span><br>';
    $errorDireccion='<span class="error">ERROR: Este campo debe tener entre 10 y 30 caracteres!</span><br>';
    $errorMail='<span class="error">ERROR: Dirección de mail errónea!</span><br>';
    $errorTelefono='<span class="error">ERROR: Este campo debe tener exactamente 9 números!</span><br>';
    $errorFecha='<span class="error">ERROR: Este campo debe contener el siguiente formato: DD/MM/YYYY</span><br>';
    $errorDefault='<span class="error">ERROR: Error indeterminado.</span><br>';
    $errorTipoCurriculum='<span class="error">ERROR: El archivo debe ser .pdf</span><br>';
    $errorTamanoCurriculum='<span class="error">ERROR: El fichero es demasiado grande.</span><br>';
    $errorPartialCurriculum='<span class="error">ERROR: El fichero no se ha podido subir entero.</span><br> ';
    $errorNoFileCurriculum='<span class="error">ERROR: No se ha podido subir el fichero.</span><br> ';
    $errorMoverCurriculum='<span class="error">ERROR: No se puede mover el fichero a su destino</span><br>'; 
    $errorTipoImagen='<span class="error">ERROR: El archivo debe ser .png</span><br>';
    $errorTamanoImagen='<span class="error">ERROR: La imagen es demasiado grande.</span><br>';
    $errorPartialImagen='<span class="error">ERROR: La imagen no se ha podido subir al completo.</span><br> ';
    $errorNoFileImagen='<span class="error">ERROR: No se ha podido subir la imagen.</span><br> ';
    $errorMoverImagen='<span class="error">ERROR: No se puede mover la imagen a su destino</span><br>';

    //Expresiones regulares
    $usuario_formato='/^\w{3,}$/';
    $nombre_formato='/^[^\d]{3,}$/';
    $dni_formato='/^\d{7,8}\w{1}$/';
    $direccion_formato='/^[\w\d\s]{10,30}$/';
    $mail_formato='/^[\w\d_.]+@[\w]+.[\w]{2,3}$/';
    $telefono_formato='/^\d{9}$/';
    $fecha = '/^([0-2][0-9]|3[0-1])(\/|-)(0[1-9]|1[0-2])\2(\d{4})$/';


    if (!empty($_POST)) { //Este código se ejecutará una vez enviado el formulario

        //Filtro para que no existan espacios ni por delante ni por detrás
        $_POST['usuario']=trim($_POST['usuario']);
        $_POST['nombre']=trim($_POST['nombre']);
        $_POST['apellidos']=trim($_POST['apellidos']);
        $_POST['dni']=trim($_POST['dni']);
        $_POST['direccion']=trim($_POST['direccion']);
        $_POST['mail']=trim($_POST['mail']);
        $_POST['telefono']=trim($_POST['telefono']);
        $_POST['nacimiento']=trim($_POST['nacimiento']);

        //Comprobación de errrores
        if (!preg_match($usuario_formato,$_POST['usuario'])){
            $errores['usuario']=$errorUsuario;
        }
        if (!preg_match($nombre_formato,$_POST['nombre'])){
            $errores['nombre']=$errorNombre;
        }
        if (!preg_match($nombre_formato,$_POST['apellidos'])){
            $errores['apellidos']=$errorNombre;
        }
        if (!preg_match($dni_formato,$_POST['dni'])){
            $errores['dni']=$errorDNI;
        }
        if (!preg_match($direccion_formato,$_POST['direccion'])){
            $errores['direccion']=$errorDireccion;
        }
        if (!preg_match($mail_formato,$_POST['mail'])){
            $errores['mail']=$errorMail;
        }
        if (!preg_match($telefono_formato,$_POST['telefono'])){
            $errores['telefono']=$errorTelefono;
        }
        if (!preg_match($fecha,$_POST['nacimiento'])){
            $errores['nacimiento']=$errorFecha;
        }
    

        
        //Se ejecuta en caso que el array $_FILES no esté vacío
        if (!empty($_FILES)) {//Se ejecuta en caso que el array $_FILES no esté vacío
            
            //Creación de variables para la información del currículum
            $nombreCurriculum = 'curriculum'.$_POST['dni'].$_POST['nombre'].$_POST['apellidos'].'.pdf';
            $tamanoCurriculum = $_FILES['curriculum']['size'];
            $directorioTempCurriculum = $_FILES['curriculum']['tmp_name'];
            $tipoCurriculum = $_FILES['curriculum']['type'];
        
            //Creación de variables para la información de la imagen
            $nombreImagen = $_POST['dni'].'.png';
            $tamanoImagen = $_FILES['imagen']['size'];
            $directorioTempImagen = $_FILES['imagen']['tmp_name'];
            $tipoImagen = $_FILES['imagen']['type'];

            if ($_FILES['curriculum']['error'] != UPLOAD_ERR_OK) { //Comprueba los posibles errores del array $_FILES['curriculum']
                switch ($_FILES['curriculum']['error']) {
                    case UPLOAD_ERR_INI_SIZE:
                    case UPLOAD_ERR_FORM_SIZE:  $errores['tamanoCurriculum']=$errorTamanoCurriculum;
                                                break;
                    case UPLOAD_ERR_PARTIAL:    $errores['partialCurriculum']=$errorPartialCurriculum;                                                
                                                break;
                    case UPLOAD_ERR_NO_FILE:    $errores['noFileCurriculum']=$errorNoFileCurriculum;
                                                break;
                    default:                    $errores['defaultCurriculum']=$errorDefault;
                }
            }
            if ($tipoCurriculum!='application/pdf'){ //Comprueba que el archivo tenga formato .pdf
                $errores['tipoCurriculum']=$errorTipoCurriculum;
            }
            else{
                if (is_uploaded_file($directorioTempCurriculum) === true){ //Comprueba que el archivo haya sido enviado por $_POST
                    $nuevaRuta = './'.$nombreCurriculum;
                    if (!move_uploaded_file($_FILES['curriculum']['tmp_name'], $nuevaRuta)) { //Verifica que el archivo sea válido y si es así lo envía directamente a la ruta
                        $errores['moverCurriculum']=$errorMoverCurriculum;
                    }
                }
            }
        
           if ($_FILES['imagen']['error'] != UPLOAD_ERR_OK) {   //Comprueba los posibles errores del array $_FILES['imagen']
               switch ($_FILES['imagen']['error']) {
                   case UPLOAD_ERR_INI_SIZE:
                   case UPLOAD_ERR_FORM_SIZE:  $errores['tamanoImagen']=$errorTamanoImagen;
                                               break;
                   case UPLOAD_ERR_PARTIAL:    $errores['partialImagen']=$errorPartialImagen;                                                
                                               break;
                   case UPLOAD_ERR_NO_FILE:    $errores['noFileImagen']=$errorNoFileImagen;
                                               break;
                   default:                    $errores['defaultImagen']=$errorDefault;
               }
           }
           if ($tipoImagen!='image/png'){ //Comprueba que el archivo tenga formato .png
               $errores['tipoImagen']=$errorTipoImagen;
           }
           else {
                if (is_uploaded_file($directorioTempImagen) === true){
                    $nuevaRuta = './'.$nombreImagen;
                    if (!move_uploaded_file($directorioTempImagen, $nuevaRuta)) {
                        $errores['moverImagen']=$errorMoverImagen;
                    }

                    //Guarda la imagen en una variable
                    $imagenOriginal = imagecreatefrompng($nuevaRuta);

                    //Gurada las medidas de la imagen
                    $anchoOriginal = imagesx($imagenOriginal);
                    $altoOriginal = imagesy($imagenOriginal);

                    //Guarda el nombre de la imagen small en una variable
                    $nombreImagenPequena = $_POST['dni'].'Small.png';

                    //Crea las medidas de la imagen small y las guarda en una variable
                    $anchoSmall = $anchoOriginal/2;
                    $altoSmall = $altoOriginal/2;

                    //Crea boceto de la imagen small y lo guarda en una variable
                    $imagenSmall = imagecreatetruecolor($anchoSmall,$altoSmall);

                    //Pega en el boceto de la imagen small la imagen original 
                    imagecopyresampled($imagenSmall, $imagenOriginal, 0,0,0,0, $anchoSmall, $altoSmall, $altoOriginal, $altoOriginal);
                    
                    //Exporta la imagen
                    imagepng($imagenSmall, './'.$nombreImagenPequena );
                }     
            }
        }
    }
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Candidato</title>
        <style>
            form, form input{
                text-align: center;
            }
            h1{
                display: flex;
                justify-content: center;
                font-variant: small-caps;
            }
            .error{
                color: red;
            }
            .datos{
                display: flex;
                justify-content: center;
                border: black 1px solid;
                width:20%;
                margin: auto;
                text-align:center;
                background-color: lightgray;
                border-radius: 5%;
            }

        </style>
    </head>
    <body>
        <h1>Candidato</h1>
        <?php
            if (empty($_POST)) { //Muestra el formulario por primera vez
                $errores=[];//Creación del array $errores para posteriormente comprobar si está vacío.
        ?>
                <form name="datos" action="#" method="POST" enctype="multipart/form-data">
                    Usuario<br><input type="text" name="usuario" id="usuario"><br><br>       
                    Nombre<br><input type="text" name="nombre" id="nombre"><br><br>
                    Apellidos<br><input type="text" name="apellidos" id="apellidos"><br><br>
                    DNI<br><input type="text" name="dni" id="dni"><br><br>
                    Dirección<br><input type="direccion" name="direccion" id="direccion"><br><br>
                    Mail<br><input type="text" name="mail" id="mail"><br><br>
                    Teléfono<br><input type="text" name="telefono" id="telefono"><br><br>
                    Fecha de Nacimiento<br><input type="text" name="nacimiento" id="nacimiento"><br><br>
                    <input type="hidden" name="MAX_FILE_SIZE" value="200000" />
                    Currículum<br><input type="file" name="curriculum" id="curriculum"><br><br>
                    Imagen<br><input type="file" name="imagen" id="imagen"><br><br>
                    <input type="submit" name="Enviar">
                </form>
        <?php
            }

            //Si hay errores muestra el formulario indicando los errores
            if (!empty($errores)) { 
                ?>
                <form name="datos" action="#" method="POST" enctype="multipart/form-data">
                    Usuario<br><input type="text" name="usuario" id="usuario" value=<?=$_POST['usuario']?>><br><br>
                <?php
                    if (empty($_POST['usuario'])){
                        echo $mensajeError;
                    }
                    else{
                        if (isset($errores['usuario'])) {
                            echo $errores['usuario'];        
                        }
                    }
                ?>
                     Nombre<br><input type="text" name="nombre" id="nombre" value=<?=$_POST['nombre']?>><br><br>
                <?php
                    if (empty($_POST['nombre'])){
                        echo $mensajeError;
                    }
                    else{
                        if (isset($errores['nombre'])) {
                            echo $errores['nombre'];        
                        }
                    }
                ?>        
                     Apellidos<br><input type="text" name="apellidos" id="apellidos" value=<?=$_POST['apellidos']?>><br><br>
                <?php
                    if (empty($_POST['apellidos'])){
                        echo $mensajeError;
                    }
                    else{
                        if (isset($errores['apellidos'])) {
                            echo $errores['apellidos'];        
                        }
                    }
                ?>
                     DNI<br><input type="text" name="dni" id="dni" value=<?=$_POST['dni']?>><br><br>
                <?php
                    if (empty($_POST['dni'])){
                        echo $mensajeError;
                    }
                    else{
                        if (isset($errores['dni'])) {
                            echo $errores['dni'];        
                        }
                    }
                ?> 
                     Dirección<br><input type="text" name="direccion" id="direccion" value=<?=$_POST['direccion']?>><br><br>
                <?php
                    if (empty($_POST['direccion'])){
                        echo $mensajeError;
                    }
                    else{
                        if (isset($errores['direccion'])) {
                            echo $errores['direccion'];        
                        }
                    }
                ?>  
                     Mail<br><input type="text" name="mail" id="mail" value=<?=$_POST['mail']?>><br><br>
                <?php
                    if (empty($_POST['mail'])){
                        echo $mensajeError;
                    }
                    else{
                        if (isset($errores['mail'])) {
                            echo $errores['mail'];        
                        }
                    }
                ?> 
                     Teléfono<br><input type="text" name="telefono" id="telefono" value=<?=$_POST['telefono']?>><br><br>
                <?php
                    if (empty($_POST['telefono'])){
                        echo $mensajeError;
                    }
                    else{
                        if (isset($errores['telefono'])) {
                            echo $errores['telefono'];        
                        }
                    }
                ?>
                     Fecha de Nacimiento<br><input type="text" name="nacimiento" id="nacimiento" value=<?=$_POST['nacimiento']?>><br><br>
                <?php
                    if (empty($_POST['nacimiento'])){
                        echo $mensajeError;
                    }
                    else{
                        if (isset($errores['nacimiento'])) {
                            echo $errores['nacimiento'];        
                        }
                    }
            
                ?> 
                    <input type="hidden" name="MAX_FILE_SIZE" value="200000" />
                    Currículum<br><input type="file" name="curriculum" id="curriculum" value=<?=$_FILES['curriculum']['name']?>><br><br>                          
                <?php
                    if (isset($errores['tamanoCurriculum'])){
                        echo $errorTamanoCurriculum;
                    }
                    if (isset($errores['partialCurriculum'])){
                        echo $errorPartialCurriculum;
                    }
                    if (isset($errores['noFileCurriculum'])){
                        echo $errorNoFileCurriculum;
                    }
                    if (isset($errores['defaultCurriculum'])){
                        echo $errorDefault;
                    }
                    if (isset($errores['tipoCurriculum'])){
                        echo $errorTipoCurriculum;
                    }
                    if (isset($errores['moverCurriculum'])){
                        echo $errorMoverCurriculum;
                    }                 
                ?>
                    Imagen<br><input type="file" name="imagen" id="imagen"><br><br>
                <?php
                    if (isset($errores['tamanoImagen'])){
                        echo $errorTamanoImagen;
                    }
                    if (isset($errores['partialImagen'])){
                        echo $errorPartialImagen;
                    }
                    if (isset($errores['noFileImagen'])){
                        echo $errorNoFileImagen;
                    }
                    if (isset($errores['defaultImagen'])){
                        echo $errorDefault;
                    }
                    if (isset($errores['tipoImagen'])){
                        echo $errorTipoImagen;
                    }
                    if (isset($errores['moverImagen'])){
                        echo $errorMoverImagen;
                    }                   
                ?>
                    <input type="submit" name="Enviar">
                <?php
            }
            
            //Muestra los resultados
            if(!empty($_POST&&empty($errores))) { 
                echo '<div class="datos">Usuario:'.$_POST['usuario'].'<br>'; 
                echo 'Nombre: '.$_POST['nombre'].'<br>'; 
                echo 'Apellidos: '.$_POST['apellidos'].'<br>'; 
                echo 'DNI: '.$_POST['dni'].'<br>'; 
                echo 'Dirección: '.$_POST['direccion'].'<br>'; 
                echo 'Mail: '.$_POST['mail'].'<br>'; 
                echo 'Teléfono: '.$_POST['telefono'].'<br>'; 
                echo 'Nacimiento: '.$_POST['nacimiento'].'<br></div>';
            }            
        ?>
            
    </body>
</html>
