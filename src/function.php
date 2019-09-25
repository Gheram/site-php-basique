<?php	function show_cat($tag)
		{
			$list_articles = glob("db/articles/*.article");
			$list = NULL;
			for ($a = 0; isset($list_articles[$a]); $a++)
			{
				$data = unserialize(file_get_contents($list_articles[$a]));
				$list_tag = explode(";", $data['tags']);
				for ($c = 0; isset($data['tags'][$c]); $c++)
				{
					if ($list_tag[$c] == $tag)
						$list[] = $data;
				}
			}
			if (count($list) == 0)
				return (0);

			?>
		<div class="cat">
			<div class="line_cat">
				<h2><?= $tag ?></h2>
			</div>
			<div class="list_art">
	<?php for ($b = 0; isset($list[$b]); $b++)
		{ ?>
			<div class="box" onClick="self.location.href='?product&art=<?= $list[$b]['id_article'] ?>';" style="background-image: url('<?php
			if (isset($list[$b]['url_img']))
				echo $list[$b]['url_img'];
			else
				echo $list[$b]['img'];
				 ?>');"><div class="prix"><?= $list[$b]['prix'] ?>&euro;</div></div>
	<?php } ?>
			</div>
		</div>
			<?php
			return (1);
		}

		?>
