<div id=recherche>
    <h3>Recherche de cocktails par une liste</h3>
    <?php 
    include_once("getIngredients.php");
    //génération du fils d'ariane
    $fil = ['Aliment'];
    if (isset($_GET["ariane"])) {
        $fil = explode("*", $_GET["ariane"]);
    }
    $tempFil = [];
    foreach($fil as $element) {
        array_push($tempFil, $element);
        $tempFilString = implode("*", $tempFil);
        echo '<a href="?page=recherche-liste&ariane='.$tempFilString.'">'.$element."</a> ";
    }
    $prochainesSousCategories = sousCategories(end($fil));
    if (!empty($prochainesSousCategories)) {
        echo "<ul>";
        foreach ($prochainesSousCategories as $sousCategorie){
            $filString = implode("*", $fil)."*".$sousCategorie;
            echo '<li><a href="?page=recherche-liste&ariane='.$filString.'">'.$sousCategorie.'</a></li>';   
        }
        echo "</ul>";
    } else {
        echo "<p>".end($fil)." n'a pas de sous-catégories</p>";
    }
    ?>
</div>
<div id="elementsTrouves" style="list-style: none; columns: 2;-webkit-columns: 2;-moz-columns: 2;">
    <?php
    include_once("getIngredients.php");
    $recettesCorrespondants = recettesCorrespondants(end($fil));
    //affichage des recettes de cocktails sous fore de lien cliquable
    echo '<ul>';
    foreach($recettesCorrespondants as $index) {
        echo '<li><a href="?page=cocktail-detail&cocktailId='.$index.'"">'.$Recettes[$index]["titre"].'</a></li>';
    }
    echo '</ul>';

    ?>
</div>


