<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Liste</title>

        <script>
            function change(ingredient) {
                document.getElementById("liste").innerHTML = <?php echo affichageliste(ingredient) ?>;
            }
        </script>

    </head>
    <body>
        
        <?php
        function generationliste( $index) {
            include 'Donnees.inc.php';
            $categories = $Hierarchie[$index]['sous-categorie'];
            $all = array();
            foreach ($categories as $categorie){
                array_push($all, $categorie);
            }
            return $all;
        }

        function affichageliste($ingredient){
            $arraydata = generationliste($ingredient);
            foreach ($arraydata as $data){
                ?> <p onclick="change(<?php echo $data ?>)"> <?php echo $data ?><br /></p>
            <?php }
        }
        ?>

        <div id="liste">
        <?php 
        echo affichageliste('Aliment');
        ?>
        </div>
        
    </body>
</html>
