<?php include 'Donnees.inc.php';
    $filsariane = 'Aliment';
        //génere la liste des sous categorie d'un ingredient
        function generationliste( $index) {
            include 'Donnees.inc.php';
            if (isset($Hierarchie[$index]['sous-categorie'])) {
                $categories = $Hierarchie[$index]['sous-categorie'];
                $all = array();
                foreach ($categories as $categorie){
                    array_push($all, $categorie);
                }
                return $all;
            }
        }
        //génére la liste des cocktails sous forme de liens cliquable
        function affichageliste($ingredient){
            ?> <ul> <?php
            if (null !== generationliste($ingredient)) {
                $arraydata = generationliste($ingredient);
                foreach ($arraydata as $data){
                    echo '<li><a href="?page=recherche&recherche='.$data.'">'.$data.'</a></li>';   
                }
            }
            ?> </ul> <?php
        }
        //recupère l'ingredient
        if (isset($_GET['page'])) {
            if(isset($_GET['recherche'])) {
                $ingredient=$_GET['recherche'];
                $filsariane.=" / ".$ingredient;
            }
            echo $filsariane;
            include($_GET['page'].".php");
        }
        else
            echo affichageliste('Aliment');
?>