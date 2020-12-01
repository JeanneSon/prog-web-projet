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
            if (null !== generationliste($ingredient)) {
                $arraydata = generationliste($ingredient);
                foreach ($arraydata as $data){
                    echo '<li><a href="?page=liste&liste='.$data.'">'.$data.'</a></li>';   
                }
            }
        }
        
        if (isset($_GET['page'])) {
            if(isset($_GET['liste'])) {
                $ingredient=$_GET['liste'];
                $filsariane.=" / ".$ingredient;
            }
            echo $filsariane;
        }
        else
            echo affichageliste('Aliment');
?>