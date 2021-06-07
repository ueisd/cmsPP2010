<?php
$Titre_de_la_description = $_POST['Titre_de_la_description'];
$Texte_de_la_description = $_POST['Texte_de_la_description'];

if(isset($_POST[categorie_d_utilisateur]) and $_POST[categorie_d_utilisateur]!='')
{
$Categorie_des_utilisateurs_form=$_POST[categorie_d_utilisateur];
$Categorie_des_utilisateurs=implode(",", $Categorie_des_utilisateurs_form);
}

mysql_connect("$type_hote_base_de_donnee", "$Utilisateur_base_de_donnee", "$Code_base_de_donnee"); 
mysql_select_db("$Nom_base_de_donnee"); 
mysql_query("INSERT INTO description VALUES('', '', '$Titre_de_la_description', '$Texte_de_la_description')");


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
$reponse = mysql_query("SELECT id FROM description WHERE Texte_de_la_description='$Texte_de_la_description'");
while ($donnees = mysql_fetch_array($reponse) )
{$image_id=$donnees['id'];}
$nom_photo=$image_id . '.' . $type_photo;
mysql_query("UPDATE description SET image='$nom_photo' WHERE id='$image_id'");
mysql_close();
$adresse='image/description/' . $nom_photo;
$resultat = move_uploaded_file($_FILES['image']['tmp_name'], 'image/description/preminiat.jpg' );


$source = imagecreatefromjpeg("image/description/preminiat.jpg");

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