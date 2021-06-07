<?php
if(isset($_POST['id_nouvelle_application_par_fichier_externe']) and $_POST['id_nouvelle_application_par_fichier_externe']!='')
{
$id_application=$_POST['id_nouvelle_application_par_fichier_externe'];
$id_de_la_page=$_POST['Modifier_page'];

mysql_connect("$type_hote_base_de_donnee", "$Utilisateur_base_de_donnee", "$Code_base_de_donnee"); 
mysql_select_db("$Nom_base_de_donnee");
$reponse_ordre = mysql_query("SELECT Nom_de_variable_id, table_de_l_application FROM liste_des_applications WHERE id='$id_application'");
while ($donnees_ordre = mysql_fetch_array($reponse_ordre) )
{
$Nom_de_variable_id=$donnees_ordre['Nom_de_variable_id'];
$id_nom_application=${$Nom_de_variable_id};
$table_de_l_application=$donnees_ordre['table_de_l_application'];
}
include 'Applications/' . $table_de_l_application . '/traitement/nouveau.php';


$id_nom_application=${$Nom_de_variable_id};

mysql_connect("$type_hote_base_de_donnee", "$Utilisateur_base_de_donnee", "$Code_base_de_donnee"); 
mysql_select_db("$Nom_base_de_donnee");
$reponse_ordre = mysql_query("SELECT ordre FROM Applications_des_pages WHERE id_de_la_page='$id_de_la_page' ORDER BY ordre DESC LIMIT 0,1");
while ($donnees_ordre = mysql_fetch_array($reponse_ordre) )
{
$ordre_dernier=$donnees_ordre['ordre'];
$ordre_nouveau=$ordre_dernier+1;
}
mysql_query("INSERT INTO Applications_des_pages VALUES('', '$id_de_la_page', '$id_nom_application', '$id_application', '$ordre_nouveau')");
}
?>