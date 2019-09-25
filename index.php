<?php
session_start();
require_once('install.php');
if (isset($_GET['delog'])) {
	unset($_SESSION['mail']);
	session_destroy();
}
?>
<html>
	<head>
		<title>StuffSpace</title>
		<link href="src/style.css" rel="stylesheet" media="screen"/>
	</head>
	<body>
		<div class="bandeau">
			<h1>StuffSpace</h1>
			<div class="menu"> <a href="?">Accueil</a> - <a href="?panier">Mon panier</a> - <a href="?search">Rechercher</a> - <?php
	if (!isset($_SESSION['mail']))
	{ ?><a href="?login">Connexion</a> - <a href="?inscription">Inscription</a><?php }
	else
	{ ?><a href="?account">Mon compte</a> - <a href="?delog">D&eacute;connexion</a><?php }
				?>
		</div>
		</div>
			<div class="all">
		<div class="content">
			<?php
			if (isset(array_keys($_GET)[0]) AND file_exists("modules/".array_keys($_GET)[0].".php"))
				@include("modules/".array_keys($_GET)[0].".php");
			else
				@include("modules/accueil.php");
			?>
		</div>
		<div class="footer">
			<b>Site internet cr&eacute;&eacute; par :</b>
			<br><b>Gheram Toumanian</b>
			<br><b>Cedric M'passi</b>
		</div>
	</div>
	</body>
</html>
