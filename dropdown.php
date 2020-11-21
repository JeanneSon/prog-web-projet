<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Dynamically Generate Select Dropdowns</title>
</head>
<body>
    <?php $categories = file_get_contents('Donnees.inc.php', 1468); // 1468er Charakter
    echo $categories;
    ?>
<form>
  <select>
        <option selected="selected">Choose one</option>
        <?php
        
        // Iterating through the product array
        foreach($categories.$Hierarchie as $item){
            echo "<option value='strtolower($item)'>$item</option>";
        }
        ?>
    </select>
    <input type="submit" value="Submit">
</form>
</body>
</html>
