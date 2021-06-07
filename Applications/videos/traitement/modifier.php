<?php
$titre_video = $_POST['titre_video'];
$type_source_video = $_POST['type_source_video'];
$code_du_video = $_POST['code_du_video'];
$description_du_video = $_POST['description_du_video'];
$id_du_video=$_POST['modifier_video_2'];
mysql_connect("$type_hote_base_de_donnee", "$Utilisateur_base_de_donnee", "$Code_base_de_donnee"); 
mysql_select_db("$Nom_base_de_donnee"); 
mysql_query("UPDATE videos SET titre_video='$titre_video', type_source_video='$type_source_video', code_du_video='$code_du_video', description_du_video='$description_du_video' WHERE id='$id_du_video'");
mysql_close();


if(isset($_FILES['image_video']) and $_FILES['image_video']['error'] == 0)
{
mysql_connect("$type_hote_base_de_donnee", "$Utilisateur_base_de_donnee", "$Code_base_de_donnee"); 
mysql_select_db("$Nom_base_de_donnee"); 
$reponse = mysql_query("SELECT adresse_image FROM videos WHERE id='$id_du_video'");
while ($donnees = mysql_fetch_array($reponse) )
{
$nom_photo=$donnees['adresse_image'];
}
mysql_close();
$image='image/video/' . $nom_photo;
if($nom_photo!='')
{
unlink($image);
}

if($_FILES['image_video']['type']=='image/jpeg')
{
$type_photo='jpg';
}
elseif($_FILES['image_video']['type']=='image/gif')
{
$type_photo='gif';
}
elseif($_FILES['image_video']['type']=='image/png')
{
$type_photo='png';
}
elseif($_FILES['image_video']['type']=='image/bmp')
{
$type_photo='bmp';
}
$image_id=$id;
$nom_photo=$image_id . '.' . $type_photo;
$adresse='image/video/' . $nom_photo;

$resultat = move_uploaded_file($_FILES['image_video']['tmp_name'], 'image/video/preminiat3.jpg' );

$source = imagecreatefromjpeg("image/video/preminiat3.jpg");

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
mysql_query("UPDATE videos SET adresse_image='$nom_photo' WHERE id='$id_du_video'");
mysql_close();
}
?>