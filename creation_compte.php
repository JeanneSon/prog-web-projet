    <h1>Vos données</h1>

	<form method="post" action="#" >
	<fieldset>
    	<legend>Création de compte</legend>

    Login :
    	<input type="text" name="login" <?php if($ClassLogin=='error'){echo "style ='background-color: red'";}?> required="required" 
		value="<?php if(isset($_POST['login']))  echo $_POST['login']; ?>"/>
		<br />

	Mot de passe :
    	<input type="text" name="mdp" <?php if($ClassMdp=='error'){echo "style ='background-color: red'";}?> required="required" 
		value="<?php if(isset($_POST['mdp']))  echo $_POST['mdp']; ?>"/>
		<br />

    Nom :
    	<input type="text" name="nom" <?php if($ClassNom=='error'){echo "style ='background-color: red'";}?>
		value="<?php if(isset($_POST['nom']))  echo $_POST['nom']; ?>"/>
		<br />  

    Prénom : 
    	<input type="text" name="prenom" <?php if($ClassPrenom=='error'){echo "style ='background-color: red'";}?>
	    value="<?php if(isset($_POST['prenom']))  echo $_POST['prenom']; ?>"/>
	    <br />

	Vous êtes :  
  	<span <?php if($ClassSexe=='error'){echo "style ='background-color: red'";}?>/>
	<input type="radio" name="sexe" value="f" 
	<?php if((isset($_POST['sexe']))&&($_POST['sexe'])=='f') echo 'checked="checked"'; ?>
	/> une femme 	
	<input type="radio" name="sexe" value="h"
	<?php if((isset($_POST['sexe']))&&($_POST['sexe'])=='h') echo 'checked="checked"'; ?>
	/> un homme
  	</span>
  	<br />

  	Date de naissance
  		<input type="date" name="naissance" <?php if($ClassNaissance=='error'){echo "style ='background-color: red'";}?>
  		value="<?php if(isset($_POST['naissance']))  echo $_POST['naissance']; ?>"/>
  		<br />

  	Adresse électronique : 
		<input type="text"  name="email" <?php if($ClassEmail=='error'){echo "style ='background-color: red'";}?>
	    value="<?php if(isset($_POST['email']))  echo $_POST['email']; ?>"/>
		<br />

	Numéro de téléphone:
		<input type="tel" name="telephone" <?php if($ClassTelephone=='error'){echo "style ='background-color: red'";}?>
		value="<?php if(isset($_POST['telephone']))  echo $_POST['telephone']; ?>"/>
		<br />

	Adresse: <br />
		<ul>
			<li>Rue:
		<input type="text" name="rue" <?php if($ClassRue=='error'){echo "style ='background-color: red'";}?>
		value="<?php if(isset($_POST['rue']))  echo $_POST['rue']; ?>"/>
			</li>
		<br />
			<li> Code postal:
		<input type="number" name="codePostal" <?php if($ClassCodePostal=='error'){echo "style ='background-color: red'";}?>
		value="<?php if(isset($_POST['codePostal']))  echo $_POST['codePostal'];?>"/>
			</li>
		<br />
			<li> Ville:
		<input type="text" name="ville" <?php if($ClassVille=='error'){echo "style ='background-color: red'";}?>
		value="<?php if(isset($_POST['ville']))  echo $_POST['ville']; ?>"/>
			</li>
		<br />
		</ul>
	</fieldset>
	<br />
		<input type="submit" name="submit" value="Valider" />
         
	</form>	