<?php
session_start();
$_SESSION["MesRecettes"] = "";
include("Donnees.inc.php");
$utilisateurs = json_decode(file_get_contents("DonneesUtilisateurs.json"), true);
?>

<!DOCTYPE html>
<html>

<head>
	<title>Projekt Header, footer, nav</title>
	<meta charset="utf-8">
	<link rel="stylesheet" href="styleNav.css">
	<link href="https://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css" rel="stylesheet">
	<script src="https://code.jquery.com/jquery-1.10.2.js"></script>
	<script src="https://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
	<script type="text/javascript" src="javascript.js"></script>

	<!-- Javascript -->
	<script>
		$(function() {
			var availableTutorials = [
				'Malibu',
				'Cerise',
				'Jus de goyave',
				'Cerise griotte',
				'Aperol',
				'Prosecco',
				'Glaçon',
				'Orange sanguine',
				'Eau gazeuse',
				'Curaçao',
				'Rhum blanc',
				'Tequila',
				'Martini',
				'Sirop de sucre de canne',
				'Stout (bière)',
				'Champagne',
				'Vodka',
				'Jus de tomates',
				'Jus de citron',
				'Sauce worcestershire',
				'Sauce tabasco',
				'Sel de céleri',
				'Poivre',
			];
			$("#automplete-1").autocomplete({
				source: availableTutorials,
				minLength: 1,
				delay: 500,
				autoFocus: true
			});
			$("#automplete-2").autocomplete({
				source: availableTutorials,
				minLength: 1,
				delay: 500,
				autoFocus: true
			});
		});
	</script>
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
		<a href="?page=page_identification">Créer un compte</a>
		<a href="?page=contact">Contact</a>
	</div>
	<div id="main">
		<header>
			<h1>Cocktails</h1>
			<a href="?page=panier">
				<img src="icons/sac.svg" alt="coeur icon" style="width: 40px;height: 40px; position: absolute; top: 10px; right: 10px; ">
			</a>
			<a href="?page=page_identification">
				<img src="icons/compte_icon.png" alt="compte icon" style="width: 40px;height: 40px; position: absolute; top: 10px; right: 60px; ">
			</a>
		</header>


		<!-- Use any element to open the sidenav -->
		<div>
			<span onclick="openNav()"><img src="icons/menu.jpg" alt="icon"></span>
		</div>
		
		<main>
			<div class = "ui-widget">
				<label for = "automplete-1">Ingredients souhaitées: </label>
				<input id = "automplete-1">
				<label for = "automplete-2">Ingredients non-souhaitées: </label>
				<input id = "automplete-2">
			</div>
			<?php 
				include 'dropdown.php'; 
				//if (!isset($_GET['page'])) $_GET['page'] = 'index';
				// L'utilisateur accède-t-il à une page autorisée
				if (isset($_GET['page'])) {
					if (in_array($_GET['page'], ['index', 'contact', 'panier', 'page_identification'])) {
						include($_GET['page'] . ".php");
					}
				}
			?>
		</main>

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
</body>

</html>