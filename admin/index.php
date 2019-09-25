<?php
	session_start();
	if (array_keys($_GET)[0] == "delog")
	{
		session_destroy();
		unset($_SESSION);
		header("location: ../");
		exit;
	}
	if (!isset($_SESSION['admin']))
	{
		header("location: ../");
		exit;
	}
?><html>
	<head>
		<title>Administration</title>
		<link href="admin.css" rel="stylesheet" media="screen"/>
	</head>
	<body>
		<div class="menu">
			<div class="box">
				Comptes
				<div class="link">
					<a href="?list_customers">Liste des admin/clients</a>
					<a href="?manage_account">Création admin/clients</a>
				</div>
			</div>
			<div class="box">
				Articles
				<div class="link">
					<a href="?add_article">Ajouter un article</a>
					<a href="?list_articles">G&eacute;rer les articles</a>
					<a href="?list_categorie">Liste des cat&eacute;gories</a>
				</div>
			</div>
			<div class="box">
				<a href="?cmd" class="nada">Commandes</a>
			</div>
			<div class="box">
				<a href="?delog" class="nada">Deconnexion</a>
			</div>
		</div>
		<div class="content">
		<?php
			if (isset(array_keys($_GET)[0]) AND file_exists("modules/".array_keys($_GET)[0].".php"))
				@include("modules/".array_keys($_GET)[0].".php");
		?>
		</div>
	</body>
</html>