<?php
  if(isset($_GET['liste'])) {
  		$ingredient=$_GET['liste'];
   		echo affichageliste($ingredient);
   	}
  ?>