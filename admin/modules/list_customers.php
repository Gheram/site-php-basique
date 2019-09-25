<fieldset>
<legend>Liste des clients</legend>
<?php

	
	if (isset($_GET['del']) AND file_exists("../db/users/".$_GET['del'].".user")) 
		unlink("../db/users/".$_GET['del'].".user");


	$list = glob("../db/users/*.user");

	for ($a = 0; isset($list[$a]); $a++)
	{
		$data = unserialize(file_get_contents($list[$a]));
		?><li><?= $data['prenom'] ?> <?= $data['nom'] ?> <?= $data['mail'] ?> - <a href="?list_customers&del=<?= hash('whirlpool', $data['mail']) ?>">Supprimer</a></li><?php
	}
?>
</fieldset>

<fieldset>
<legend>Liste des admin</legend>
<?php

	
	if (isset($_GET['delete']) AND file_exists($_GET['delete'])) 
		unlink($_GET['delete']);


	$list = glob("users/*");

	for ($a = 0; isset($list[$a]); $a++)
	{
		
		?><li><?= str_replace("users/", "", $list[$a]) ?> - <a href="?list_customers&delete=<?= $list[$a] ?>">Supprimer</a></li><?php
	}
?>
</fieldset>