<?php
$table_application='articles';

if(isset($_POST['articles_nouveau']) and ($_POST['articles_nouveau']=='Enregistrer'))
{
$jour_debut = $_POST['jour_debut'];
$heure_debut = $_POST['heure_debut'];
$date_debut = $jour_debut . ' ' . $heure_debut;

$jour_fin = $_POST['jour_fin'];
$heure_fin = $_POST['heure_fin'];
$date_fin = $jour_fin . ' ' . $heure_fin;

$titre=$_POST['titre'];
$image='adresse';
$alt=$_POST['alt'];
$description_de_l_image=$_POST['description_de_l_image'];
$article=$_POST['article'];
$auteure=$_POST['auteure'];
$source=$_POST['source'];
$afficher=$_POST['afficher'];
$style=$_POST['style'];


mysql_connect("$type_hote_base_de_donnee", "$Utilisateur_base_de_donnee", "$Code_base_de_donnee"); 
mysql_select_db("$Nom_base_de_donnee");
mysql_query("INSERT INTO articles VALUES('', '$date_debut', '$titre', '$image', '$alt', '$description_de_l_image',
 '$article', '$auteure', '$source', '$date_fin', '$afficher', '$style')");

$article_id = mysql_insert_id();



if(isset($_POST['categorie_des_articles']) and $_POST['categorie_des_articles']!='')
{
$array_categorie_des_articles=$_POST['categorie_des_articles'];
foreach($array_categorie_des_articles as $id_categorie_des_articles)
{
mysql_query("INSERT INTO categories_des_applications_J_applications VALUES('$id_categorie_des_articles', '$article_id', '$table_application')");
}
}

if(isset($_POST['categorie_d_utilisateur']) and $_POST['categorie_d_utilisateur']!='')
{
$array_categorie_d_utilisateur=$_POST['categorie_d_utilisateur'];
foreach($array_categorie_d_utilisateur as $id_categorie_d_utilisateur)
{
mysql_query("INSERT INTO categorie_des_utilisateurs_J_applications VALUES('$id_categorie_d_utilisateur', '$article_id', '$table_application')");
}
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


$adresse = 'image/article/' . $article_id . '.' . $type_photo;
$image = $article_id . '.' . $type_photo;


$resultat = move_uploaded_file($_FILES['image']['tmp_name'], 'image/galerie/preminiat.jpg' );

$source = imagecreatefromjpeg("image/galerie/preminiat.jpg");

$largeur_source = imagesx($source);
$hauteur_source = imagesy($source);

if($largeur_source >= $hauteur_source)
{
$largeur_nouveaux = '432';
$hauteur_nouveaux = $largeur_nouveaux/$largeur_source*$hauteur_source;
}
else
{
$hauteur_nouveaux = '300';
$largeur_nouveaux = $hauteur_nouveaux/$hauteur_source*$largeur_source;
}

$destination = imagecreatetruecolor($largeur_nouveaux, $hauteur_nouveaux); 
$largeur_destination = imagesx($destination);
$hauteur_destination = imagesy($destination);

imagecopyresampled($destination, $source, 0, 0, 0, 0, $largeur_destination, $hauteur_destination, $largeur_source, $hauteur_source);

imagejpeg($destination, $adresse);





if ($resultat) {mysql_query("UPDATE articles SET image='$image' WHERE id='$article_id'");}

if(isset($_POST['categorie_d_utilisateur']) and $_POST['categorie_d_utilisateur']!='')
{
$categorie_d_utilisateur_form=$_POST['categorie_d_utilisateur'];
$Categorie_d_utilisateur_form=implode(",", $categorie_d_utilisateur_form);
mysql_query("UPDATE articles SET Categorie_des_utilisateurs='$Categorie_d_utilisateur_form' WHERE id='$article_id'");
}
mysql_close();
} 
?>