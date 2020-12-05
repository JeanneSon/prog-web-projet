<?php
    $choixIngredient = "";
    //recuperation de l'ingredient choisi
    if (isset($_GET['page'])) {
        if(isset($_GET['recherche'])) {
            $choixIngredient = $_GET['recherche'];
        }
    }
    //génération de la liste des index de cocktails qui ont cet ingrédient
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
    //génération de la liste cliquable des cocktails
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
    ?>