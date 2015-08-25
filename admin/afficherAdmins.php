<?php ob_start(); ?>
<?php
include('load.php');
include('inc/administrateurs.php');




?>	  
		
<div class="text-left" href="#actualite">
	<h3>Administrateurs<small> Mes Administrateurs</small></h3>
	<br>
	<table class="table table-hover">
		<thead>
			<tr>
				<th class="">Nom</th>
				<th class="">email</th>
				<th class="" style="width: 140px;">Action</th>
			</tr>
		</thead>
		<tbody>
		<?php 
        $requetteAdmin = mysql_query("SELECT * FROM admin");
		while($getAdmin= mysql_fetch_array($requetteAdmin))
		{
			$idAdmin=$getAdmin['id_admin'];
			
			$pseudoAdmin=$getAdmin['pseudo_admin'];
			$nomAdmin=$getAdmin['nom_admin'];
			$prenomAdmin=$getAdmin['prenom_admin'];
			$emailAdmin=$getAdmin['email_admin'];
			 
			
				if (isset ($_POST['supprimerAdmin'.$idAdmin]))
				{
						$objectAdmin = new myClassAdmin();
						$objectAdmin->supprimerAdmin($idAdmin);
				}
			?>
				<form action="afficherAdmins.php#admin" method="POST" >
					<tr class="active">
							<td class=""><?php echo $nomAdmin." ".$prenomAdmin." (".$pseudoAdmin.")"; ?></td>
							<td class=""><?php echo $emailAdmin; ?></td>

							<td class="">
							
							<?php if(($_SESSION["ID_ADMIN_VAL"] != $idAdmin ) ){ ?>
							<img  src="images/del.png" onclick="$('#sup<?php echo $idAdmin; ?>').toggle('slow');" style="cursor: pointer;" />
							<?php  } ?>					
												
							</td>
					</tr><?php if(($_SESSION["ID_ADMIN_VAL"] != $idAdmin ) ){ ?>
					<tr class="danger" id="sup<?php echo $idAdmin; ?>" style="display: none;">
									<td colspan="2"> êtes vous sur de vouloir supprimer cet administrateur ?</td>
									<td><button type="submit" class="btn btn-danger"  name="supprimerAdmin<?php echo $idAdmin; ?>" >Oui, je supprime !</button></td>
					</tr><?php } ?>	
				</form>
		<?php 
			
		}
		
		?>  
		
		
		
		
		</tbody>
	</table>
</div>
<?php include('footer.php'); ?>
<?php ob_flush(); ?>