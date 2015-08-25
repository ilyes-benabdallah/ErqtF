<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">

<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
   

    <title>Administration du site Eurequat Algerie</title>

    <link href="css/bootstrap.min.css" rel="stylesheet">
  


    <link href="css/dashboard.css" rel="stylesheet">

	
	 <script src="ckeditorF/ckeditor.js"></script>
	
  <script src="js/jquery.min.js"></script>
 <!--script src="../js/bootstrap.min.js"></script-->
    <!--[if lt IE 9]><script src="http://getbootstrap.com/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="js/ie-emulation-modes-warning.js"></script>
    <script src="js/bootstrap.js"></script>
   
 
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  <style id="holderjs-style" type="text/css"></style>
  <link rel="stylesheet" href="css/accordionmenu.css" type="text/css" media="screen" />


  <link href="css/supplement.css" rel="stylesheet">
  <link href="css/erreurs.css" rel="stylesheet">
  </head>

  <body>
	<div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#"><?php echo 'M. '.$_SESSION["NOM_ADMIN_VAL"].' '.$_SESSION["PRENOM_ADMIN_VAL"]; ?></a>
        </div>
        <div class="navbar-collapse collapse" style="height: 1px;">
          <ul class="nav navbar-nav navbar-right">
            <li><a href="#">Panneau</a></li>
            <li><a href="#">paramètres</a></li>
            <li><a href="ModifierProfil.php?administrateur=<?php echo $_SESSION["ID_ADMIN_VAL"]; ?>">Profile</a></li>
            <li><a href="#">Aides</a></li>
          </ul>
          <form class="navbar-form navbar-right">
            <input type="text" class="form-control" placeholder="Chercher...">
          </form>
        </div>
      </div>
    </div>

    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-3 col-md-2 sidebar" style="padding: 0 !important;">
    
	
<?php  include('MenuAdmin.php'); ?>
	
	
	
	
        </div>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
		