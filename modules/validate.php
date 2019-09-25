<?php

		if (isset($_POST['addr']) AND !empty($_POST['addr'])
			AND isset($_SESSION['mail']) AND isset($_SESSION['panier'])
			AND count($_SESSION['panier']) >= 1)
		{
			date_default_timezone_set("Europe/Paris");
			$user = unserialize(file_get_contents("db/users/".hash('whirlpool', $_SESSION['mail']).".user"));
			$data['client'] = hash('whirlpool',$_SESSION['mail']);
			$data['livraison'] = $_POST['addr'];
			$data['products'] = $_SESSION['panier'];
			$data['livraison_date'] =  date("d/m/Y H:i", time()+(3600*24*7));
			$data['date'] =  date("d/m/Y H:i");
			file_put_contents("db/commandes/".hash('whirlpool', date("U")).".cmd", serialize($data));
			unset($_SESSION['panier']);
			?>
			<div class="cat">
	<div class="line_cat">
		<h2>Voil&agrave; !</h2>
	</div>
				<h2 style="text-align: center;">Merci <?= $user['prenom'] ?>!</h2>
				<h3 style="text-align: center;">La livraison aura lieu le <?= date("d/m/Y", time()+(3600*24*7)) ?> aux alentours de <?= date("H:i", time()+(3600*24*7)) ?></h3>
			<?php
		}
		else if (isset($_SESSION['mail']) AND isset($_SESSION['panier']) AND count($_SESSION['panier']) >= 1)
		{
			$data = unserialize(file_get_contents("db/users/".hash('whirlpool', $_SESSION['mail']).".user"));
?>
<div class="cat">
	<div class="line_cat">
		<h2>Confirmation de votre commande</h2>
	</div>
</div>
<form action="?validate" method="POST" class="connect">
<h2 style="text-align: center;">Destinataire : <?= $data['nom'] ?> <?= $data['prenom'] ?></h2>
<h2 style="text-align: center;">Cette adresse de livraison est elle correcte ?</h2>
<input type="text" name="addr" placeholder="Adresse de livraison" value="<?= $data['addr'] ?>"/>

<h2 style="text-align: center;">R&eacute;capitulatif</h2>
<table class="recap">
	<tr><td>Nom de ou des articles</td><td>Prix</td></tr>
<?php
$panier = $_SESSION['panier'];
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
<input type="submit" value="Confirmer"/>
	</form>

	<?php
		}
		else
		{
			echo "<script>alert('vous allez être redirigé(e).'); self.location.href='index.php';</script>";
		}
	?>