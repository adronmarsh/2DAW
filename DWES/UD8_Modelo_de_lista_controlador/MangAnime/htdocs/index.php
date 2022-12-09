<?php
/**
 *  Carga de la configuración, los modelos y los controladores
 *  Cuando se tienen varios modelos y controladores, es recomendable
 *	cargar solo el modelo y controlador que se necesite en la petición,
 * esta acción se realizaría dentro del if de la línea 26
 */
require_once __DIR__ . '/../app/Config.php';
require_once __DIR__ . '/../app/MangAnime.php';
require_once __DIR__ . '/../app/MangAnimeController.php';

/* array asociativo cuya función es definir una tabla para mapear (asociar)
* rutas en acciones de un controlador.
* Esta tabla será utilizada para saber qué acción se debe ejecutar
*/
$map = [
	'inicio' => ['controller' =>'MangAnimeController', 'action' =>'inicio'],
	'listar' => ['controller' =>'MangAnimeController', 'action' =>'listar'],
	'insertar' => ['controller' =>'MangAnimeController', 'action' =>'insertar'],
	'buscarPorNombre' => ['controller' =>'MangAnimeController', 'action' =>'buscarPorNombre'],
	'ver' => ['controller' =>'MangAnimeController', 'action' =>'ver'],
	'buscarPorDemografia' => ['controller' =>'MangAnimeController', 'action' =>'ver'],
	'buscarCombinada' => ['controller' =>'MangAnimeController', 'action' =>'ver'],

	// DOIT: completar con todas las rutas y acciones que se necesiten
];

// Parseo de la ruta
if (isset($_GET['accion'])) {
	if (isset($map[$_GET['accion']])) {
		$ruta = $_GET['accion'];
	}
	else {
		$params = ['mensaje' => 'Error 404: No existe la ruta '. $_GET['accion'] .'.'];
		require __DIR__ . '/../app/templates/404.php';
		exit();
		
		//header('Status: 404 Not Found');
		//echo '<html><body>Error 404: No existe la ruta '. $_GET['accion'] .'.</body></html>';
		//exit;
	}
}
else {
	// ruta por defecto, por si la query string llega vacía
	$ruta = 'inicio';
}

$controlador = $map[$ruta];
// Ejecucion del controlador asociado a la ruta
if (method_exists($controlador['controller'], $controlador['action'])) {
	// Llamada a la acción indicada por la ruta del controlador encargado de gestionar la petición
	call_user_func([new $controlador['controller'], $controlador['action']]);
}
else {
	$params = ['mensaje' => 'Error 404: El controlador '. $controlador['controller'].'->'.$controlador['action'] .' no existe.'];
	require __DIR__ . '/../app/templates/404.php';	
	exit();

	//header('Status: 404 Not Found');
	//echo '<html><body>Error 404: El controlador '. $controlador['controller'].'->'.$controlador['action'] .'no existe.</body></html>';
}