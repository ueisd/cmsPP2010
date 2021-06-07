<?php
$titre_video = $_POST['titre_video'];
$type_source_video = $_POST['type_source_video'];
$code_du_video = $_POST['code_du_video'];
$description_du_video = $_POST['description_du_video'];


mysql_connect("$type_hote_base_de_donnee", "$Utilisateur_base_de_donnee", "$Code_base_de_donnee"); 
mysql_select_db("$Nom_base_de_donnee"); 
mysql_query("INSERT INTO videos VALUES('', '', '$titre_video', '$type_source_video', '$code_du_video', '$description_du_video')");
mysql_close();

if(isset($_FILES['image_video']) and $_FILES['image_video']['error'] == 0)
{
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
mysql_connect("$type_hote_base_de_donnee", "$Utilisateur_base_de_donnee", "$Code_base_de_donnee"); 
mysql_select_db("$Nom_base_de_donnee"); 
$reponse = mysql_query("SELECT id FROM videos WHERE titre_video='$titre_video'");
while ($donnees = mysql_fetch_array($reponse) )
{$image_id=$donnees['id'];}
$nom_photo=$image_id . '.' . $type_photo;
mysql_query("UPDATE videos SET adresse_image='$nom_photo' WHERE id='$image_id'");
mysql_close();
$adresse='image/video/' . $nom_photo;
$resultat = move_uploaded_file($_FILES['image_video']['tmp_name'], 'image/video/preminiat.jpg' );


$source = imagecreatefromjpeg("image/video/preminiat.jpg");

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

}
?>