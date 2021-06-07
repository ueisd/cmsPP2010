<?php 
session_start();
include("noyau/configuration/base_de_donnee.php");
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
background-color:#14285f;
margin:0px;
padding:0px;
}
table
{
	width:100%;
}


#coordonnes
{
	color:#ccffff;
}
#infosite
{
	color:#ccffff;
}
#titrecontacter
{
	font-family: "georgia", serif;
	color:#cc3300;
	font-size:1.2em;
}
#td100
{
	width:100%;
}
h2
{
	color:#cc3300;
}

#contenu
{
	width:100%;
	position:absolute;
	top:140px; left:0px; 
	margin:0px; padding:0px;
}
#interface_connexion
{
	background-color:white;
	border:1px solid black;
	position:absolute;
	left:400px;
	top:50px; 
	font-size:18px;
}

</style>

<?php include("Applications/entete/entete.php"); ?>   

		<!-- Page Principal-->
<div id="contenu">

<?php
if(isset($_POST['Nouvel_utilisateur']) and ($_POST['Nouvel_utilisateur']=='valider'))
{

if(($_POST['password']!='') and ($_POST['email']!='') and ($_POST['password']==$_POST['Verifier_password']) and ($_POST['email']==$_POST['Verifier_email']))
{
echo 'Le formulaire a bien &#233;t&#233; remplis';

$nom = $_POST['nom'];
$mot_de_passe = $_POST['password'];
$email = $_POST['email'];
$demande_de_changement_de_categorie_d_utilisateur = $_POST['demande_de_changement_de_categorie_d_utilisateur'];

mysql_connect("$type_hote_base_de_donnee", "$Utilisateur_base_de_donnee", "$Code_base_de_donnee"); 
mysql_select_db("$Nom_base_de_donnee"); 
mysql_query("INSERT INTO utilisateurs VALUES('', '', '$nom', '$mot_de_passe', '$email', 'En approbation', '$demande_de_changement_de_categorie_d_utilisateur', '')");
mysql_close();

if(isset($_FILES['image']) and $_FILES['image']['error'] == 0)
{
echo 'Photo transfere';
if($_FILES['image']['type']=='image/jpeg')
{
$type_photo='jpg';
}
elseif($_FILES['image']['type']=='image/gif')
{
$type_photo='gif';
}
elseif($_FILES['image']['type']=='image/png')
{
$type_photo='png';
}
elseif($_FILES['image']['type']=='image/bmp')
{
$type_photo='bmp';
}
mysql_connect("$type_hote_base_de_donnee", "$Utilisateur_base_de_donnee", "$Code_base_de_donnee"); 
mysql_select_db("$Nom_base_de_donnee"); 
$reponse = mysql_query("SELECT id FROM utilisateurs WHERE nom='$nom'");
while ($donnees = mysql_fetch_array($reponse) )
{$image_id=$donnees['id'];}
$nom_photo=$image_id . '.' . $type_photo;
mysql_query("UPDATE utilisateurs SET image='$nom_photo' WHERE id='$image_id'");
mysql_close();
$adresse='image/profil/' . $nom_photo;
$resultat = move_uploaded_file($_FILES['image']['tmp_name'], 'image/profil/preminiat.jpg' );


$source = imagecreatefromjpeg("image/profil/preminiat.jpg");

$largeur_source = imagesx($source);
$hauteur_source = imagesy($source);

if($largeur_source >= $hauteur_source)
{
$largeur_nouveaux = '110';
$hauteur_nouveaux = $largeur_nouveaux/$largeur_source*$hauteur_source;
}
else
{
$hauteur_nouveaux = '110';
$largeur_nouveaux = $hauteur_nouveaux/$hauteur_source*$largeur_source;
}

$destination = imagecreatetruecolor($largeur_nouveaux, $hauteur_nouveaux); 
$largeur_destination = imagesx($destination);
$hauteur_destination = imagesy($destination);

imagecopyresampled($destination, $source, 0, 0, 0, 0, $largeur_destination, $hauteur_destination, $largeur_source, $hauteur_source);

imagejpeg($destination, $adresse);

}

}
else
{
echo 'veillez v&#233;rifier que vos hamp obligatoires soient remplis et que la m&#234;me chose soit marqu&#233; entre email et verifier email et entre password et v&#233;rifier password.';
}

}
?>



	<div id="interface_connexion">
	
	<form action="inscription.php" method="post" enctype="multipart/form-data">
	<table>
	
	<tr><td><label for="image">Votre photo:</label></td>
	<td colspan="2"><input type="file" name="image" /></td></tr>
		
    	<tr><td><label for="nom">*Votre nom:</label></td>
	<td colspan="2"><input type="text" name="nom"  size="30" maxlength="50"/></td></tr>
	
	<tr><td><label for="password">*password:</label></td>
    	<td colspan="2"><input type="password" name="password"  size="30" maxlength="30"/></td></tr>
	
    	<tr><td><label for="Verifier_password">*reecrire password:</label></td>
    	<td colspan="2"><input type="password" name="Verifier_password"  size="30" maxlength="30"/></td></tr>

	<tr><td><label for="email">*email:</label></td>
    	<td><input type="text" name="email"  size="30" maxlength="100"/></td>
    	<td><a href="index.php">annuler</a></td></tr>
	
	<tr><td><label for="Verifier_email">*Reecrire email:</label></td>
    	<td colspan="2"><input type="text" name="Verifier_email"  size="30" maxlength="100"/></td></tr>	
    	
    	<tr><td><label for="demande_de_changement_de_categorie_d_utilisateur">Vous aimeriez &#234;tre conect&#233; comme:</label></td>
    	<td>
    	<select name="demande_de_changement_de_categorie_d_utilisateur" >
    	<option value="Ami">Ami du Petit Peuple</option>
    	<option value="membre">membre du Petit Peuple</option>
    	<option value="administrateur">administrateur</option>
    	<option value="superadministrateur">superadministrateur</option>
    	</select>
    	</td>
    	<td><input type="submit" name="Nouvel_utilisateur" value="valider" /></td></tr>	
	</table>
	</form>
	
	</div>

	
</div>
	</body>
</html>
