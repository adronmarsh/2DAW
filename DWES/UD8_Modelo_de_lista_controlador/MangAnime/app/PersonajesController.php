<?php
class PersonajesController{
    public function buscarPersonaje()
	{

		$params = [
			'nombre' => '',
			'resultado' => [],
		];

		if ($_SERVER['REQUEST_METHOD'] == 'POST' || isset($_GET['nombre'])) {
			$_POST['nombre'] = isset($_GET['nombre']) ? $_GET['nombre'] : $_POST['nombre'];
			$orden = isset($_GET['orden']) ? $_GET['orden'] : 'nombre';
			$by = isset($_GET['by']) ? $_GET['by'] : 'DESC';

			// DOIT: completar con la instancia del modelo MangAnime
			$mangAnimeModel = new MangAnime(
				Config::$bd_nombre,
				Config::$bd_usuario,
				Config::$bd_clave,
				Config::$bd_hostname
			);
			$params['nombre'] = $_POST['nombre'];
			// Si se necesita pasar el orden y el tipo de orden a la vista:
			$params['orden'] = $orden;
			$params['by'] = $by;
			// DOIT: completar con la llamada al método del modelo que devuelve los manganimes que coinciden con el nombre
			$params['resultado'] = $mangAnimeModel->findMangAnimesByName($params['nombre']);
			unset($mangAnimeModel);
		}
		require __DIR__ . '/templates/buscarPersonaje.php';
	}

    public function mostrarPersonajes()
	{
        // Instancia del modelo MangAnime
		$mangAnimeModel = new MangAnime(
			Config::$bd_nombre,
			Config::$bd_usuario,
			Config::$bd_clave,
			Config::$bd_hostname
		);
        $id = $_GET['id'];
		$params = ['personajes' => $mangAnimeModel->getPersonajes($id)];
		unset($mangAnimeModel);
        require __DIR__ . '/templates/mostrarPersonajes.php';
    }

    public function mostrarPersonajesFromManganime()
	{
        // Instancia del modelo MangAnime
		$mangAnimeModel = new MangAnime(
			Config::$bd_nombre,
			Config::$bd_usuario,
			Config::$bd_clave,
			Config::$bd_hostname
		);
        $manganime = $_GET['manganimeId'];
		$params = ['personajes' => $mangAnimeModel->getPersonajesFromManganime($manganime)];
		unset($mangAnimeModel);
        require __DIR__ . '/templates/mostrarPersonajesFromManganime.php';
    }
}
