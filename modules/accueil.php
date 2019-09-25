
<?php

	$list_articles = glob("db/articles/*.article");
	$categories = [];
	for ($a = 0; isset($list_articles[$a]); $a++)
	{
		$data = unserialize(file_get_contents($list_articles[$a]));
		$tags = explode(";", $data['tags']);
		for ($b = 0; isset($tags[$b]); $b++)
		{
			if (!isset($categories[$tags[$b]]))
				$categories[$tags[$b]] = 1;
		}
	}

		@include("src/function.php");

		show_cat("son");
		show_cat("mobilité");
		show_cat("éléctronique");
		show_cat("psychoactif");
?>