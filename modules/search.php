<div class="cat">
			<div class="line_cat">
				<h2>Rechercher</h2>
			</div>
</div>
<form action="" method="POST" class="search">
<input type="text" name="search" placeholder="Que recherchez vous ?"/>
<input type="submit" value="Rechercher"/>
</form>
<?php

	@include("src/function.php");

	if (isset($_POST['search']))
	{
		$found = 0;
		$list_tags = explode(" ", $_POST['search']);
		if (is_array($list_tags))
		{
			for ($a = 0; isset($list_tags[$a]); $a++)
			{
				if ($list_tags[$a] == "")
					continue;
				if (show_cat($list_tags[$a]))
					$found = 1;
			}
		}
			if ($found == 0)
				?>
					<h2 style="font-family: amigos; text-align: center; font-size: 30px;">Aucun r&eacute;sultat.</h2>
				<?php
	}

?>