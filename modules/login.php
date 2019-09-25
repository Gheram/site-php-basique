<?php
if (isset($_POST['mail']) AND isset($_POST['pass']))
{
	session_start();
	$path = "../db/users/".hash('whirlpool', $_POST['mail']).".user";
	if (file_exists($path))
	{
		$data = unserialize(file_get_contents($path));
		if (hash('whirlpool', $_POST['pass']) == $data['pass'])
		{
			$_SESSION['mail'] = $_POST['mail'];
			header("location: ../?panier");
			exit;
		}
	}
	header("location: ../?login");
	exit;
}
?>
<div class="cat">
	<div class="line_cat">
		<h2>Connexion</h2>
	</div>
</div>
<form action="modules/login.php" method="POST" class="connect">
	<?php
		if (isset($_GET['need']))
			echo "<h3 style='text-align:center;'>Vous devez &ecirc;tre connect&eacute; pour poursuivre votre commande.</h3>";
	?>
	<input type="text" placeholder="Adresse mail" name="mail"/><br/>
	<input type="password" placeholder="Mot de passe" name="pass"/><br/>
	<input type="submit" value="Connexion"/>
</form>