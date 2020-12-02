<?php 
    if (isset($_GET["cocktailId"])) {
        $cocktailId = $_GET["cocktailId"];
        if (isset($Recettes[$cocktailId])) {
            $recette = $Recettes[$cocktailId];
            $ingredients = explode("|", $recette["ingredients"]);
?>
    <h3 id="recette_titre"><?php echo $recette["titre"];?></h3>
    <?php 
        $photos = scandir("Photos");
        $photo_dispo = false;
        foreach($photos as $photo) {
            if (substr($photo, -4) == ".jpg") {
                $nom = str_replace("_", " ", substr($photo, 0, -4));
                $titreStandardise = iconv('UTF-8','ASCII//TRANSLIT', $recette["titre"]);
                $titre = "";
                for ($i = 0; $i < strlen($titreStandardise); $i++) {
                    if (preg_match("/[a-z]/i", $titreStandardise[$i])) {
                        $titre .= $titreStandardise[$i];
                    } else if (preg_match("/ /", $titreStandardise[$i])) {
                        $titre .= "_";
                    }
                }
                $titre .= ".jpg";
                $motif = "/".$titre."/i";
                if (preg_match($motif, $photo)) {
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
        src="<?php 
        if (isset($_SESSION["MesRecette"][$cocktailId]))
            echo "icons/herz_icon.png";
        else
            echo "icons/coeur_rouge_icon.png";
        ?>"
        alt="coeur icon"
        id="coeur_icon"
        title="ajouter cette recette à mes recettes préférées"
        onClick="preferer(window.location.search)"
        style="width: 40px;height: 40px; top: 10px; right: 10px; ">
    <span id="spanning-ingredients">
        <h3 class="recette">Ingrédients</h3>
            <ul id="recette_ingredients">
        <?php 
            foreach($ingredients as $ingredient) {
                echo '
                <li>'.$ingredient.'</li>';
            }   
        ?>
            
            </ul>
    </span>
    <span id="spanning-preparation">
        <h3 class="recette">Préparation</h3>
        <p id="recette_preparation"><?php echo $recette["preparation"];?></p>
    </span>
<?php
        }
        else {
            echo "<p>Il n'y a pas de recette pour cocktail ID ".$_GET["cocktailId"]."</p>";
        }
    } else {
        header("Location: index.php");
    }
?>
