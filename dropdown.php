<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Dynamically Generate Select Dropdowns</title>
    </head>
    <body>
        <?php include 'Donnees.inc.php';?>
        <form>
          <select>
                <option selected="selected">Choose one</option>
                <?php
                foreach($Hierarchie as $h => $g){
                    foreach($g as $item => $value){
                        foreach($value as $i => $v){
                            echo "<option value='strtolower($v)'>$v</option>";}
                    }
                }
                ?>
            </select>
            <input type="submit" value="Submit">
        </form>
        <form>
            <select>
                <option selected="selected">Choose one</option>
                
            </select>
        </form>
        <form>
            <select>
                <option selected="selected">Choose one</option>
            </select>
        </form>
    </body>
</html>
