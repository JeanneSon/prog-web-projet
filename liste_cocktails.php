<?php
    $choixIngredient = "";

    if (isset($_GET['page'])) {
        if(isset($_GET['liste'])) {
            $choixIngredient = $_GET['liste'];
        }
    }

    $allcocktailsIngredients = array();
    $allcocktailsKeys[] = array();
    foreach ($Recettes as $key => $innerArray) {
        if ($choixIngredient == "") {
            $allcocktailsKeys[] = $key;
        }
        else if (is_array($innerArray)) {//1471
            foreach ($innerArray as $superEtSous => $innerInnerArray) {
                if(is_array($innerInnerArray)) {
                    foreach ($innerInnerArray as $ingredient) {
                        if ($ingredient == $choixIngredient) {
                            $allcocktailsKeys[] = $key;
                        }
                    }
                }
            }
        }
    }
    //print_r($allcocktailsKeys);

    foreach ($Recettes as $key => $innerArray) {
        ?> <ul> <?php
        foreach($allcocktailsKeys as $element => $innerElement){
            if(!is_array($innerElement)) {
                if ($innerElement == $key) {
                    if (is_array($innerArray)) {
                        echo '<li><a href="?page=cocktail-detail&cocktailId='.$key.'"">'.$innerArray['titre'].'</a></li>';
                    }
                }
            }
        }   
        ?> </ul> <?php
    }

    //$cocktailsIngredients = implode("<br>", $allcocktailsIngredients);
    //echo $cocktailsIngredients;

    
    ?>