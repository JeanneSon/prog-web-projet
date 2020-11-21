<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Dynamically Generate Select Dropdowns</title>
</head>
<body>
<form>
    <select>
        <option selected="selected">Choose one</option>
        <?php
        // A sample product array
        $products = array("Mobile", "Laptop", "Tablet", "Camera");
        
        // Iterating through the product array
        foreach($products as $item){
            echo "<option value='strtolower($item)'>$item</option>";
        }
        ?>
    </select>
    <input type="submit" value="Submit">
</form>
</body>
</html>
