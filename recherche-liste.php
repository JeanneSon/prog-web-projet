<div id=recherche>
    <h3>Recherche de cocktails par une liste</h3>
    <?php 
    include_once("getIngredients.php");
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
<div id="elementsTrouves">
    <?php
    include_once("getIngredients.php");
    $recettesCorrespondants = recettesCorrespondants(end($fil));
    //echo sizeof($recettesCorrespondants);
    echo '<ul>';
    foreach($recettesCorrespondants as $index) {
        echo '<li><a href="?page=cocktail-detail&cocktailId='.$index.'"">'.$Recettes[$index]["titre"].'</a></li>';
    }
    echo '</ul>';

    ?>
</div>


