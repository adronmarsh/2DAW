<?php
  $mensaje_error='<span class="error">ERROR: Este campo no puede estar vacío.</span><br>';

  $let3='/^\w{3,}$/';
  $error_let3='<span class="error">ERROR: Este campo debe tener como mínimo 3 letras y no puede contener espacios!</span><br>';

  $nombre_formato='/^[^\d]{3,}$/';
  $error_nombre='<span class="error">ERROR: Este campo debe tener como mínimo 3 letras y no puede contener decimales!</span><br>';

  $dni_formato='/^\d{7,8}\w{1}$/';
  $error_dni='<span class="error">ERROR: Este campo debe tener 7 u 8 dígitos y a continuación una letra!</span><br>';

  $direccion_formato='/^[\w\d\s]{10,30}$/';
  $errror_direccion='<span class="error">ERROR: Este campo debe tener entre 10 y 30 caracteres!</span><br>';

  $mail_formato='/^[\w\d_.]+@[\w]+.[\w]{2,3}$/';
  $error_mail='<span class="error">ERROR: Dirección de mail errónea!</span><br>';

  $telefono_formato='/^\d{9}$/';
  $error_telefono='<span class="error">ERROR: Este campo debe tener exactamente 9 números!</span><br>';

  $fecha = '/^([0-2][0-9]|3[0-1])(\/|-)(0[1-9]|1[0-2])\2(\d{4})$/';
  $error_fecha='<span class="error">ERROR: Este campo debe contener el siguiente formato: DD/MM/YYYY</span><br>';
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
        text-align: center;
        font-variant: small-caps;
      }
      .error{
        color: red;
      }
    </style>
  </head>
  <body>
    <h1>Candidato</h1>
    <form name="datos" action="#" method="post">
      <!--USUARIO-->
      Usuario <br><input type="text" name="usuario" id="usuario"
      <?php
        $_POST['usuario']=trim($_POST['usuario']);//eliminamos los posibles espacios de delante y atrás para que no nos produzcan problemas
        if (empty($_POST['usuario'])){
      ?>
          value=""><br><br>
      <?php      
          echo $mensaje_error;  
        }
        else{
          if (!preg_match($let3,$_POST['usuario'])){ //Comprueba si cumple con las expresiones regulares
      ?> 
            value="<?=$_POST['usuario']?>"><br><br>
      <?php
            echo $error_let3;
          }
          else{
      ?> 
            value="<?=$_POST['usuario']?>"><br><br>
      <?php
          }
        }
      ?>
      <!--NOMBRE-->
      Nombre<br><input type="text" name="nombre" id="nombre"
      <?php
        $_POST['nombre']=trim($_POST['nombre']);//eliminamos los posibles espacios de delante y atrás para que no nos produzcan problemas
        if (empty($_POST['nombre'])){
      ?>  
          value=""><br><br>
      <?php      
          echo $mensaje_error;  
        }
        else{
          if (!preg_match($nombre_formato,$_POST['nombre'])){ //Comprueba si cumple con las expresiones regulares
      ?> 
            value="<?=$_POST['nombre']?>"><br><br>
      <?php
            echo $error_nombre;
          }
          else{
      ?> 
            value="<?=$_POST['nombre']?>"><br><br>
      <?php
          }
        }
      ?>
      <!--APELLIDOS-->
      Apellidos<br><input type="text" name="apellidos" id="apellidos"
      <?php
        $_POST['apellidos']=trim($_POST['apellidos']);//eliminamos los posibles espacios de delante y atrás para que no nos produzcan problemas
        if (empty($_POST['apellidos'])){
      ?>  
          value=""><br><br>
      <?php      
          echo $mensaje_error;  
        }
        else{
          if (!preg_match($nombre_formato,$_POST['apellidos'])){ //Comprueba si cumple con las expresiones regulares
      ?> 
            value="<?=$_POST['apellidos']?>"><br><br>
      <?php
            echo $error_nombre;
          }
          else{
      ?> 
            value="<?=$_POST['apellidos']?>"><br><br>
      <?php
          }
        }
      ?>
      <!--DNI-->
       DNI<br><input type="text" name="dni" id="dni" 
      <?php
        $_POST['dni']=trim($_POST['dni']);//eliminamos los posibles espacios de delante y atrás para que no nos produzcan problemas
        if (empty($_POST['dni'])){
      ?>
          value=""><br><br>
      <?php      
          echo $mensaje_error;  
        }
        else{
          if (!preg_match($dni_formato,$_POST['dni'])){ //Comprueba si cumple con las expresiones regulares
      ?> 
            value="<?=$_POST['dni']?>"><br><br>
      <?php
            echo $error_dni;
          }
          else{
      ?> 
            value="<?=$_POST['dni']?>"><br><br>
      <?php
          }
        }
      ?>
      <!--DIRECCIÓN-->
      Dirección<br><input type="direccion" name="direccion" id="direccion"
      <?php
        $_POST['direccion']=trim($_POST['direccion']);//eliminamos los posibles espacios de delante y atrás para que no nos produzcan problemas
        if (empty($_POST['direccion'])){
        ?>
          value=""><br><br>
        <?php      
          echo $mensaje_error;
        }
        else{
          if (!preg_match($direccion_formato,$_POST['direccion'])){ //Comprueba si cumple con las expresiones regulares
        ?> 
            value="<?=$_POST['direccion']?>"><br><br>
        <?php
            echo $errror_direccion;
          }
          else{
        ?> 
            value="<?=$_POST['direccion']?>"><br><br>
        <?php
          }
        }
        ?>
        <!--MAIL-->
        Mail<br><input type="text" name="mail" id="mail" 
        <?php
        $_POST['mail']=trim($_POST['mail']);//eliminamos los posibles espacios de delante y atrás para que no nos produzcan problemas
          if (empty($_POST['mail'])){
        ?>  
            value=""><br><br>
        <?php      
            echo $mensaje_error;  
          }
          else{
            if (!preg_match($mail_formato,$_POST['mail'])){ //Comprueba si cumple con las expresiones regulares
        ?> 
              value="<?=$_POST['mail']?>"><br><br>
        <?php
              echo $error_mail;
            }
            else{
        ?> 
              value="<?=$_POST['mail']?>"><br><br>
        <?php
            }
          }
        ?>
        <!--TELÉFONO-->
        Teléfono<br><input type="text" name="telefono" id="telefono" 
        <?php
        $_POST['telefono']=trim($_POST['telefono']);//eliminamos los posibles espacios de delante y atrás para que no nos produzcan problemas
          if (empty($_POST['telefono'])){
        ?>
            value=""><br><br>
        <?php      
            echo $mensaje_error;  
          }
          else{
            if (!preg_match($telefono_formato,$_POST['telefono'])){ //Comprueba si cumple con las expresiones regulares
        ?> 
              value="<?=$_POST['telefono']?>"><br><br>
        <?php
              echo $error_telefono;
            }
            else{
        ?> 
              value="<?=$_POST['telefono']?>"><br><br>
        <?php
            }
          }
        ?>
          <!--NACIMIENTO-->
          Nacimiento<br><input type="text" name="nacimiento" id="nacimiento" 
        <?php
          $_POST['nacimiento']=trim($_POST['nacimiento']);//eliminamos los posibles espacios de delante y atrás para que no nos produzcan problemas
          if (empty($_POST['nacimiento'])){
        ?>
            value=""><br><br>
        <?php      
            echo $mensaje_error;  
          }else{
            if (!preg_match($fecha,$_POST['nacimiento'])){ //Comprueba si cumple con las expresiones regulares
        ?> 
              value="<?=$_POST['nacimiento']?>"><br><br>
        <?php
              echo $error_fecha;
            }
            else{
        ?> 
              value="<?=$_POST['nacimiento']?>"><br><br>
        <?php
            }
          }
        ?>        
      <input type="submit" name="Enviar">
    </form>
  </body>
</html>
