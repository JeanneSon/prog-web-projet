<?php include 'Donnees.inc.php';?>
<!DOCTYPE html>
<html>

<head>
    <title></title>
</head>
<body>
    <?php
        $allcocktails = array();
    foreach ($Recettes as $key => $innerArray) {
        $allcocktails[] = $key; 
        if (is_array($innerArray)) {
            $allcocktails[] = $innerArray['titre'];
        }
    }
    $cocktails = implode("<br>", $allcocktails);
    echo $cocktails;
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
    echo $cocktailsIngredients;
    ?>
</body>
</html>