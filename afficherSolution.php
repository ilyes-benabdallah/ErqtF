<?php 
//include('config/db.php');
include('entete.php');
?>
<br>
<?php 
include('menuVertical.php');
?>
<div id="content">


				
				<h1>Solution</h1>
				<?php
				$requeteVerificationSolution=mysql_query("SELECT * FROM solution ") or die(mysql_error());
				$nbrSolution=mysql_num_rows($requeteVerificationSolution);
					if ($nbrSolution==0)
					{
					echo('<div class="warning">Solution introvable !<a href="index.php"> <img class="close" alt="" src="image/close.png"></a></div>');
					}
					else
					{
						
		
							
							?>
							
								<div class="product-grid">
								
									<?php
									while ($getSolution=mysql_fetch_array($requeteVerificationSolution))
									{
										$IDSolution=$getSolution['id_solution'];
										$intituleSolution=$getSolution['titre_solution'];
										$imageSolution=$getSolution['image_solution'];
									?>
										
										<div>
											<div class="image"><a href="solution.php?solution=<?php echo $IDSolution ;?>"><img src="image/solution/<?php echo $imageSolution ;?>" width="162px;" height="162px;" title="<?php echo $intituleSolution ;?> alt="<?php echo $intituleSolution ;?>/></a></div>
											<div class="name"><a href="solution.php?solution=<?php echo $IDSolution ;?>"><b><?php echo $intituleSolution ;?></b></a></div>
											
										   
										</div>
									
									<?php
									}
									?>
								</div><!-- fin produit grid  -->
								<?php
								
							
						
						
					}
					
				
			
			
			
		
	
	
	
	
?>
</div>


               <!--Tabs Start-->

  
      
        <!--Tabs End-->
        
        <!--Pagination Part Start>
        <div class="pagination">
          <div class="links"> <b>1</b> <a href="#">2</a> <a href="#">&gt;</a> <a href="#">&gt;|</a></div>
          <div class="results">Showing 1 to 15 of 16 (2 Pages)</div>
        </div>
        <Pagination Part End-->
 <!-- fin content -->

<?php 
include('footer.php');

?>
