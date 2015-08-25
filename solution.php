<?php 
//include('config/db.php');
include('entete.php');
?>
<br>
<?php 
include('menuVertical.php');
?>

<div id="content">
<?php 
$maSolution=$_GET['solution'];
$maSolution=mysql_real_escape_string($maSolution);

$requeteSolution=mysql_query("SELECT * FROM solution WHERE id_solution='$maSolution'") or die(mysql_error());
$existeSolution=mysql_num_rows($requeteSolution);
if($existeSolution==0)  echo ("<p class='bg-danger'>Solution introuvable!.</p>");
else
{
		$solution=mysql_fetch_assoc($requeteSolution);
				$IDSolution = $solution['id_solution'];
				$photoSolution = $solution['image_solution'];
				$intituleSolution = $solution['titre_solution'];
				$contenuProduit = $solution['contenu_solution'];
		
		
?>
        
        <h1><?php echo $intituleSolution ;?></h1>
        <div class="product-info">
          <div class="left">
            <div class="image"><a href="image/solution/<?php echo $photoSolution ;?>" title="Canon EOS 5D" class="cloud-zoom colorbox" id='zoom1' rel="adjustX: 0, adjustY:0, tint:'#000000',tintOpacity:0.2, zoomWidth:360, position:'inside', showTitle:false"><img src="image/solution/<?php echo $photoSolution ;?>" width="350px;" height="320px;" title="<?php echo $intituleSolution ;?>" alt="<?php echo $intituleSolution ;?>" id="image" /><span id="zoom-image">
			<i class="zoom_bttn"></i> Zoom</span></a></div>
            <!--   llllllllllllllllllll   -->
			 <div class="description"> 
			
              <span>Solution:</span><?php echo $intituleSolution ;?><br />
              
              
            
         
       
            
            <!-- AddThis Button BEGIN -->
            <div class="addthis_toolbox addthis_default_style "> <a class="addthis_button_facebook_like" fb:like:layout="button_count"></a><a class="addthis_button_google_plusone" g:plusone:size="medium"></a> <a class="addthis_counter addthis_pill_style"></a> </div>
            <script type="text/javascript" src="http://s7.addthis.com/js/300/addthis_widget.js#pubid=xa-506f325f57fbfc95"></script>
            <!-- AddThis Button END -->
          </div>
          </div>
          <div class="right">
           	
		
        <!-- Description and Reviews Tab Start -->
       
        
         <?php echo $contenuProduit ;?>
        
        
        
		  
        <!-- Description and Reviews Tab Start -->
          </div>
        </div>
        

<?php 
}

?>	
	


</div>

<?php 
include('footer.php');

?>
