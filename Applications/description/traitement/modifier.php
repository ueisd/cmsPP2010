<?php

$Titre_de_la_description = $_POST['Titre_de_la_description'];
$Texte_de_la_description = $_POST['Texte_de_la_description'];
$id=$_POST['Modifier_description'];


$categorie_acessible_au_connecte = $_SESSION['categorie_du_connecte'];
$form_categorie_d_utilisateur=$_POST["categorie_d_utilisateur"];
$id_bd_pour_Categorie_des_utilisateurs=$id;
$nom_de_table_pour_Categorie_des_utilisateurs='description';
include("traitement_Categorie_des_utilisateurs.php");


mysql_connect("$type_hote_base_de_donnee", "$Utilisateur_base_de_donnee", "$Code_base_de_donnee"); 
mysql_select_db("$Nom_base_de_donnee"); 
mysql_query("UPDATE description SET Titre_de_la_description='$Titre_de_la_description', Texte_de_la_description='$Texte_de_la_description' WHERE id='$id'");
mysql_close();


if(isset($_FILES['image']) and $_FILES['image']['error'] == 0)
{
mysql_connect("$type_hote_base_de_donnee", "$Utilisateur_base_de_donnee", "$Code_base_de_donnee"); 
mysql_select_db("$Nom_base_de_donnee"); 
$reponse = mysql_query("SELECT image FROM description WHERE id='$id'");
while ($donnees = mysql_fetch_array($reponse) )
{
$nom_photo=$donnees['image'];
}
mysql_close();
$image='image/description/' . $nom_photo;
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
$adresse='image/description/' . $nom_photo;

$resultat = move_uploaded_file($_FILES['image']['tmp_name'], 'image/description/preminiat3.jpg' );

$source = imagecreatefromjpeg("image/description/preminiat3.jpg");

$largeur_source = imagesx($source);
$hauteur_source = imagesy($source);

if($largeur_source >= $hauteur_source)
{
$largeur_nouveaux = '160';
$hauteur_nouveaux = $largeur_nouveaux/$largeur_source*$hauteur_source;
}
else
{
$hauteur_nouveaux = '120';
$largeur_nouveaux = $hauteur_nouveaux/$hauteur_source*$largeur_source;
}

$destination = imagecreatetruecolor($largeur_nouveaux, $hauteur_nouveaux); 
$largeur_destination = imagesx($destination);
$hauteur_destination = imagesy($destination);

imagecopyresampled($destination, $source, 0, 0, 0, 0, $largeur_destination, $hauteur_destination, $largeur_source, $hauteur_source);

imagejpeg($destination, $adresse);


mysql_connect("$type_hote_base_de_donnee", "$Utilisateur_base_de_donnee", "$Code_base_de_donnee"); 
mysql_select_db("$Nom_base_de_donnee"); 
mysql_query("UPDATE description SET image='$nom_photo' WHERE id='$id'");
mysql_close();
}
?>