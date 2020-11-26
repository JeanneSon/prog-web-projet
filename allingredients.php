<?php
    include("Donnees.inc.php");
    $all = [];
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
?>