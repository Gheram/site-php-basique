<div class="cat">
	<div class="line_cat">
		<h2>Inscription</h2>
	</div>
</div>
<?php

if (isset($_POST['nom']) AND ctype_alpha($_POST['nom']) AND
!empty($_POST['nom']) AND
ctype_alpha($_POST['prenom']) AND
!empty($_POST['prenom']) AND
filter_var($_POST['mail'], FILTER_VALIDATE_EMAIL) AND
!empty($_POST['mail']) AND
strlen($_POST['pass']) > 6 AND
$_POST['pass'] == $_POST['pass_verif'] AND
$_POST['addr'] != "" AND !file_exists("db/users/".hash('whirlpool', $_POST['mail']).".user"))
{
	$_POST['pass'] = hash('whirlpool', $_POST['pass']);
	for ($a = 0; isset(array_keys($_POST)[$a]); $a++){
		if (array_keys($_POST)[$a] == "pass" OR array_keys($_POST)[$a] == "mail")
			continue;
		$_POST[array_keys($_POST)[$a]] = htmlspecialchars($_POST[array_keys($_POST)[$a]]);
	}
	unset($_POST['pass_verif']);
	file_put_contents("db/users/".hash('whirlpool', $_POST['mail']).".user", serialize($_POST));
	?>
		<h2 style="text-align: center;">Vous &ecirc;tes &agrave; pr&eacute;sent inscrit !</h2>
		<h4 style="text-align: center;">vous pouvez d'ores et d&eacute;j&agrave; commander. Nous vous remercions de votre confiance.</h4>
	<?php
}
else {
	$wrong = "style='border: 2px solid red;'";

	if (isset($_POST['mail']) AND file_exists("db/users/".hash('whirlpool', $_POST['mail']).".user"))
		echo "<h2 style='text-align: center;'>Un compte est d&eacute;j&agrave; associ&eacute; &agrave; cette adresse mail.</h2>";

?>
<form action="" method="POST" class="connect">
	<input type="text" name="nom" placeholder="Nom" <?= (isset($_POST['nom']) AND (empty($_POST) || !ctype_alpha($_POST['nom'])))?$wrong:"" ?>/><br/>
	<input type="text" name="prenom" placeholder="Pr&eacute;nom" <?= (isset($_POST['prenom']) AND (empty($_POST) || !ctype_alpha($_POST['prenom'])))?$wrong:"" ?>/><br/>
	<input type="text" name="mail" placeholder="Adresse mail" <?= (isset($_POST['mail']) AND !filter_var($_POST['mail'], FILTER_VALIDATE_EMAIL))?$wrong:"" ?>/><br/>
	<input type="text" name="addr" placeholder="Votre adresse postale" <?= (isset($_POST['addr']) AND empty($_POST['addr']))?$wrong:"" ?>/><br/>
	<input type="password" name="pass" placeholder="Mot de passe (Plus de 6 caractères)" <?= (isset($_POST['pass']) AND (empty($_POST['pass']) || $_POST['pass'] != $_POST['pass_verif']))?$wrong:"" ?>/><br/>
	<input type="password" name="pass_verif" placeholder="Confirmation mot de passe" <?= (isset($_POST['pass_verif']) AND (empty($_POST['pass_verif']) || $_POST['pass'] != $_POST['pass_verif']))?$wrong:"" ?>/><br/>
	<input type="submit" value="inscription"/>
</form>
<?php
}
?>