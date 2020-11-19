<!DOCTYPE html>
<html>
<head>
	<title>Projekt Header, footer, nav</title>
	<meta charset="utf-8">
	<link rel="stylesheet" href="styleNav.css">
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

</script>
<div id="mySidenav" class="sidenav">
	  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
	  <a href="panier.php">Cocktails préférés</a>
	  <a href="contact.html">Contact</a>
	  <form>
			<select id="cars" name="cars">
			  <option value="fruit">Fruit</option>
			  <option value="jus">Jus</option>
			  
			</select>
		</form>
	</div>
	<div id="main">
	<header>
		<h1>Cocktails</h1>
		<a href="panier.html">
			<img  src="icons/herz_icon.png" alt="coeur icon" style="width: 40px;height: 40px; position: absolute; top: 10px; right: 10px; ">
		</a>
		<a href="page_identification.php">
			<img  src="icons/compte_icon.png" alt="compte icon" style="width: 40px;height: 40px; position: absolute; top: 10px; right: 60px; ">
		</a>
	</header>

	

	<!-- Use any element to open the sidenav -->
	<div>
	<span onclick="openNav()"><img src="icons/menu.jpg" alt="icon"></span>
	</div>
		
	<main>	
		hallo
	</main>

	<footer>
		<p  style="margin:0;display:inline;float:left"><u>Impressum</u><br />
			Projet L3 ISFATES <br />
			Programmation web <br />
			Emmanuel Nauer
		</p>
		<p  style="margin:0;margin-left: 20px;display:inline;float:left"><u>Contact</u><br/>
			michelle.mielke7@etu.univ-lorraine.fr <br />
			hanna.schall8@etu.univ-lorraine.fr<br />
			aurianne.venet9@etu.univ-lorraine.fr
		</p>
	</footer>
		</div>
</body>
</html>
