<div id="column-left">
<div class="box">
	<div class="box-heading">Categories des produits</div>
	<div class="box-content box-category">
		<ul id="cat_accordion">
		<?php
					$requeteCategorieMenu= mysql_query("SELECT * FROM categories WHERE parent_categorie='0' ") or die(mysql_error());
						while($resultatCategorieMenu=mysql_fetch_array($requeteCategorieMenu))
						{
							$IDCategorie= $resultatCategorieMenu['id_categorie'];
							$nomCategorie= $resultatCategorieMenu['nom_categorie'];
							$imagCategorie= $resultatCategorieMenu['image_categorie'];
							
						
				?>
					<li><a href="afficherProduits.php?categorie=<?php echo $IDCategorie; ?>"> <?php echo $nomCategorie; ?></a></li>
					
				<?php
						}
				?>


	
		</ul>
	</div>
	<br>
		<div class="box-heading">Nos solutions</div>
	<div class="box-content box-category">
		<ul id="cat_accordion">
		<?php
					$requeteCategorieMenu1= mysql_query("SELECT * FROM solution ") or die(mysql_error());
						while($resultatCategorieMenu1=mysql_fetch_array($requeteCategorieMenu1))
						{
							$IDSolution= $resultatCategorieMenu1['id_solution'];
							$nomSolution= $resultatCategorieMenu1['titre_solution'];
							$imagSolution= $resultatCategorieMenu1['image_solution'];
							
						
				?>
					<li><a href="solution.php?solution=<?php echo $IDSolution; ?>"> <?php echo $nomSolution; ?></a></li>
					
				<?php
						}
				?>


	
		</ul>
	</div>
</div>
</div>