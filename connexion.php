<?php 
session_start();
if($_GET['visite']=="fin")
{ session_destroy();}
?> 
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" >
	<head>
		<title>Le Petit Peuple - Connexion</title>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
		<meta name="keywords" content="">
		<meta name="description" content="">
		<script type="text/javascript" src="noyau/style/csshover.js"></script> 
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
	top:140px; left:0px; 
	margin:0px; padding:0px;
}

</style>

<?php include("Applications/entete/entete.php"); ?>   

		<!-- Page Principal-->
<div id="contenu">
	
	<?php
	if(isset($_SESSION['autorisation']) and((($_SESSION['autorisation'])=='administrateur') or (($_SESSION['autorisation'])=='superadministrateur')) and(($_GET['visite'])!='fin'))
	{ echo'statut:connect&#233;'; }	
	
elseif($_GET['visite']=="debut")
{ ?>
	
	
<div id="interface_connexion" style="background-color:white; border:1px solid black; position:absolute; left:400px; top:50px; font-size:18px;">

<table>	
<form action="profil.php" method="post">
<tr>
<td>Nom:</td>
<td><input type="text" name="nom"  size="20" maxlength="20"/></td>
<td><a href="index.php">annuler</a></td>
</tr>

<tr>
<td><label for="password">password:</label></td>
<td><input type="password" name="password"  size="20" maxlength="20"/></td>
<td><input type="submit" value="valider" />
</td>
</tr>	

</form>
</table>

</div>

<?php } ?>
	
</div>
	</body>
</html>