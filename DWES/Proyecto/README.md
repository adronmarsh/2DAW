#Revels
Revels es una aplicación web donde cada usuario puede publicar sus propios revels y seguir a otros usuarios para ver sus revels. Los revels son sentencias de texto donde el usuario puede expresar sus ideas libremente y otros usuarios pueden comentar.

##index.php
 * Si no se ha inciado la sesión muestra un formulario de registro.
 * También muestra un enlace al formulario de inicio de sesión.
 * Si la sesión está iniciada muestra los revels propios y de los usuarios a los sigue por orden de fecha.
 * Si no existe ningún revel mostrará un mensaje.
 * También aparece una barra lateral donde se muestran los usuarios
    a los cuales sigue el usuario.
	
##registro.php
 * Comprueba que los datos introducidos en el formulario no tengan errores.
 * Si tiene errores los envia al index.
 * Si no tiene errores inserta los datos en la tabla users.

##login.php
 * Se muestra un formulario para iniciar sesión.
 * Una vez enviado se comprueba que el usario y la contraseña introducidos son los correctos.
 * Si son correctos se guardan los datos en la variable $_SESSION y se redirecciona a index.php
 * Si no son correctos se muestran los errores.

##logout.php 
 * Destruye la sesión.
 
##new.php
 * Muestra un formulario donde introducir el revel.
 * En caso de que esté vacío da error.
 * Si no se encuentra vació inserta los datos en la tabla revels.

##revel.php
* Muestra un revel con y sus comentarios.

##comment.php
 * Recibe el valor introducido en el formulario de revel.php.
 * Si está vacío envia un error.
 * Si no está vacío inserta los datos en la tabla comments.
 
##results.php
 * Muestra los usuarios que contengan en el nombre la cadena de datos introducida en el formulario de index.
 * Junto a los usuarios se muestra un botón de seguir.
 
##list.php
 * Muestra una lista de los revels del usuario elegido junto con un botón de seguir.
 * Si un usuario accede a su propia lista no aparece el botón de seguir pero si aparece un enlace a delete.php.
 
##follow.php
 * Inserta en la tabla follows el id del usuario y el id del usuario al cual seguir.
 
##unfollow.php
* Deja de seguir al usuario solicitado.

##delete.php
* Selecciona un revel y lo elimina.
* Elimina los comentarios del revel seleccionado.

##cancel.php
 * Se muestra un mensaje de confirmación de eliminado de cuenta.
 * Para confirmar se ha de marcar el checkbox y pulsar en confirmar.
 * Si se pulsa confirmar sin marcar el checkbox no ocurrirá nada.
 * Si se marca el checkbox y se pulsa en confimar elimina todo lo relacionado con el usuario indicado.
 * Si se pulsa el botón de cancelar redirecciona a la página account.php.
 
##account.php
 * Muestra un formulario para que el usuario se verifique antes de entrar.
 * Dará error si:
 *    - La contraseña introducida no es la correcta.
 *    - El campo se encuentra vacío.
 * Si no da error:
 *    - Se crea una cookie de 120seg que verifica al usuario.
 * Una vez verificado muestra 3 formularios y una barra lateral.
 * Las funciones en la barra lateral son:
 *    - Acceder a "Mis Revels" (list.php)
 *    - Eliminar la cuenta
 * Los formularios permiten:
 *    - Actualizar el nombre de usuario
 *    - Actualizar el email
 *    - Actualizar la contraseña
 * Para actualizar la contraseña se pide rellenar 2 inputs donde el valor ha de ser el mismo. En caso contrario no actualizará.

##conexion.inc.php
* Crea una conexión con la base de datos.

##menu.inc.php
* Incluye el menu.
* En caso de haber iniciado sesión mostrará el menú completo.
* En caso de no haber iniciado sesión mostrará únicamente un enlace a index.php.

##menuBackend.inc.php
* Incluye el menu del Backend.
* En caso de haber iniciado sesión muestra el menú completo.

##footer.inc.php
* Inclue el footer de la aplicación web.