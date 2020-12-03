<?php include 'Donnees.inc.php';
    $filsariane = 'Aliment';
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