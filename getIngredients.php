<?php 
if (isset($_GET)) {
    include("Donnees.inc.php");
    header('Content-type: text/html; charset=utf-8');
    if (isset($_GET["type"])) {
        $type = $_GET["type"];
        if ($type == "all") {
            $all = array();
            foreach ($Hierarchie as $key => $innerArray) {
                $all[] = $key; //ligne 1470
                if (is_array($innerArray)) {//1471
                    foreach ($innerArray as $superEtSous => $innerInnerArray) {
                        if(is_array($innerInnerArray)) {
                            foreach ($innerInnerArray as $ingredient) {
                                $all[] = $ingredient;
                            }
                        }
                    }
                }
            }
            $simple = array_unique($all);
            $simpleString = implode(',', $simple);
            echo $simpleString;
        }
    }
}

// liste des sous-catégories
function sousCategories($index) {
    include("Donnees.inc.php");
    if (isset($Hierarchie[$index]['sous-categorie'])) {
        $categories = $Hierarchie[$index]['sous-categorie'];
        $all = array();
        foreach ($categories as $categorie){
            array_push($all, $categorie);
        }
        return $all;
    }
    return [];
}
//
function Recursive($ingredient){
        include("Donnees.inc.php");
        $ingredientPotentiel = [$ingredient];
        $ingredientsPotentiels = array_merge($ingredientPotentiel, sousCategories($ingredient));
        if (!empty(sousCategories($ingredient))) {
            foreach ( (sousCategories($ingredient)) as $element) {
                $ingredientsPotentiels = array_merge($ingredientsPotentiels, sousCategories($element));
                if (!empty(sousCategories($element))) {
                    foreach ( (sousCategories($element)) as $sousElement) {
                        $ingredientsPotentiels = array_merge($ingredientsPotentiels, sousCategories($sousElement));
                        if (!empty(sousCategories($sousElement))) {
                            foreach ( (sousCategories($sousElement)) as $sousSousElement) {
                                $ingredientsPotentiels = array_merge($ingredientsPotentiels, sousCategories($sousSousElement));
                                if (!empty(sousCategories($sousSousElement))) {
                                    foreach ( (sousCategories($sousSousElement)) as $finalElement) {
                                        $ingredientsPotentiels = array_merge($ingredientsPotentiels, sousCategories($finalElement));
                                    }
                                }
                            }
                        }
                    }
                }
            }
        } else {
            $ingredientsPotentielsFinal = array_unique($ingredientsPotentiels);
            return $ingredientsPotentielsFinal;
        }
        $ingredientsPotentielsFinal = array_unique($ingredientsPotentiels);
        return $ingredientsPotentielsFinal;
    }

// afficher les recettes correspondants
function recettesCorrespondants($ingredient) {
    include("Donnees.inc.php");
    $ingredientsPotentiels = Recursive($ingredient);
    $resultat = [];
    foreach ($ingredientsPotentiels as $ingredientPotentiel){
        foreach ($Recettes as $index => $r) {
            foreach ($r["index"] as $i) {
                if ($i == $ingredientPotentiel) {
                    array_push($resultat, $index);
                }
            }
        }
    }
    $recettesCorrespondantes = array_unique($resultat);
    return $recettesCorrespondantes;
}
?>