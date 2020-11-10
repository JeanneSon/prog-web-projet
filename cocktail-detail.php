<?php 
    include_once("./Donnees.inc.php");
    $recette = $Recettes[99];
    $ingredients = explode("|", $recette["ingredients"]);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title><?php echo $recette["titre"];?></title>

    <script>
        function preferer() {
            alert("ajouter cette recette à mes recettes préférées - IMPLEMENT!!");
        }
    </script>
</head>
<body>
    <h1 id="recette_titre"><?php echo $recette["titre"];?></h1>
    <?php 
        $photos = scandir("Photos");
        $photo_dispo = false;
        foreach($photos as $photo) {
            if (substr($photo, -4) == ".jpg") {
                $nom = str_replace("_", " ", substr($photo, 0, -4));
                $motif = "/".$nom."/i";
                if (preg_match($motif, $recette["titre"])) {
                    $photo_dispo = $photo;
                }
            }
        }
        if ($photo_dispo) {
    ?>
    <div>
        <img src='<?php echo "Photos/$photo_dispo" ?>' alt="Cocktail"/>
    </div>

    <?php
            $photo_dispo = false;    
        }
    ?>
    <img  
        src="icons/herz_icon.png" 
        alt="coeur icon"
        id="coeur_icon"
        title="ajouter cette recette à mes recettes préférées"
        onClick="preferer()"
        style="width: 40px;height: 40px; top: 10px; right: 10px; ">
    <h2 class="recette">Ingrédients</h2>
        <ul id="recette_ingredients">
    <?php 
        foreach($ingredients as $ingredient) {
            echo '
            <li>'.$ingredient.'</li>';
        }   
    ?>
        
        </ul>
    <h2 class="recette">Préparation</h2>
    <p id="recette_preparation"><?php echo $recette["preparation"];?></p>

</body>
</html>