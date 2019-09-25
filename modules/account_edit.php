<?php

$user = unserialize(file_get_contents("db/users/".hash('whirlpool', $_SESSION['mail']).".user"));
if (isset($_POST['nom']) AND ctype_alpha($_POST['nom']) AND !empty($_POST['nom']) AND ctype_alpha($_POST['prenom']) AND !empty($_POST['prenom']))
{
	if (!empty($_POST['pass']) AND strlen($_POST['pass']) > 6 AND $_POST['pass'] == $_POST['pass_verif'])
	{
		$_POST['pass'] = hash('whirlpool', $_POST['pass']);
	}
	for ($a = 0; isset(array_keys($_POST)[$a]); $a++){
		if (array_keys($_POST)[$a] == "pass" OR array_keys($_POST)[$a] == "mail")
			continue;
		$_POST[array_keys($_POST)[$a]] = htmlspecialchars($_POST[array_keys($_POST)[$a]]);
	}
	unset($_POST['pass_verif']);
	file_put_contents("db/users/".hash('whirlpool', $_SESSION['mail']).".user", serialize($_POST));
	?>
		<h2 style="text-align: center;">Les changements ont bien &eacute;t&eacute; pris en compte !</h2>
	<?php
$user = unserialize(file_get_contents("db/users/".hash('whirlpool', $_SESSION['mail']).".user"));
}
?>
<form class="connect" action="?account&modify" method="POST">
	<input type="text" name="nom" placeholder="Nom" value="<?= $user['nom'] ?>" <?= (isset($_POST['nom']) AND (empty($_POST) || !ctype_alpha($_POST['nom'])))?$wrong:"" ?>/><br/>
	<input type="text" name="prenom" placeholder="Pr&eacute;nom" value="<?= $user['prenom'] ?>" <?= (isset($_POST['prenom']) AND (empty($_POST) || !ctype_alpha($_POST['prenom'])))?$wrong:"" ?>/><br/>
	<input type="text" name="addr" placeholder="Votre adresse postale" value="<?= $user['addr'] ?>" <?= (isset($_POST['addr']) AND empty($_POST['addr']))?$wrong:"" ?>/><br/>
	<h5 style="text-align:center;">Laissez les champs du mot de passe vide si vous ne voulez pas le changer.</h5>
	<input type="password" name="pass" placeholder="Mot de passe (Plus de 6 caractères)" <?= (isset($_POST['pass']) AND (empty($_POST['pass']) || $_POST['pass'] != $_POST['pass_verif']))?$wrong:"" ?>/><br/>
	<input type="password" name="pass_verif" placeholder="Confirmation mot de passe" <?= (isset($_POST['pass_verif']) AND (empty($_POST['pass_verif']) || $_POST['pass'] != $_POST['pass_verif']))?$wrong:"" ?>/><br/>
	<input type="submit" value="Enregistrer les changements"/>
</form>
<button style="margin: auto; margin-top: 100px; opacity: 0.8; cursor: pointer; font-size: 20px; display: block; padding: 5px; background-color: red; color: white; font-weight: bold;" onClick="if (confirm('Souhaitez vous vraiment supprimer votre compte ?')) { self.location.href='delete.php'; }">Supprimer mon compte</button>
