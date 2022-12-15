<?php ob_start() ?>
<table>
	<tr>
		<th>Nombre</th>
		<th>Descripción</th>
		<th>Edad</th>
		<th>Manganime</th>
	</tr>
	<?php foreach ($params['personajes'] as $personaje) : ?>
		<tr>
			<td><a href="index.php?accion=ver&manganimeId=<?= $personaje['manganime'] ?>"><?= $personaje['nombre'] ?></a></td>
			<td><?= $personaje['descripcion'] ?></td>
			<td><?= $personaje['edad'] ?></td>
			<td><?= $personaje['manganime'] ?></td>
		</tr>
	<?php endforeach; ?>
</table>

<?php $contenido = ob_get_clean() ?>

<?php include 'layout.php' ?>