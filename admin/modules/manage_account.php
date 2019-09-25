<fieldset>
	<legend>Inscription Client</legend>
<?php

if (isset($_POST['nom']) AND ctype_alpha($_POST['nom']) AND
!empty($_POST['nom']) AND
ctype_alpha($_POST['prenom']) AND
!empty($_POST['prenom']) AND
filter_var($_POST['mail'], FILTER_VALIDATE_EMAIL) AND
!empty($_POST['mail']) AND
strlen($_POST['pass']) > 6 AND
$_POST['pass'] == $_POST['pass_verif'] AND
$_POST['addr'] != "")
{
	$_POST['pass'] = hash('whirlpool', $_POST['pass']);
	for ($a = 0; isset(array_keys($_POST)[$a]); $a++)
		$_POST[array_keys($_POST)[$a]] = htmlspecialchars($_POST[array_keys($_POST)[$a]]);
	unset($_POST['pass_verif']);
	file_put_contents("../db/users/".hash('whirlpool', $_POST['mail']).".user", serialize($_POST));
	echo "<h2>Créé !</h2>";
}
else {
	$wrong = (!isset($_POST['pseudo']))?"style='border: 2px solid red;'":"";
?>
<form action="?manage_account" method="POST" class="connect">
	<input type="text" name="nom" placeholder="Nom" <?= (isset($_POST['nom']) AND (empty($_POST) || !ctype_alpha($_POST['nom'])))?$wrong:"" ?>/><br/>
	<input type="text" name="prenom" placeholder="Pr&eacute;nom" <?= (isset($_POST['prenom']) AND (empty($_POST) || !ctype_alpha($_POST['prenom'])))?$wrong:"" ?>/><br/>
	<input type="text" name="mail" placeholder="Adresse mail" <?= (isset($_POST['mail']) AND !filter_var($_POST['mail'], FILTER_VALIDATE_EMAIL))?$wrong:"" ?>/><br/>
	<input type="text" name="addr" placeholder="Votre adresse postale" <?= (isset($_POST['addr']) AND empty($_POST['addr']))?$wrong:"" ?>/><br/>
	<input type="password" name="pass" placeholder="Mot de passe (Plus de 6 caractères)" <?= (isset($_POST['pass']) AND (empty($_POST['pass']) || $_POST['pass'] != $_POST['pass_verif']))?$wrong:"" ?>/><br/>
	<input type="password" name="pass_verif" placeholder="Confirmation mot de passe" <?= (isset($_POST['pass_verif']) AND (empty($_POST['pass_verif']) || $_POST['pass'] != $_POST['pass_verif']))?$wrong:"" ?>/><br/>
	<input type="submit" value="Inscription"/>
</form>
<?php
}
?>
</fieldset>

<fieldset>
	<legend>Inscription Admin</legend>
<?php

if (isset($_POST['pseudo']) AND !file_exists("users/".$_POST['pseudo']))
{
	$_POST['pass'] = hash('whirlpool', $_POST['pass']);
	file_put_contents("users/".$_POST['pseudo'], serialize($_POST));
	echo "<h2>Créé !</h2>";
}
else {
	$wrong = "style='border: 2px solid red;'";
?>
<form action="" method="POST" class="connect">
	<input type="text" name="pseudo" placeholder="pseudo"/>
	<input type="password" name="pass" placeholder="password"/>
	<input type="submit" value="Inscription"/>
</form>
<?php
}
?>
</fieldset>