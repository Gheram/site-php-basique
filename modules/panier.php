					<div class="cat">
			<div class="line_cat">
				<h2>Votre Panier</h2>
			</div>
			<div class="list_art">
			<?php
$total = 0;
			if (isset($_SESSION['panier']))
			{
				$panier = $_SESSION['panier'];
				for ($a = 0; isset(array_keys($panier)[$a]); $a++)
				{
					$data = unserialize(file_get_contents("db/articles/".array_keys($panier)[$a].".article"));
					?>
						<div onClick="self.location.href='?product&art=<?= array_keys($panier)[$a] ?>';" class="box" style="background-image: url('<?php 
			if (isset($data['url_img']))
				echo $data['url_img'];
			else
				echo $data['img'];
				 ?>');"><div class="prix"><?= $data['prix'] ?>&euro;</div></div>
					<?php
					$total += $data['prix'];
				}
			}
			if (!isset($_SESSION['panier']) || $a == 0) {
				?>
					<h2 style="font-family: amigos; text-align: center; font-size: 30px;">Votre panier est vide.</h2>
				<?php
			}
			else
			{
				?>
				<h2 style="text-align: right; padding: 10px;">Total (TTC) : <?= $total ?>&euro;</h2>
				<div style="text-align: center;"><a class="confirm" href="<?= (isset($_SESSION['mail']))?"?validate":"?login&need" ?>">Confirmer cette commande</a></div>
				<?php
			}
			?>
			</div>
		</div>