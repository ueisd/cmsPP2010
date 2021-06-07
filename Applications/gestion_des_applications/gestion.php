<?php include("Applications/gestion_des_applications/traitement.php/traitement.php"); ?>

<table style="background-color:#ececec; border:3px double black;">

<?php
mysql_connect("$type_hote_base_de_donnee", "$Utilisateur_base_de_donnee", "$Code_base_de_donnee"); 
mysql_select_db("$Nom_base_de_donnee"); 
$reponse = mysql_query("SELECT * FROM liste_des_applications");
while ($donnees = mysql_fetch_array($reponse) )
{?>
<tr>

<td>Le nom: </td>
<td><?php echo $donnees['Nom_de_l_application']; ?></td>
<td>Le type de conteneur: </td>

<td>
<form action="contenu_d_application_modifier.php?table_modifier=gestion_des_applications" method="post">
<input type="hidden" name="form_modifier" value="<?php echo $donnees['id']; ?>"/>
<input type="submit" name="form_mod000" value="modifier"
</form>
</td>

<td>
<form action="contenu_d_application_gestion.php?table_gestion=gestion_des_applications" method="post">
<input type="hidden" name="form_suprimer" value="<?php echo $donnees['id']; ?>"/>
<input type="submit" name="form_supr000" value="Suprimer"
</form>
</td>

</tr>
<?php } ?>

</table>


<?php include("Applications/gestion_des_applications/nouveau.php");