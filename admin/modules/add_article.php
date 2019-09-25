<fieldset>
	<legend>Ajouter un article</legend>

<form action="?add_article" method="POST" enctype="multipart/form-data">
<input type="text" name="nom" placeholder="Nom de l'article"/>
<input type="text" name="stock" placeholder="Combien en stock ?"/>
<input type="text" name="taille" placeholder="Taille"/>
<textarea placeholder="Description de l'article" style="height: 200px;" name="description"></textarea>
<input type="text" name="tags" placeholder="tag1;tag2;tag3"/><br>
<fieldset>
<br><b style="margin: auto; display: block; width: 80%;">Image de présentation de l'article</b>
<input type="file" name="img"/>
<h3 style="width: 80%; margin: 0px auto 0px auto; font-size: 30px; color: red;">Ou</h3>
<input type="text" name="url_img" placeholder="Url de l'image"/><br/>
</fieldset>
<h2 style="text-align: center;"><input type="text" name="prix" style="width: 100px; display: inline-block;" placeholder="9999.9999" /><span style="font-size: 40px;">&euro;</span></h2>
<input type="submit" value="enregistrer"/>
</form>
<?php
if (isset($_POST['nom']) AND isset($_POST['description']) AND isset($_POST['prix']) AND isset($_POST['tags'])
AND (isset($_FILES['img']['tmp_name']) OR !empty($_POST['url_img'])))
{
	if (empty($_POST['url_img'])) {
		move_uploaded_file($_FILES['img']['tmp_name'], "../db/articles_img/".hash('whirlpool', $_POST['nom']."-".date("U")).".png");
		unset($_POST['url_img']);
		$_POST['img'] = "db/articles_img/".hash('whirlpool', $_POST['nom']."-".date("U")).".png";
	}
	$_POST['id_article'] = hash('whirlpool', date("U"));
	$_POST['ventes'] = 0;
	file_put_contents("../db/articles/".$_POST['id_article'].".article", serialize($_POST));
	echo "<h2 style='text-align: center;'>Article enregistr&eacute; avec succ&eacute; !</h2>";
} ?>
</fieldset>