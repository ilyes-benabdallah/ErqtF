<?php
include('config/db.php');
?>
<!DOCTYPE html>
<html dir="ltr" lang="fr">
<head>
<meta charset="UTF-8" />
<title>Eurequat Algerie</title>
<!--link href="image/favicon.png" rel="icon" /-->
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<meta name="description" content="eurequat algerie">
<meta name="author" content="ilyes benbdallah">

<meta name="description" content="www.eurequat-algerie.com: eurequat algerie">
 <meta name="keywords" content="eurequat,Eurequat,EUREQUAT,Eurequat Algerie, eurequat Algerie,Eurequat algerie,EUREQUAT ALGERIE,Motorola,motorola, MOTOROLA, zebra, Zebra, ZEBRA, hid, Hid, HID, Pda, PDA, pda, Mobile , MOBILE, mobile, Imprimante, IMPRIMANTE, imprimate">
<!-- CSS Part Start-->
<link rel="stylesheet" type="text/css" href="css/stylesheet.css" />
<link rel="stylesheet" type="text/css" href="css/slideshow.css" media="screen" />
<link rel="stylesheet" type="text/css" href="css/flexslider.css" media="screen" />
<link rel="stylesheet" type="text/css" href="js/colorbox/colorbox.css" media="screen" />
<link rel="stylesheet" type="text/css" href="css/carousel.css" media="screen" />

<link href="css/stylePhoto.css" rel="stylesheet" type="text/css" />
<!-- CSS Part End-->
<!-- JS Part Start-->



<script type="text/javascript" src="js/jquery-1.7.1.min.js"></script>
<script type="text/javascript" src="js/jquery.nivo.slider.pack.js"></script>
<script type="text/javascript" src="js/jquery.flexslider.js"></script>
<script type="text/javascript" src="js/jquery.easing-1.3.min.js"></script>
<script type="text/javascript" src="js/jquery.jcarousel.min.js"></script>
<script type="text/javascript" src="js/colorbox/jquery.colorbox-min.js"></script>
<script type="text/javascript" src="js/tabs.js"></script>
<script type="text/javascript" src="js/cloud_zoom.js"></script>
<script type="text/javascript" src="js/jquery.dcjqaccordion.js"></script>
<script type="text/javascript" src="js/custom.js"></script>
<script type="text/javascript" src="js/html5.js"></script>


<!-- JS Part End-->

</head>

<body>


	<header id="header">
		
	<div class="main-wrapper">
		<section class="hsecond">
			<div id="logo"><a href="index.php"><img src="image/logo.png" title="Erequat Algerie" alt="Erequat Algerie" /></a></div>
			<div class="rightHeader">
				<div id="search">
				<script>
				function recherche()
				{
				var rech = document.getElementById('recherche')
				window.location.replace("recherche.php?recherche="+rech.value)

				
				}
				</script>
				<form action="recherche.php" method="GET">
				  <div class="button-search" name="rechercheBoutton" onclick="recherche();"></div>
				  
				  <input type="text" name="recherche" id="recherche" placeholder="Recherche" value="" />
				</form>
				</div>
				<!--Mini Shopping Cart Start-->
				<section id="cart">
				<h4><b>Contactez nous au +213 21 336 363 / +213 21 336 464</b></h4>
				</section>
			</div>
			<!--Mini Shopping Cart End-->
			<div class="clear"></div>
		</section>
		<div class="divHeader">
		
			<div class="bannerTop" id="leftTop" >
				<b>Le spécialiste de l'identification et de la traçabilité  </b>
			
			
			</div>
			<div class=""> 
				<a href="https://www.facebook.com/Eurequat" target="_blank"><img src="image/facebook.png" alt="Facebook" title="Facebook" class="iconeEntete"></a>  
				<a href="https://plus.google.com/u/0/111465932580254675815" target="_blank"> <img src="image/googleplus.png" alt="Google+" title="Google+" class="iconeEntete"> </a> 
				<a href="http://www.youtube.com/channel/UCtz9ys57tp5ORUdIY9jYlYg" target="_blank"> <img src="image/youtube.png" alt="youtube" title="youtube" class="iconeEntete"> </a> 
				<a href="https://www.linkedin.com/company/eurequat-alg-rie" target="_blank"> <img src="image/linkedin.png" alt="Google+" title="linkedin" class="iconeEntete"> </a> 
				<!--a href="" target="_blank"> <img src="image/blog.png" alt="blog" title="blog"> </a--> 
			
			</div>
		
	
		</div>
	</div >
      <!--Top Menu(Horizontal Categories) Start-->
	  <div class="menuColor">
	  <div class="main-wrapper">
      <nav id="menu">
        <ul>
          <li class="home"><a title="Home" href="index.php"><span>Home</span></a></li>
		   <li><a target="" href="aProposDeNous.php">A propos de nous</a></li>
		  <li><a target="" href="#">Produits</a>
		  
		  <div>
		  	<ul>
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
		  </li>
			
          <li><a  href="afficherSolution.php">Solutions</a>
		   <div>
		  		 <ul>
				<?php
					$requeteSolutionMenu= mysql_query("SELECT * FROM solution ") or die(mysql_error());
						while($resultatSolutionMenu=mysql_fetch_array($requeteSolutionMenu))
						{
							$IDSolution= $resultatSolutionMenu['id_solution'];
							$nomSolution= $resultatSolutionMenu['titre_solution'];
							
							
						
				?>
					<li><a href="solution.php?solution=<?php echo $IDSolution; ?>"> <?php echo $nomSolution; ?></a></li>
					
				<?php
						}
				?>
				</ul>
			 </div>
          </li>
		  <li><a href="afficherActualite.php">Actualité</a></li>
         
        
          
		
		  
          <li><a href="nousContacter.php">Nous contacter</a></li>
        </ul>
      </nav>
	        <!-- Mobile Menu Start-->
      <nav id="menu" class="m-menu"> <span>Menu</span>
        <ul>
		 
          <li class="categories"><a>Menu</a>
            <div>
			
              <div class="column"> <a href="index.php">Home</a>
               
              </div>
			  <div class="column"> <a href="aProposDeNous.php">A propos de nous</a>
               
              </div>
              <div class="column"> <a>Produits</a>
                <div>
                  <ul>
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
              </div>
              <div class="column"> <a href="afficherSolution.php">Solutions</a>
          	   <div>
		  		 <ul>
				<?php
					$requeteSolutionMenu= mysql_query("SELECT * FROM solution ") or die(mysql_error());
						while($resultatSolutionMenu=mysql_fetch_array($requeteSolutionMenu))
						{
							$IDSolution= $resultatSolutionMenu['id_solution'];
							$nomSolution= $resultatSolutionMenu['titre_solution'];
							
							
						
				?>
					<li><a href="solution.php?solution=<?php echo $IDSolution; ?>"> <?php echo $nomSolution; ?></a></li>
					
				<?php
						}
				?>
				</ul>
			 </div> 
              </div>
               <div class="column"> <a href="afficherActualite.php">Actualité</a>
            
              </div>
			  
             
			  
             
              <div class="column"> <a href="nousContacter.php">Nous contacter</a>
                
              </div>
             
            </div>
          </li>
        </ul>
      </nav>
      <!-- Mobile Menu End-->
	  </div >
	  </div >
  

    </header>
	<div class="wrapper-box">
	<div class="main-wrapper">

    <!--Header Part End-->
	<div id="container">
      <div id="content">
	 