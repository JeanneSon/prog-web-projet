<?php
$ClassLogin='ok';
$ClassMdp='ok';
$ClassNom='ok';
$ClassPrenom='ok';
$ClassSexe='ok';
$ClassNaissance='ok';
$ClassTelephone ='ok';
$ClassEmail='ok';
$ClassRue='ok';
$ClassCodePostal='ok';
$ClassVille='ok';


if(isset($_POST['submit']))
  { 	
    $ChampsIncorrects='';

    if(  (!isset($_POST['login']))||(strlen(trim($_POST['login']))<2))
	  { $ChampsIncorrects = $ChampsIncorrects.'Login, ' ;
	    $ClassNom='error';
	  }

	if(  (!isset($_POST['mdp']))||(strlen(trim($_POST['mdp']))<2))
	  { $ChampsIncorrects = $ChampsIncorrects.'Mot de passe, ' ;
	    $ClassNom='error';
	  }

	if(  (!isset($_POST['nom']))||(strlen(trim($_POST['nom']))<2))
	  { $ChampsIncorrects = $ChampsIncorrects.'Nom, ' ;
	    $ClassNom='error';
	  }

    if(!isset($_POST['prenom'])||(strlen(trim($_POST['nom']))<2))
	  { $ChampsIncorrects = $ChampsIncorrects.'Prénom, ';
		$ClassPrenom='error';
	  }
	else
	  { $Prenom=strtolower(trim($_POST['prenom']));
		if(!ctype_alpha($Prenom))
		  { $ChampsIncorrects=$ChampsIncorrects.'Prénom, ';
			$ClassPrenom='error';
		  }								
	  }

	if(  (!isset($_POST['sexe']))||((trim($_POST['sexe'])!='f')&&(trim($_POST['sexe'])!='h')))
      { $ChampsIncorrects=$ChampsIncorrects.'Sexe, ';
	    $ClassSexe='error';
	  }

	if(  (!isset($_POST['naissance']))||(trim($_POST['naissance'])==''))
	  { $ChampsIncorrects=$ChampsIncorrects.'Date de naissance, ';
	    $ClassNaissance='error';
	  }
	else
	  { list($Annee,$Mois,$Jour)=explode('-',$_POST['naissance']);
		if(!checkdate($Mois,$Jour,$Annee)) 
		  { $ChampsIncorrects=$ChampsIncorrects.'Date de naissance, ';
			$ClassNaissance='error';
		  }
	  }

	if(  (!isset($_POST['email']) || (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))))
	  { $ChampsIncorrects=$ChampsIncorrects.'Adresse électronique, ';
	    $ClassEmail='error';
	  }

	if((!isset($_POST['telephone']))||
	(!preg_match("#([0-9]{2}){5}#",$_POST['telephone'])))
		{ $ChampsIncorrects = $ChampsIncorrects.'Numéro de telephone, ' ;
	    $ClassTelephone='error';
	  }

	if(  (!isset($_POST['rue']))||(strlen(trim($_POST['rue']))<2))
	  { $ChampsIncorrects=$ChampsIncorrects.'Rue, ';
	    $ClassRue='error';
	  }

	  if(  (!isset($_POST['codePostal']))||(strlen(trim($_POST['codePostal']))<5))
	  { $ChampsIncorrects=$ChampsIncorrects.'CodePostal, ';
	    $ClassCodePostal='error';
	  }	

	  if(  (!isset($_POST['ville']))||(strlen(trim($_POST['ville']))<2))
	  { $ChampsIncorrects=$ChampsIncorrects.'Ville';
	    $ClassVille='error';
	  }
  }
?>