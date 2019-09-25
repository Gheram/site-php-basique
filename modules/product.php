<?php

	if (isset($_GET['art']) AND file_exists("db/articles/".$_GET['art'].".article"))
	{
		$data = unserialize(file_get_contents("db/articles/".$_GET['art'].".article"));
		?>

		<div class="cat">
			<div class="line_cat">
				<h2><?= $data['nom'] ?></h2>
			</div>
				<div class="presentation">
				 <div style="width: 20%; display: inline-block;">
					<img src="<?php 
			if (isset($data['url_img']))
				echo $data['url_img'];
			else
				echo $data['img'];
				 ?>"/></div>
				 <div style="width: 79%; display: inline-block;">

				 <h3>Description</h3>
				 <p><?= $data['description'] ?></p>
				 <li style="margin-left: 50px;">En stock : <?= $data['stock'] ?></li>
				 <li style="margin-left: 50px;">Tags : <?= $data['tags'] ?></li>
				 <h2 class="prix"><?= $data['prix'] ?> &euro;</h2>
				 </div>
					 <div class="option">
					 	<?php

					 	if (isset($_GET['add_panier']))
					 	{
					 		$_SESSION['panier'][$_GET['art']] = 1;
					 	}
					 	else if (isset($_GET['remove_panier']))
					 	{
					 		unset($_SESSION['panier'][$_GET['art']]);
					 	}
			 			if (isset($_SESSION['panier'][$_GET['art']]))
				 		{
				 			?><a href="?product&art=<?= $_GET['art'] ?>&remove_panier">Retirer du panier</a>
					 		<?php
					 	}
					 	else
					 	{ ?>
					 		<a href="?product&art=<?= $_GET['art'] ?>&add_panier">Ajouter au panier</a>
				 		<?php 
				 		} ?>
				 	</div>
				</div>
		</div>

		<?php
	}

?>