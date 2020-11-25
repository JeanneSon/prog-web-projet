<!DOCTYPE html>
<html>
<head>
	<title>Ingredients</title>
	<meta charset="utf-8">
	<link rel="stylesheet" href="style.css" type="text/css" media="screen" />
</head>

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

<body>
    <ul>
<?php 
    foreach ($simple as $element) {
        echo "<li>$element</li>";
    }
?>
    </ul>
</body>
</html>

