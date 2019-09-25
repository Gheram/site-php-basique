<?php

	if (isset($_GET['del']) AND file_exists($_GET['del']))
		unlink($_GET['del']);

?><fieldset>
	<legend>G&eacute;rer les articles</legend>
	<table class="list">
		<tr><td>Nom</td><td>stock</td><td>nombre de vente</td><td>action</td></tr>
	<?php

	$list = glob("../db/articles/*.article");
	for ($a = 0; isset($list[$a]); $a++)
	{
		$data = unserialize(file_get_contents($list[$a]));
		?>
			<tr title="id article : <?= $data['id_article'] ?>">
	<td><?= (strlen($data['nom']) > 30)?substr($data['nom'], 0, 30)."...":$data['nom'] ?></td>
	<td><?= $data['stock'] ?></td>
	<td><?= $data['vente'] ?></td>
	<td><a href="?list_articles&del=<?= $list[$a] ?>"><img src="croix.png" style="width: 20px;"/></a><a href="?modify_art&q=<?= $data['id_article'] ?>"><img src="https://icon-icons.com/icons2/748/PNG/512/pencil_icon-icons.com_63715.png" style="width: 20px; background-color: white;"/></a></td>
			</tr>
		<?php
	}

	?>
	</table>
</fieldset>