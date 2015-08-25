 <!-- catéogies -->
		
		
		 <section class="box">
          <div class="box-heading">Catégories des produits</div>
          <div class="box-content">
            <div class="box-product">
              <div class="flexslider featured_carousel">
                <ul class="slides">
				<?php
					$requeteCategorie= mysql_query("SELECT * FROM categories WHERE parent_categorie='0' ") or die(mysql_error());
						while($resultatCategorie=mysql_fetch_array($requeteCategorie))
						{
							$IDCategorie= $resultatCategorie['id_categorie'];
							$nomCategorie= $resultatCategorie['nom_categorie'];
							$imagCategorie= $resultatCategorie['image_categorie'];
							
						
				?>
					<li>
						<div class="slide-inner">
						  <div class="image"><a href="afficherProduits.php?categorie=<?php echo $IDCategorie; ?>"><img src="image/categorie/<?php echo $imagCategorie; ?>" alt="<?php echo $nomCategorie; ?>" /></a></div>
						  <div class="name"><a href="afficherProduits.php?categorie=<?php echo $IDCategorie; ?>"><?php echo $nomCategorie; ?></a></div>

						</div>
					</li>
				<?php
						}
				?>
				
				  
				
				  
				  
               
                
               
                
                </ul>
              </div>
            </div>
          </div>
        </section>
		     <script type="text/javascript">
(function() {
  // store the slider in a local variable
  var $window = $(window),
      flexslider;
 
  // tiny helper function to add breakpoints
  function getGridSize() {
    return (window.innerWidth < 320) ? 1 :
		   (window.innerWidth < 600) ? 2 :
		   (window.innerWidth < 800) ? 3 :
           (window.innerWidth < 900) ? 4 : 5;
  }
  $window.load(function() {
    $('#content .featured_carousel').flexslider({
      animation: "slide",
      animationLoop: false,
	  slideshow: false,
      itemWidth: 210,
      minItems: getGridSize(), // use function to pull in initial value
      maxItems: getGridSize() // use function to pull in initial value
    });
  });
}());
</script>

<!-- fin categorie-->