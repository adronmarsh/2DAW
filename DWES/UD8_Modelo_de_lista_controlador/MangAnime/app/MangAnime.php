<?php
class MangAnime
{
	protected $conexion;

	public function __construct($dbname, $dbuser, $dbpass, $dbhost)
	{

		$opciones = [PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'];
		try {
			$conexion = new PDO('mysql:host=' . $dbhost . ';dbname=' . $dbname, $dbuser, $dbpass, $opciones);

			$this->conexion = $conexion;
		} catch (PDOException $e) {
			$error = 'Falló la conexión: ' . $e->getMessage();
			die('No ha sido posible realizar la conexión con la base de datos: ' . $conexion->connect_error);
		}
	}

	public function getMangAnimes()
	{
		// DOIT: crear consulta que devuelve todos los MangAnimes ordenados por estreno descendente
		$sql = 'SELECT * FROM manganime ORDER BY estreno DESC';
		$result = $this->conexion->query($sql);

		return $result->fetchAll(PDO::FETCH_ASSOC);
	}

	public function findMangAnimesByName($nombre, $orden = 'estreno', $ascDesc = 'DESC')
	{
		$nombre = htmlspecialchars($nombre);

		// DOIT: crear consulta para buscar MangAnimes por nombre en el orden y sentido indicados usando los parámetros recibidos
		$sql = 'SELECT * FROM manganime WHERE nombre like ? ORDER BY ' . $orden . ' DESC ';
		$result = $this->conexion->prepare($sql);
		$result->execute(['%' . $nombre . '%']);

		return $result->fetchAll(PDO::FETCH_ASSOC);
	}

	public function getMangAnime($id)
	{
		$id = htmlspecialchars($id);

		// DOIT: crear consulta para buscar un MangAnime por su id usando el parámetro recibido
		$sql = 'SELECT * FROM manganime WHERE id = ?';
		$result = $this->conexion->prepare($sql);
		$result->execute([$id]);

		return $result->fetch(PDO::FETCH_ASSOC);
	}

	public function insertMangAnime($nombre, $creador, $genero, $demografia, $estreno, $fin, $tomos, $capitulos, $imagen)
	{
		$nombre = htmlspecialchars($nombre);
		$creador = htmlspecialchars($creador);
		$genero = htmlspecialchars($genero);
		$demografia = htmlspecialchars($demografia);
		$estreno = htmlspecialchars($estreno);
		$fin = htmlspecialchars($fin);
		$tomos = htmlspecialchars($tomos);
		$capitulos = htmlspecialchars($capitulos);
		$imagen = htmlspecialchars($imagen);

		$sql = 'INSERT INTO manganime (nombre, creador, genero, demografia, estreno, fin, tomos, capitulos, imagen) VALUES (?,?,?,?,?,?,?,?,?);';
		$result = $this->conexion->prepare($sql);
		$result->execute([$nombre, $creador, $genero, $demografia, $estreno, $fin, $tomos, $capitulos, $imagen]);

		return $result;
	}

	public function validarDatos($nombre, $creador, $genero, $demografia, $estreno, $fin, $tomos, $capitulos)
	{
		return (is_string($nombre) && is_string($creador) && is_string($genero) && is_string($demografia) && is_string($estreno) && is_string($fin) && is_numeric($tomos) && is_numeric($capitulos));
	}
}
