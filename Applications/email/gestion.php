<?php
include("Applications/email/traitement/traitement.php");



mysql_connect("$type_hote_base_de_donnee", "$Utilisateur_base_de_donnee", "$Code_base_de_donnee"); 
mysql_select_db("$Nom_base_de_donnee");
$reponse = mysql_query("SELECT * FROM inscription_email GROUP BY sujet");

?> <table> <?php
while ($donnees = mysql_fetch_array($reponse) )
{ ?>
<tr>

<td> <?php echo $donnees['sujet'];?> </td>


<td>Modifier: </td>
<td><form action="contenu_d_application_modifier.php?table_modifier=email" method="post">
<input type="hidden" name="formulaire_modifier_inscription_email" value="<?php echo $donnees['id']; ?>" />
<input type="submit" name="bouton" value="modifier" />
</form></td>

<td>Supprimer: </td>
<td><form action="contenu_d_application_gestion.php?table_gestion=email" method="post">
<input type="hidden" name="supprimer_inscription_email" value="<?php echo $donnees['id']; ?>" />
<input type="submit" name="bouton" value="supprimer" />
</form></td>

</tr>

<?php } ?>
</table>

<?php include("Applications/email/nouveau.php"); ?>