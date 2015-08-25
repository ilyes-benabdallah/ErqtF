
		 <!-- Nivo Slider Start -->
			<section class="flexslider flex_slider">
				<ul class="slides">
				<?php
				$requeteSlide= mysql_query('SELECT * FROM slide ORDER BY date_slide DESC') or die(mysql_error());
					while($resultatSlide=mysql_fetch_array($requeteSlide))
					{
						$IDSlide= $resultatSlide['id_slide'];
						$imageSlide= $resultatSlide['image_slide'];
						$lienSlide= $resultatSlide['lien_slide'];
					
				?>
					<li><a href="<?php echo $lienSlide;?>"><img src="image/slider/<?php echo $imageSlide;?> " alt="" /></a></li>
				<?php
					}
				?>
				</ul>
				 
				</section>
				<br>
				<script type="text/javascript">
		   $(document).ready()
		$(window).load(function() {
		  $('.flex_slider').flexslider({
			animation: "fade"
		  });
		});
		</script>
				<!-- Nivo Slider End-->
				
