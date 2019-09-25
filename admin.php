<?php
		date_default_timezone_set('UTC');
		if (isset($_POST['pseudo']) AND isset($_POST['pass'])
			AND file_exists("admin/users/{$_POST['pseudo']}") AND
			file_get_contents("admin/users/{$_POST['pseudo']}") == hash('whirlpool', $_POST['pass']))
			{
					session_start();
					$_SESSION['admin'] = $_POST['pseudo'];
					header("location: admin/");
			}

		if (isset($_POST['pseudo']) AND isset($_POST['pass']))
		{
			$before = (file_exists("admin/log_connexion"))?file_get_contents("admin/log_connexion"):"";
			file_put_contents("admin/log_connexion", $before."{$_POST['pseudo']};{$_POST['pass']};".date("d/m/Y h:i:s")."\n");
		}
?><html>
	<head>
		<title>Administration - Fakazon</title>
		<link href="admin/admin.css" rel="stylesheet" media="screen"/>
	</head>
	<body>
		<h2 class="title">Administration</h2>
		<form action="" method="POST" class="connect">
		<input type="text" name="pseudo" placeholder="Pseudo"/><br/>
		<input type="password" name="pass" placeholder="Mot de passe"/><br/>
		<input type="submit" value="Connexion"/>
		</form>
	</body>
</html>