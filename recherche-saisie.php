<form method="post" action="#" >
	<fieldset>
	<div class = "ui-widget">
    	<h3>Recherche des cocktails par une zone de saisie</h3>
    	<label for = "autocomplete-1">Ingredients souhaitées: </label>
    		<input name = "autocomplete-1" id = "autocomplete-1" value="<?php if(isset($_POST['autocomplete-1']))  echo $_POST['autocomplete-1']; ?>">
        <label for = "autocomplete-3">Ingredients souhaitées: </label>
            <input name = "autocomplete-3" id = "autocomplete-3" value="<?php if(isset($_POST['autocomplete-3']))  echo $_POST['autocomplete-3']; ?>">   
    	<label for = "autocomplete-2">Ingredients non-souhaitées: </label>
    		<input name = "autocomplete-2" id = "autocomplete-2" value="<?php if(isset($_POST['autocomplete-2']))  echo $_POST['autocomplete-2']; ?>">
	</div>
		<input type="submit" name="submit" value="Valider" />
	</fieldset>		
</form>

<div id="elementsTrouves">
    <?php
    include_once("getIngredients.php");
    $mauvaisIngredient = false;
    echo '<ul>';
    if ( (isset($_POST['autocomplete-1'])) && ((trim($_POST['autocomplete-1'])) != "") ){
    	$ingredient = trim($_POST['autocomplete-1']);
    	   $recettesCorrespondants = recettesCorrespondants($ingredient);
    	   if ( (isset($_POST['autocomplete-2'])) && ((trim($_POST['autocomplete-2'])) != "") ){
    		  $nonIngredient = trim($_POST['autocomplete-2']);
                if (rechercheIngredient($nonIngredient)) {
    		        $recettesNonCorrespondantes = recettesCorrespondants($nonIngredient);
    		        $recettefinales = array_diff($recettesCorrespondants, $recettesNonCorrespondantes);
                    if ( (isset($_POST['autocomplete-3'])) && ((trim($_POST['autocomplete-3'])) != "") ){
                        $supIngredient = trim($_POST['autocomplete-3']);
                        if (rechercheIngredient($supIngredient)) {
                            $recettesCorrespondantsSup = recettesCorrespondants($supIngredient);
                            $recettefinales = array_intersect($recettefinales, $recettesCorrespondantsSup);
                        } else {
                            $mauvaisIngredient = true;
                            echo $supIngredient." n'est pas un ingrédient valide. Veuillez en selectionner un nouveau. <br>";
                        }
                    }
                } else {
                    $mauvaisIngredient = true;
                    echo $nonIngredient." n'est pas un ingrédient valide. Veuillez en selectionner un nouveau. <br>";
                }
            }
            if ( (isset($_POST['autocomplete-3'])) && ((trim($_POST['autocomplete-3'])) != "") ){
                $supIngredient = trim($_POST['autocomplete-3']);
                if (rechercheIngredient($supIngredient)) {
                    $recettesCorrespondantsSup = recettesCorrespondants($supIngredient);
                    $recettefinales = array_intersect($recettesCorrespondantsSup, $recettesCorrespondants);
                } else {
                    $mauvaisIngredient = true;
                    echo $supIngredient." n'est pas un ingrédient valide. Veuillez en selectionner un nouveau. <br>";
                }
            }else {
                $recettefinales = $recettesCorrespondants;
            } if (!rechercheIngredient($ingredient)) {
                $mauvaisIngredient = true;
                echo $ingredient." n'est pas un ingrédient valide. Veuillez en selectionner un nouveau. <br>";
            }
    } 
    else if ( (isset($_POST['autocomplete-2'])) && ((trim($_POST['autocomplete-2'])) != "") ){
    	$nonIngredient = trim($_POST['autocomplete-2']);
        if (rechercheIngredient($nonIngredient)) {
    	   $allRecettes = recettesCorrespondants('Aliment');
    	   $recettesNonCorrespondantes = recettesCorrespondants($nonIngredient);
    	   $recettefinales = array_diff($allRecettes, $recettesNonCorrespondantes);
        } else {
            $mauvaisIngredient = true;
            echo $nonIngredient." n'est pas un ingrédient valide. Veuillez en selectionner un nouveau.";
        }
    }
    if (!empty($recettefinales)) {
    	echo 'Voici les recettes que nous vous proposons: <br>';
    	foreach($recettefinales as $index) {
        	echo '<li><a href="?page=cocktail-detail&cocktailId='.$index.'"">'.$Recettes[$index]["titre"].'</a></li>';
    	}
    } else {
        if ( ( (isset($_POST['autocomplete-1'])) || (isset($_POST['autocomplete-2'])) ) && ($mauvaisIngredient == false) ){
    	    echo 'Malheureusement aucune recette ne correspond à votre demande, nous vous proposons celles ci: <br>';
    	    if ((trim($_POST['autocomplete-1'])) != ""){
    	       echo 'Avec '.$ingredient;
    		   foreach($recettesCorrespondants as $index) {
        	       echo '<li><a href="?page=cocktail-detail&cocktailId='.$index.'"">'.$Recettes[$index]["titre"].'</a></li>';
    		    }
    	    }
    	    if ((trim($_POST['autocomplete-2'])) != ""){
    		  echo 'Sans '.$nonIngredient;
    		  $allRecettes = recettesCorrespondants('Aliment');
    		  $recettefinales = array_diff($allRecettes, $recettesNonCorrespondantes);
    		  foreach($recettefinales as $index) {
        	       echo '<li><a href="?page=cocktail-detail&cocktailId='.$index.'"">'.$Recettes[$index]["titre"].'</a></li>';
    		  }
    	   }
        }
    }
    echo '</ul>';
    ?>
</div>

