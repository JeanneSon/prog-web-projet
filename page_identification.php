<?php
	include 'verification_identification.php';
	include 'creation_compte.php';
	if(isset($_POST['submit'])){
		if ($ChampsIncorrects !='') {
			echo ' <br /> Merci de remplir correctement les champs ci-dessous :
				<ul> 
					'.$ChampsIncorrects.'
				</ul>';
			}
		}
?>
	