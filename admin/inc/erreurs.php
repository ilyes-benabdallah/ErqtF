<?php 


	class myClassErreur {

		function initialiserErreur ($myErreur , $etatErreur) 
		{
		if ($etatErreur == 1) 
			 {
				echo '<p class="bg-success">'.$myErreur.'</p>';
			 } 
			 else
			 {
				echo '<p class="bg-danger">'.$myErreur.'</p>';
			 }
		}


	}
 ?>