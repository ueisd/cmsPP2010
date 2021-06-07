<?php 
$table_de_l_application='mur_d_articles';

include("Applications/mur_d_articles/traitement/traitement.php");
?>

<table>
<?php 
mysql_connect("$type_hote_base_de_donnee", "$Utilisateur_base_de_donnee", "$Code_base_de_donnee"); 
mysql_select_db("$Nom_base_de_donnee");
$reponse = mysql_query("SELECT * FROM mur_d_articles");
while ($donnees = mysql_fetch_array($reponse) )
{ ?>
<tr>
<td><?php echo $donnees['nom_du_mur_d_articles_administration']; ?></td>
<td><?php echo $donnees['champ_de_tri']; ?></td>
<td><?php echo $donnees['ordre_de_tri']; ?></td>
<td><?php echo $donnees['rapport_avec_la_date_actuelle']; ?></td>
<td><?php echo $donnees['nombre_d_articles_par_pages']; ?></td>
<td><?php echo $donnees['afficher_toutes_les_categories']; ?></td>

<td><form action="contenu_d_application_modifier.php?table_modifier=mur_d_articles" method="post">
modifier le mur d'article<input type="submit" name="modifier_mur_d_article" value="<?php echo $donnees['id']; ?>" />
</form></td>
<td><form action="contenu_d_application_gestion.php?table_gestion=mur_d_articles" method="post">
Supprimer le mur d'article<input type="submit" name="supprimer_mur_d_articles" value="<?php echo $donnees['id']; ?>" />
</form></td>
</tr>
<?php }	?>
</table>


<?php include("Applications/mur_d_articles/nouveau.php");