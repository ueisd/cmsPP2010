<?php
$id_modifier_application=$_POST['Modifier_application'];
$Nom_de_l_application=$_POST['Nom_de_l_application'];
$table_de_l_application=$_POST['table_de_l_application'];
$Nom_du_Champ_des_noms=$_POST['Nom_du_Champ_des_noms'];
$Nom_de_variable_id=$_POST['Nom_de_variable_id'];
$Adresse_dans_include=$_POST['Adresse_dans_include'];
$type_conteneur=$_POST['type_conteneur'];
$adresse_nouveau=$_POST['adresse_nouveau'];
$type=$_POST['type'];

mysql_connect("$type_hote_base_de_donnee", "$Utilisateur_base_de_donnee", "$Code_base_de_donnee"); 
mysql_select_db("$Nom_base_de_donnee"); 
mysql_query("UPDATE liste_des_applications SET Nom_de_l_application='$Nom_de_l_application', table_de_l_application='$table_de_l_application', 
Nom_du_Champ_des_noms='$Nom_du_Champ_des_noms', Nom_de_variable_id='$Nom_de_variable_id', Adresse_dans_include='$Adresse_dans_include', 
type_conteneur='$type_conteneur', adresse_nouveau='$adresse_nouveau', type='$type' WHERE id='$id_modifier_application'");

if(isset($_POST['id_conteneur']) and $_POST['id_conteneur']!='')
{
mysql_query("DELETE FROM liste_des_applications_J_conteneur WHERE id_application='$id_modifier_application'");
$array_id_conteneur=$_POST['id_conteneur'];
foreach($array_id_conteneur as $id_conteneur)
{
mysql_query("INSERT INTO liste_des_applications_J_conteneur VALUES('$id_modifier_application', '$id_conteneur')");
}
}
?>