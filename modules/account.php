<div class="cat">
	<div class="line_cat">
		<h2>Mon compte</h2>
	</div>
</div>
<?php
	if (isset($_GET['modify']))
		@include("modules/account_edit.php");
	else if (isset($_GET['cmd']))
		@include("modules/account_cmd.php");
	else {
	?>
	<div style="text-align: center; padding: 50px;">
		<a href="?account&modify" class="confirm" style="margin: auto; display: inline-block;">G&eacute;rer mon compte</a>
		<a href="?account&cmd" class="confirm" style="margin: auto; display: inline-block;">Voir mes commandes</a>
	</div>
<?php
}
?>