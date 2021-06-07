<?php 
$table_de_l_application='liste_d_articles';

include("Applications/liste_d_articles/traitement/traitement.php");
?>



<table>
<?php 
mysql_connect("$type_hote_base_de_donnee", "$Utilisateur_base_de_donnee", "$Code_base_de_donnee"); 
mysql_select_db("$Nom_base_de_donnee");
$reponse = mysql_query("SELECT * FROM liste_d_articles");
while ($donnees = mysql_fetch_array($reponse) )
{ ?>
<tr>
<td><?php echo $donnees['nom_de_la_liste_d_articles_administration']; ?></td>
<td><?php echo $donnees['champ_de_tri']; ?></td>
<td><?php echo $donnees['ordre_de_tri']; ?></td>
<td><?php echo $donnees['rapport_avec_la_date_actuelle']; ?></td>
<td><?php echo $donnees['afficher_toutes_les_categories']; ?></td>

<td><form action="contenu_d_application_modifier.php?table_modifier=liste_d_articles" method="post">
modifier le mur d'article<input type="submit" name="modifier_liste_d_article" value="<?php echo $donnees['id']; ?>" />
</form></td>
<td><form action="contenu_d_application_gestion.php?table_gestion=liste_d_articles" method="post">
Supprimer le mur d'article<input type="submit" name="supprimer_liste_d_articles" value="<?php echo $donnees['id']; ?>" />
</form></td>
</tr>
<?php }	?>
</table>




<?php include("Applications/liste_d_articles/nouveau.php"); ?>