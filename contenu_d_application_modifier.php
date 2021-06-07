<?php 
session_start(); 
include("noyau/configuration/base_de_donnee.php");
if(isset($_SESSION['autorisation']) and((($_SESSION['autorisation'])=='administrateur') or (($_SESSION['autorisation'])=='superadministrateur')) and(($_GET['visite'])!='fin'))
{ 
?> 
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" >
	<head>
		<title>Nouveau</title>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
		<meta name="keywords" content="">
		<meta name="description" content="">
		<script type="text/javascript" src="noyau/style/csshover.js"></script> 
		
		<script type="text/javascript" src="Applications/ckeditor/ckeditor.js"></script>
		<script type="text/javascript" src="Applications/ckfinder/ckfinder.js"></script>

		<script type="text/javascript" src="Applications/datepicker/js/datepicker.js"></script>
        	<link href="Applications/datepicker/css/datepicker.css" rel="stylesheet" type="text/css" />
		
	</head>
	<body bgcolor="#14285f" link="#9900cc">	
<style type="text/css">
body
{
background-image:url(null);
background-attachment:fixed;  
background-repeat:no-repeat;
background-color:#f0f7f8;
margin:0px;
padding:0px;
}
#contenu
{
	width:100%;
	position:absolute;
	top:35px; left:0px; 
	margin:0px; padding:0px;
}
</style>
<?php include("Applications/entete/entete.php"); ?>
		<!-- Page Principal-->
	<div id="contenu">


<?php
if(isset($_GET['table_modifier']))
{
$table_modifier=$_GET['table_modifier'];
}

$essai='Applications/' . $table_modifier . '/modifier.php';
include($essai);
?>


	</div>
</body>
</html>
<?php } ?>