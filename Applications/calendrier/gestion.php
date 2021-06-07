<?php
include("Applications/calendrier/traitement/traitement.php");



mysql_connect("$type_hote_base_de_donnee", "$Utilisateur_base_de_donnee", "$Code_base_de_donnee"); 
mysql_select_db("$Nom_base_de_donnee");
$reponse = mysql_query("SELECT * FROM calendrier GROUP BY nom");

?> <table> <?php
while ($donnees = mysql_fetch_array($reponse) )
{ ?>
<tr>

<td> <?php echo $donnees['nom'];?> </td>

<td>
<?php 
$id_categorie_calendrier=$donnees['id'];
$reponse2 = mysql_query("SELECT categories_des_applications.categorie AS categorie, categories_des_calendriers.calendrier FROM categories_des_applications, categories_des_calendriers WHERE categories_des_calendriers.calendrier='$id_categorie_calendrier' AND categories_des_applications.id=categories_des_calendriers.categorie");
while ($donnees2 = mysql_fetch_array($reponse2) )
{ ?>
 espace <?php echo $donnees2['categorie']; ?>
<?php } ?>
</td>

<td>Modifier: </td>
<td><form action="contenu_d_application_modifier.php?table_modifier=calendrier" method="post">
<input type="submit" name="modifier_calendrier" value="<?php echo $donnees['id']; ?>" />
</form></td>

<td>Supprimer: </td>
<td><form action="contenu_d_application_gestion.php?table_gestion=calendrier" method="post">
<input type="submit" name="supprimer_calendrier" value="<?php echo $donnees['id']; ?>" />
</form></td>

</tr>

<?php } ?>
</table>

<?php include("Applications/calendrier/nouveau.php"); ?>