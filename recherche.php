<script>
		<?php include("allingredients.php"); ?>
		$(function() {
			var ingredients = [<?php echo '"'.implode('","', $simple).'"' ?>];
			$("#automplete-1").autocomplete({
				source: ingredients,
				minLength: 1,
				delay: 500,
				autoFocus: true
			});
			$("#automplete-2").autocomplete({
				source: ingredients,
				minLength: 1,
				delay: 500,
				autoFocus: true
			});
		});
</script>

<div class = "ui-widget">
	<h3> Recherche des cocktail par une zone de saisie</h3>
		<label for = "automplete-1">Ingredients souhaitées: </label>
		<input id = "automplete-1">
		<label for = "automplete-2">Ingredients non-souhaitées: </label>
		<input id = "automplete-2">
</div>
<div id=recherche>
	<h3> Recherche de cocktails par une liste</h3>
	<?php include 'liste_ingredients.php';  ?>
</div>
	<?php include 'liste_cocktails.php'; ?>
<?php
if(isset($_GET['recherche'])) {
  		$ingredient=$_GET['recherche'];
   		echo affichageliste($ingredient);
   	}
 ?>