<form method="post" action="#" >
	<fieldset>
	<div class = "ui-widget">
    	<h3>Recherche des cocktails par une zone de saisie</h3>
    	<label for = "autocomplete-1">Ingredient souhaités 1: </label>
    		<input name = "autocomplete-1" id = "autocomplete-1" value="<?php if(isset($_POST['autocomplete-1']))  echo $_POST['autocomplete-1']; ?>">
        <label for = "autocomplete-3">Ingredient souhaités 2: </label>
            <input name = "autocomplete-3" id = "autocomplete-3" value="<?php if(isset($_POST['autocomplete-3']))  echo $_POST['autocomplete-3']; ?>">   
    	<label for = "autocomplete-2">Ingredient non-souhaité: </label>
    		<input name = "autocomplete-2" id = "autocomplete-2" value="<?php if(isset($_POST['autocomplete-2']))  echo $_POST['autocomplete-2']; ?>">
	</div>
		<input type="submit" name="submit" id="myButton" value="Valider" />
	</fieldset>		
</form>

<div id="elementsTrouves">
    <?php
    include_once("getIngredients.php");
    $mauvaisIngredient = false;
    echo '<ul>';
    //vérifie si qqch est entrer dans autocomplete-1
    if ( (isset($_POST['autocomplete-1'])) && ((trim($_POST['autocomplete-1'])) != "") ){
    	$ingredient = trim($_POST['autocomplete-1']);
    	   $recettesCorrespondants = recettesCorrespondants($ingredient);
           //vérifie si qqch est entrer dans autocomplete-2
    	   if ( (isset($_POST['autocomplete-2'])) && ((trim($_POST['autocomplete-2'])) != "") ){
    		    $nonIngredient = trim($_POST['autocomplete-2']);
                //vérifie que $nonIngredient est un element de la liste
                if (rechercheIngredient($nonIngredient)) {
    		        $recettesNonCorrespondantes = recettesCorrespondants($nonIngredient);
                //créer une array avec les element de $recettesCorrespondants moin ceux de $recettesNonCorrespondantes
    		        $recettefinales = array_diff($recettesCorrespondants, $recettesNonCorrespondantes);
                    //vérifie si qqch est entrer dans autocomplete-3
                    if ( (isset($_POST['autocomplete-3'])) && ((trim($_POST['autocomplete-3'])) != "") ){
                        $supIngredient = trim($_POST['autocomplete-3']);
                        //vérifie que $supIngredient est un element de la liste
                        if (rechercheIngredient($supIngredient)) {
                            $recettesCorrespondantsSup = recettesCorrespondants($supIngredient);
                        //creation d'une liste à partir de ce qui est dans $recettefinales et $recettesCorrespondantsSup
                            $recettefinales = array_intersect($recettefinales, $recettesCorrespondantsSup);
                        } else {
                            //l'ingredient saisie pour $supIngredient n'existe pas
                            $mauvaisIngredient = true;
                            echo $supIngredient." n'est pas un ingrédient valide. Veuillez en selectionner un nouveau. <br>";
                        }
                    }
                } else {
                    //l'ingredient saisie pou $nonIngredient n'existe pas
                    $mauvaisIngredient = true;
                    echo $nonIngredient." n'est pas un ingrédient valide. Veuillez en selectionner un nouveau. <br>";
                }
            }//vérifie si qqch est entrer dans autocomplete-3 mais pas autocomplete-2
            else if ( (isset($_POST['autocomplete-3'])) && ((trim($_POST['autocomplete-3'])) != "") ){
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
            //l'ingredient saisie pour $ingredient n'existe pas
            } if (!rechercheIngredient($ingredient)) {
                $mauvaisIngredient = true;
                echo $ingredient." n'est pas un ingrédient valide. Veuillez en selectionner un nouveau. <br>";
            }
    }
    //vérifie si qqch est entrer dans autocomplete-2 mais pas autocomplete-1
    else if ( (isset($_POST['autocomplete-2'])) && ((trim($_POST['autocomplete-2'])) != "") ){
    	$nonIngredient = trim($_POST['autocomplete-2']);
        if (rechercheIngredient($nonIngredient)) {
    	   $allRecettes = recettesCorrespondants('Aliment');
    	   $recettesNonCorrespondantes = recettesCorrespondants($nonIngredient);
    	   $recettefinales = array_diff($allRecettes, $recettesNonCorrespondantes);
           if ( (isset($_POST['autocomplete-3'])) && ((trim($_POST['autocomplete-3'])) != "") ){
                $supIngredient = trim($_POST['autocomplete-3']);
                //vérifie que $supIngredient est un element de la liste
                if (rechercheIngredient($supIngredient)) {
                    $recettesCorrespondantsSup = recettesCorrespondants($supIngredient);
                    //creation d'une liste à partir de ce qui est dans $recettefinales et $recettesCorrespondantsSup
                    $recettefinales = array_intersect($recettefinales, $recettesCorrespondantsSup);
                } else {
                    //l'ingredient saisie pour $supIngredient n'existe pas
                    $mauvaisIngredient = true;
                    echo $supIngredient." n'est pas un ingrédient valide. Veuillez en selectionner un nouveau. <br>";
                }
            }
        } else {
            $mauvaisIngredient = true;
            echo $nonIngredient." n'est pas un ingrédient valide. Veuillez en selectionner un nouveau.";
        }
    }
    //vérifie si qqch est entrer dans autocomplete-3 mais pas autocomplete-1 ni dans 2
    else if ( (isset($_POST['autocomplete-3'])) && ((trim($_POST['autocomplete-3'])) != "") ){
        $supIngredient = trim($_POST['autocomplete-3']);
        //vérifie que $supIngredient est un element de la liste
        if (rechercheIngredient($supIngredient)) {
            $recettesCorrespondantsSup = recettesCorrespondants($supIngredient);
            $recettefinales = $recettesCorrespondantsSup;
        } else {
            //l'ingredient saisie pour $supIngredient n'existe pas
            $mauvaisIngredient = true;
            echo $supIngredient." n'est pas un ingrédient valide. Veuillez en selectionner un nouveau. <br>";
        }
    }
    //si il existe des recettes correspondantes aux différents critères
    if ( (!empty($recettefinales)) && ($mauvaisIngredient == false) ){
    	echo 'Voici les recettes que nous vous proposons: <br>';
    	foreach($recettefinales as $index) {
        	echo '<li><a href="?page=cocktail-detail&cocktailId='.$index.'"">'.$Recettes[$index]["titre"].'</a></li>';
    	}
    } else { //si aucun résultat prennant en compte tout les critères
        if ( ( (isset($_POST['autocomplete-1'])) || (isset($_POST['autocomplete-2'])) || (isset($_POST['autocomplete-3'])) ) && ($mauvaisIngredient == false) ){
    	    echo 'Malheureusement aucune recette ne correspond à votre demande, nous vous proposons celles ci: <br>';
    	    if ((trim($_POST['autocomplete-1'])) != ""){
                if ((trim($_POST['autocomplete-2'])) != ""){
                    //recettes qui satisfont autocomplete 1 et 2
                   $recettefinales = array_diff($recettesCorrespondants, $recettesNonCorrespondantes);
                   if (!empty($recettefinales)) {echo 'Avec '.$ingredient.' et sans '.$nonIngredient;}
    		       foreach($recettefinales as $index) {
        	           echo '<li><a href="?page=cocktail-detail&cocktailId='.$index.'"">'.$Recettes[$index]["titre"].'</a></li>';
    		        }
                }
                if ((trim($_POST['autocomplete-3'])) != ""){
                    //recettes qui satisfont autocomplete 1 et 3
                   $recettefinales = array_intersect($recettesCorrespondantsSup, $recettesCorrespondants);
                   if (!empty($recettefinales)) {echo 'Avec '.$ingredient.' et '.$supIngredient;}
                   foreach($recettefinales as $index) {
                       echo '<li><a href="?page=cocktail-detail&cocktailId='.$index.'"">'.$Recettes[$index]["titre"].'</a></li>';
                    }
                }
                else {
                    //recettes qui satisfont autocomplete 1
                  echo 'Avec '.$ingredient;
                  $recettefinales = $recettesCorrespondants;
                  foreach($recettefinales as $index) {
                       echo '<li><a href="?page=cocktail-detail&cocktailId='.$index.'"">'.$Recettes[$index]["titre"].'</a></li>';
                  }
                }
    	    }
    	    if ((trim($_POST['autocomplete-2'])) != ""){
                if ((trim($_POST['autocomplete-3'])) != ""){
                    //recettes qui satisfont autocomplete 2 et 3
                   $recettefinales = array_diff($recettesCorrespondantsSup, $recettesNonCorrespondantes);
                   if (!empty($recettefinales)) {echo 'Avec '.$supIngredient.' et sans '.$nonIngredient;}
                   foreach($recettefinales as $index) {
                       echo '<li><a href="?page=cocktail-detail&cocktailId='.$index.'"">'.$Recettes[$index]["titre"].'</a></li>';
                    }
                }
                else {
                    //recettes qui satisfont autocomplete 2 
    		      echo 'Sans '.$nonIngredient;
    		      $allRecettes = recettesCorrespondants('Aliment');
    		      $recettefinales = array_diff($allRecettes, $recettesNonCorrespondantes);
    		      foreach($recettefinales as $index) {
        	           echo '<li><a href="?page=cocktail-detail&cocktailId='.$index.'"">'.$Recettes[$index]["titre"].'</a></li>';
    		      }
                }
    	    }
        }
    }
    echo '</ul>';
    ?>
</div>

