<?php


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


if(isset($_POST['nom_photo']) and ($_POST['nom_photo']!=''))
{
$titre_photo=$_POST['nom_photo'];
}

else
{
$titre_photo=$_FILES['image']['name'];
}
$galerie_id=$_POST['galerie_id'];
mysql_connect("$type_hote_base_de_donnee", "$Utilisateur_base_de_donnee", "$Code_base_de_donnee"); 
mysql_select_db("$Nom_base_de_donnee"); 
$reponse = mysql_query("SELECT id FROM galerie ORDER BY id DESC LIMIT 0,1");
while ($donnees = mysql_fetch_array($reponse) )
{$image_id=$donnees['id'] + 1;}
$nom_photo=$image_id . '.' . $type_photo;
mysql_query("INSERT INTO galerie VALUES('', '$titre_photo', '$nom_photo', '$galerie_id')");
mysql_close();
$adresse='image/galerie/' . $nom_photo;
$resultat = move_uploaded_file($_FILES['image']['tmp_name'], 'image/galerie/preminiat.jpg' );


$source = imagecreatefromjpeg("image/galerie/preminiat.jpg");

$largeur_source = imagesx($source);
$hauteur_source = imagesy($source);

if($largeur_source >= $hauteur_source)
{
$largeur_nouveaux = '600';
$hauteur_nouveaux = $largeur_nouveaux/$largeur_source*$hauteur_source;
}
else
{
$hauteur_nouveaux = '500';
$largeur_nouveaux = $hauteur_nouveaux/$hauteur_source*$largeur_source;
}

$destination = imagecreatetruecolor($largeur_nouveaux, $hauteur_nouveaux); 
$largeur_destination = imagesx($destination);
$hauteur_destination = imagesy($destination);

imagecopyresampled($destination, $source, 0, 0, 0, 0, $largeur_destination, $hauteur_destination, $largeur_source, $hauteur_source);

imagejpeg($destination, $adresse);

?>