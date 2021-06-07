<?php
$table_application='articles';

if(isset($_POST['articles_supprimer']) and ($_POST['articles_supprimer']=='supprimer'))
{
$article_id=$_POST['article_id'];
mysql_connect("$type_hote_base_de_donnee", "$Utilisateur_base_de_donnee", "$Code_base_de_donnee"); 
mysql_select_db("$Nom_base_de_donnee");
$reponse = mysql_query("SELECT image FROM articles WHERE id='$article_id'");
mysql_query("DELETE FROM articles WHERE id='$article_id'");
mysql_query("DELETE FROM categories_des_applications_J_applications WHERE id_application='$article_id' AND nom_de_table_de_l_application='$table_application'");
mysql_query("DELETE FROM categorie_des_utilisateurs_J_applications WHERE id_application='$article_id' AND table_d_application='$table_application'");
mysql_close();
while ($donnees = mysql_fetch_array($reponse) )
{ $image='image/article/' . $donnees['image'];
  $lien=$donnees['image'];
 if($lien!='adresse')
  {unlink($image);}}
}
?>