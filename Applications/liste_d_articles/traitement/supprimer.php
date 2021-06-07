<?php
$id_liste_d_articles_supprimer = $_POST['supprimer_liste_d_articles'];
mysql_connect("$type_hote_base_de_donnee", "$Utilisateur_base_de_donnee", "$Code_base_de_donnee"); 
mysql_select_db("$Nom_base_de_donnee");
mysql_query("DELETE FROM liste_d_articles WHERE id='$id_liste_d_articles_supprimer'");
mysql_query("DELETE FROM applications_J_exclure_categories WHERE id_application='$id_liste_d_articles_supprimer' AND nom_de_table_de_l_application='$table_de_l_application'");
mysql_query("DELETE FROM applications_J_inclure_categories WHERE id_application='$id_liste_d_articles_supprimer' AND nom_de_table_de_l_application='$table_de_l_application'");
mysql_close();
?>