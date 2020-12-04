<?php
//TODO: do not always request user data
session_start();
if (!isset($_SESSION["MesRecettes"])) {
	$_SESSION["MesRecettes"] = [
		"3" => 3, 
		"10" => 10,
		"7" => 7
	];
}
include("Donnees.inc.php");
$utilisateurs = json_decode(file_get_contents("DonneesUtilisateurs.json"), true);
?>

<!DOCTYPE html>
<html>

<head>
	<title>Projekt Header, footer, nav</title>
	<meta charset="utf-8">
	<link rel="stylesheet" href="styleNav.css">
	<link rel="stylesheet" href="styles.css">
	<link href="https://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css" rel="stylesheet">
	<script src="https://code.jquery.com/jquery-1.10.2.js"></script>
	<script src="https://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
	<script type="text/javascript" src="javascript.js"></script>
</head>


<body>
	<script>
		/* Set the width of the side navigation to 250px and the left margin of the page content to 250px */
		function openNav() {
			document.getElementById("mySidenav").style.width = "250px";
			document.getElementById("main").style.marginLeft = "250px";
		}

		/* Set the width of the side navigation to 0 and the left margin of the page content to 0 */
		function closeNav() {
			document.getElementById("mySidenav").style.width = "0";
			document.getElementById("main").style.marginLeft = "0";
		}

		function affiche(elem) {
			document.getElementById("affichage").src = elem;
		}
	</script>

	<div id="mySidenav" class="sidenav">
		<a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
		<a href="?page=panier">Cocktails préférés</a>
		<a href="?page=compte-detail">Créer un compte</a>
		<a href="?page=recherche-liste">Recherche de cocktails par une liste</a>
		<a href="?page=recherche-saisie">Recherche des cocktails par une zone de saisie</a>
	</div>

	<div id="main">
		<header>

			<h1><a href="index.php">Cocktails</a></h1>
			<p id="rest">Ce site vous aidera à trouver vos cocktails préférés !<br />
			Pour la recherche, vous pouvez utiliser soit une liste hierarchique, soit des zoses de saisie! <br />
			Vous trouverez les deux dans le menu à gauche.<br /><br />
			Amusez-vous bien!</p>
			<!-- Bienvenue à l'utilisateur -->
			<h2 id="bienvenue">Bienvenue
			<?php 
			if (isset($_SESSION["utilisateur"])) {
				echo " ".$_SESSION["utilisateur"]." !";
			} else echo "! Vous n'êtes pas encore connecté.";
			?>
			</h2>

			<!-- Icons en haut à droite -->
			<a href="?page=panier">
				<img src="icons/sac.svg" alt="coeur icon" style="width: 40px;height: 40px; position: absolute; top: 10px; right: 10px; ">
			</a>
			<a href="?page=page_identification">
				<img src="icons/compte_icon.png" alt="compte icon" style="width: 40px;height: 40px; position: absolute; top: 10px; right: 60px; ">
			</a>

		</header>


		<div>
			<span onclick="openNav()"><img src="icons/menu.jpg" id="burger" alt="icon"></span>
		</div>
		
		<main>
			<?php
			if (isset($_GET["page"])) {
				if (in_array($_GET["page"], [
					"recherche-liste", 
					"recherche-saisie", 
					"cocktail-detail", 
					"panier", 
					"page_identification",
					"compte-detail"])) {
					include($_GET['page'].".php");
				}
			}
			?>
		</main>

		<div id="footer">
		<footer>
			<hr />
			<p style="margin:0;display:inline;float:left"><u>Impressum</u><br />
				Projet L3 ISFATES <br />
				Programmation web <br />
				Emmanuel Nauer
			</p>
			<p style="margin:0;margin-left: 20px;display:inline;float:left"><u>Contact</u><br />
				michelle.mielke7@etu.univ-lorraine.fr <br />
				hanna.schall8@etu.univ-lorraine.fr<br />
				aurianne.venet9@etu.univ-lorraine.fr
			</p>
		</footer>
		</div>
	</div>
</body>

</html>