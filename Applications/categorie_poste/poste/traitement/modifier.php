<?php
$image_id = $_POST['id_modifier_poste'];
$personne = $_POST['nom_personne'];
$poste = $_POST['nom_poste'];
mysql_connect("$type_hote_base_de_donnee", "$Utilisateur_base_de_donnee", "$Code_base_de_donnee"); 
mysql_select_db("$Nom_base_de_donnee");
mysql_query("UPDATE poste SET personne='$personne', poste='$poste' WHERE id='$image_id'");
mysql_close();
if(isset($_FILES['image_poste']) and $_FILES['image_poste']['error'] == 0)
{

if(isset($_FILES['image_poste']['tmp_name']))
{

if($_FILES['image_poste']['type']=='image/jpeg')
{
$type_photo='jpg';
}
elseif($_FILES['image_poste']['type']=='image/gif')
{
$type_photo='gif';
}
elseif($_FILES['image_poste']['type']=='image/png')
{
$type_photo='png';
}
elseif($_FILES['image_poste']['type']=='image/bmp')
{
$type_photo='bmp';
}
$resultat = move_uploaded_file($_FILES['image_poste']['tmp_name'], 'image/poste/preminiat.jpg' );
$nom_photo=$image_id . '.' . $type_photo;
mysql_connect("$type_hote_base_de_donnee", "$Utilisateur_base_de_donnee", "$Code_base_de_donnee"); 
mysql_select_db("$Nom_base_de_donnee");
mysql_query("UPDATE poste SET adresse='$nom_photo' WHERE id='$image_id'");
mysql_close();

$adresse='image/poste/' . $nom_photo;

$source = imagecreatefromjpeg("image/poste/preminiat.jpg");

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
?>