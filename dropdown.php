<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Dynamically Generate Select Dropdowns</title>
    </head>
    <body>
        <?php include 'Donnees.inc.php';?>
        sous-catégorie und super-catégorie
        <form>
          <select>
                <option selected="selected">Choose one</option>
                <?php
                foreach($Hierarchie as $h => $g){
                    foreach($g as $item => $value){
                        foreach($value as $i => $v){
                            echo "<option>$v</option>";}
                    }
                }
                ?>
            </select>
            <input type="submit" value="Submit">
        </form>
        super-categorie
        <form>
            <select>
                <option selected="selected">Choose one</option>
                <?php
                    foreach($Hierarchie as $name) { 
                      echo "<option >$name</option>";
                  
                    } ?>
                
                
            </select>
        </form>
        <form>
            <select>
                <option selected="selected">Choose one</option>
            </select>
        </form>
    </body>
</html>
