<?php
    foreach ($Recettes as $key => $innerArray) {
        ?> <ul> <?php
        if (is_array($innerArray)) {
            //?page=cocktail-detail&cocktailId=3
            echo '<li><a href="#">'.$innerArray['titre'].'</a></li>';
        }
        ?> </ul> <?php
    }
    ?>
    <?php
    $allcocktailsIngredients = array();
    foreach ($Recettes as $key => $innerArray) {
        $allcocktailsIngredients[] = $key; //ligne 1470
        if (is_array($innerArray)) {//1471
            foreach ($innerArray as $superEtSous => $innerInnerArray) {
                if(is_array($innerInnerArray)) {
                    foreach ($innerInnerArray as $ingredient) {
                        $allcocktailsIngredients[] = $ingredient;
                    }
                }
            }
        }
    }
    $cocktailsIngredients = implode("<br>", $allcocktailsIngredients);
    //echo $cocktailsIngredients;
    ?>