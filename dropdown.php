<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Dynamically Generate Select Dropdowns</title>
</head>
<body>
    <?php include 'Donnees.inc.php';
    ?>
<form>
  <select>
        <option selected="selected">Choose one</option>
        <?php
        foreach($Hierarchie as $h => $g){
            foreach($g as $item => $value){
                foreach($value as $i => $v){
                    echo "<option value='strtolower($v)'>$item</option>";}
            }
        }
        ?>
    </select>
    <input type="submit" value="Submit">
</form>
</body>
</html>
