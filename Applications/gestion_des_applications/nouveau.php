Nouvelles application
<form action="contenu_d_application_gestion.php?table_gestion=gestion_des_applications" method="post">
<table>

<tr>
<td><label for="Nom_de_l_application">Nom de l'application:</label></td>
<td><input type="text" name="Nom_de_l_application" /></td>
</tr>

<tr>
<td><label for="table_de_l_application">table de l'application:</label></td>
<td><input type="text" name="table_de_l_application" /></td>
</tr>

<tr>
<td><label for="Nom_du_Champ_des_noms">Nom du Champ des noms:</label></td>
<td><input type="text" name="Nom_du_Champ_des_noms" /></td>
</tr>

<tr>
<td><label for="Nom_de_variable_id">Nom de variable de l'id:</label></td>
<td><input type="text" name="Nom_de_variable_id" /></td>
</tr>

<tr>
<td><label for="Adresse_dans_include">Adresse dans l'include:</label></td>
<td><input type="text" name="Adresse_dans_include" /></td>
</tr>

<tr>
<td><label for="adresse_nouveau">Adresse pour faire un nouveau</label></td>
<td><input type="text" name="adresse_nouveau" value="<?php echo $donnees['adresse_nouveau']; ?>" /></td>
</tr>

<tr>
<td>Type d application</td>
<td>
   <select name="type">
           <option value="contenu">contenu</option>
           <option value="conteneur">conteneur</option>
       </select>
</td>      
</tr>

<tr>
<td><input type="checkbox" name="type_conteneur" value="page" checked="checked"/></td>
<td>Page</td>
</tr>

<?php 
mysql_connect("$type_hote_base_de_donnee", "$Utilisateur_base_de_donnee", "$Code_base_de_donnee"); 
mysql_select_db("$Nom_base_de_donnee"); 
$reponse_id_conteneur = mysql_query("SELECT * FROM liste_des_applications WHERE type='conteneur'");
while ($donnees_id_conteneur = mysql_fetch_array($reponse_id_conteneur))
{ ?>
<tr>
<td><input type="checkbox" name="id_conteneur[]" value="<?php echo $donnees_id_conteneur['id'];?>" /></td>
<td><label for="id_conteneur[]"><?php echo $donnees_id_conteneur['Nom_de_l_application'];?></label></td>
</tr>
<?php } ?>


<tr><td><label for="Nouvelle_application">Enregistrer la nouvelle page:</label></td>
<td>

<input type="submit" name="Nouvelle_application" value="valider" /></td></tr>

</table>
</form>		