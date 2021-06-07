<style>
#profil
{
	background-color:white;
	border:1px solid black;
	font-size:18px;
}
table
{
	width:100%;
}
</style>
<a href="Gestion_categorie_d_utilisateurs.php">Gestion des cat&#233;gories d'utilisateurs</a>		
<?php

if(isset($_POST['Supprimer_profil']) and $_POST['Supprimer_profil']!='')
{ 
$id=$_POST['Supprimer_profil'];
mysql_connect("$type_hote_base_de_donnee", "$Utilisateur_base_de_donnee", "$Code_base_de_donnee"); 
mysql_select_db("$Nom_base_de_donnee"); 

$reponse = mysql_query("SELECT image FROM utilisateurs WHERE id='$id'");
while ($donnees = mysql_fetch_array($reponse) )
{
$nom_photo=$donnees['image'];
$image='image/profil/' . $nom_photo;

if($donnees['image']!='')
{
unlink($image);
}
}

mysql_query("DELETE FROM utilisateurs WHERE id='$id'");
mysql_close();
} 



if(isset($_POST['Accepter_profil']) and $_POST['Accepter_profil']!='')
{ 
$id=$_POST['Accepter_profil'];
mysql_connect("$type_hote_base_de_donnee", "$Utilisateur_base_de_donnee", "$Code_base_de_donnee"); 
mysql_select_db("$Nom_base_de_donnee");
$reponse = mysql_query("SELECT * FROM utilisateurs WHERE id='$id'");
while ($donnees = mysql_fetch_array($reponse) )
{
$demande_de_changement_de_categorie_d_utilisateur=$donnees['demande_de_changement_de_categorie_d_utilisateur'];
}
mysql_query("UPDATE utilisateurs SET categorie_d_utilisateur='$demande_de_changement_de_categorie_d_utilisateur', demande_de_changement_de_categorie_d_utilisateur='' WHERE id='$id'");
mysql_close();
}

if(isset($_POST['Refuser_profil']) and $_POST['Refuser_profil']!='')
{ 
$id=$_POST['Refuser_profil'];
mysql_connect("$type_hote_base_de_donnee", "$Utilisateur_base_de_donnee", "$Code_base_de_donnee"); 
mysql_select_db("$Nom_base_de_donnee");
mysql_query("UPDATE utilisateurs SET demande_de_changement_de_categorie_d_utilisateur='' WHERE id='$id'");
mysql_close();
}




if(isset($_POST['Modifier_utilisateur']) and $_POST['Modifier_utilisateur']!='')
{ 

if(($_POST['password']==$_POST['Verifier_password']) and ($_POST['email']==$_POST['Verifier_email']))
{

$nom = $_POST['nom'];
$mot_de_passe = $_POST['password'];
$email = $_POST['email'];
$categorie_d_utilisateur = $_POST['categorie_d_utilisateur'];
$id=$_POST['Modifier_utilisateur'];
mysql_connect("$type_hote_base_de_donnee", "$Utilisateur_base_de_donnee", "$Code_base_de_donnee"); 
mysql_select_db("$Nom_base_de_donnee"); 
mysql_query("UPDATE utilisateurs SET nom='$nom', mot_de_passe='$mot_de_passe', email='$email', categorie_d_utilisateur='$categorie_d_utilisateur' WHERE id='$id'");
mysql_close();


if(isset($_FILES['image']) and $_FILES['image']['error'] == 0)
{
mysql_connect("$type_hote_base_de_donnee", "$Utilisateur_base_de_donnee", "$Code_base_de_donnee"); 
mysql_select_db("$Nom_base_de_donnee"); 
$reponse = mysql_query("SELECT image FROM utilisateurs WHERE id='$id'");
while ($donnees = mysql_fetch_array($reponse) )
{
$nom_photo=$donnees['image'];
}
mysql_close();
$image='image/profil/' . $nom_photo;
if($nom_photo!='')
{
unlink($image);
}

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
$image_id=$id;
$nom_photo=$image_id . '.' . $type_photo;
$adresse='image/profil/' . $nom_photo;

$resultat = move_uploaded_file($_FILES['image']['tmp_name'], 'image/profil/preminiat3.jpg' );

$source = imagecreatefromjpeg("image/profil/preminiat3.jpg");

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

mysql_connect("$type_hote_base_de_donnee", "$Utilisateur_base_de_donnee", "$Code_base_de_donnee"); 
mysql_select_db("$Nom_base_de_donnee"); 
mysql_query("UPDATE utilisateurs SET image='$nom_photo' WHERE id='$id'");
mysql_close();
}

}

}




mysql_connect("$type_hote_base_de_donnee", "$Utilisateur_base_de_donnee", "$Code_base_de_donnee"); 
mysql_select_db("$Nom_base_de_donnee"); 
$reponse = mysql_query("SELECT * FROM utilisateurs");
while ($donnees = mysql_fetch_array($reponse) )
{ ?> 
 
<div id="profil">
<table>
	
	<tr><td>Photo:</td>
	<td colspan="2"><img src="image/profil/<?php echo $donnees['image']; ?>"/></td></tr>
		
    	<tr><td>Nom:</td>
	<td colspan="2"><?php echo $donnees['nom']; ?></td></tr>
	
	<tr><td>password:</td>
    	<td><?php echo $donnees['mot_de_passe']; ?></td>
    	<td><form action="contenu_de_noyeau_gestion.php?table_gestion=utilisateurs" method="post">
    	Supprimer profil:<input type="submit" name="Supprimer_profil" value="<?php echo $donnees['id']; ?>" />
    	</form></td></tr>

	<tr><td>Email:</td>
    	<td><?php echo $donnees['email']; ?></td>
    	<td><form action="contenu_de_noyeau_modifier.php?table_modifier=utilisateurs" method="post">
 	Modifier profil:<input type="submit" name="modifier_profil" value="<?php echo $donnees['id']; ?>" />
    	</form></td></tr>
    	
    	<tr><td>Cat&#233;gorie actuelle:</td>
    	<td><?php echo $donnees['categorie_d_utilisateur']; ?></td>
    	<td> <?php if(isset($donnees['demande_de_changement_de_categorie_d_utilisateur']) and $donnees['demande_de_changement_de_categorie_d_utilisateur']!='')
	{ ?> <form action="contenu_de_noyeau_gestion.php?table_gestion=utilisateurs" method="post">
 	 Accepter la demande: <input type="submit" name="Accepter_profil" value="<?php echo $donnees['id']; ?>" />
    	</form> <?php } ?> </td></tr>
    	
    	<tr><td>Cat&#233;gorie demand&#233;e</td>
    	<td><?php echo $donnees['demande_de_changement_de_categorie_d_utilisateur']; ?></td>
    	<td> <?php if(isset($donnees['demande_de_changement_de_categorie_d_utilisateur']) and $donnees['demande_de_changement_de_categorie_d_utilisateur']!='')
	{ ?> <form action="contenu_de_noyeau_gestion.php?table_gestion=utilisateurs" method="post">
 	 Refuser la demande: <input type="submit" name="Refuser_profil" value="<?php echo $donnees['id']; ?>" />
    	</form> <?php } ?> </td></tr>	
	</table>
</div>

	
<?php } 
mysql_close();
?>