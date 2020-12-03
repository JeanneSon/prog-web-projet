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

// afficher les recettes correspondants
function recettesCorrespondants($ingredient) {
    include("Donnees.inc.php");
    $ingredientsPotentiels = [$ingredient];
    $resultat = [];
    foreach ($Recettes as $r) {
        foreach ($r["index"] as $i) {
            if ($i == $ingredient) {
                array_push($resultat, $r["titre"]);
            }
        }
    }
    return $resultat;
}
?>