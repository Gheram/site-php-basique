<?php

	$list_cmd = glob("db/commandes/*.cmd");
	for ($a = 0; isset($list_cmd[$a]); $a++)
	{
		$data = unserialize(file_get_contents($list_cmd[$a]));
		if ($data['client'] == hash('whirlpool', $_SESSION['mail']))
			$list[] = $data;
	}

	for ($b = 0; isset($list[$b]); $b++)
	{
?>
<hr>
<h2>Votre commande du <?= $list[$b]['date'] ?></h2>
<table class="recap" style="display: inline-block;">
	<tr><td>Nom de ou des articles</td><td>Prix</td></tr>
<?php
$panier = $list[$b]['products'];
$total = 0;
for ($a = 0; isset(array_keys($panier)[$a]); $a++)
{
	$data = unserialize(file_get_contents("db/articles/".array_keys($panier)[$a].".article"));
?>
<tr><td><?= $data['nom'] ?></td><td><?= $data['prix'] ?></td></tr>
<?php
	$total += $data['prix'];
}
?>
<tr><td><big>Total TTC</big></td><td><?= $total ?>&euro;</td></tr>
</table>
<h2>Livraison pr&eacute;vue : <?= $list[$b]['livraison_date'] ?></h2>
<?php
	}

	if (count($list) == 0)
	{
		?>
		<h2 style="text-align: center;">Il semblerait que vous n'ayez aucune livraison de pr&eacute;vue ! Qu'attendez vous ?</h2>
		<?php

	}

?>