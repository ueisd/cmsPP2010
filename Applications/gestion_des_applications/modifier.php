<?php
if(isset($_POST['form_modifier']) and $_POST['form_modifier']!='')
{ 
$id_application_modifier=$_POST['form_modifier'];
mysql_connect("$type_hote_base_de_donnee", "$Utilisateur_base_de_donnee", "$Code_base_de_donnee"); 
mysql_select_db("$Nom_base_de_donnee"); 
$reponse = mysql_query("SELECT * FROM liste_des_applications WHERE id='$id_application_modifier'");
while ($donnees = mysql_fetch_array($reponse) )
{ ?>
Modifier application
<form action="contenu_d_application_gestion.php?table_gestion=gestion_des_applications" method="post">
<table>

<tr>
<td><label for="Nom_de_l_application">Nom de l'application:</label></td>
<td><input type="text" name="Nom_de_l_application" value="<?php echo $donnees['Nom_de_l_application']; ?>" /></td>
</tr>

<tr>
<td><label for="table_de_l_application">table de l'application:</label></td>
<td><input type="text" name="table_de_l_application" value="<?php echo $donnees['table_de_l_application']; ?>" /></td>
</tr>

<tr>
<td><label for="Nom_du_Champ_des_noms">Nom du Champ des noms:</label></td>
<td><input type="text" name="Nom_du_Champ_des_noms" value="<?php echo $donnees['Nom_du_Champ_des_noms']; ?>" /></td>
</tr>

<tr>
<td><label for="Nom_de_variable_id">Nom de variable de l'id:</label></td>
<td><input type="text" name="Nom_de_variable_id" value="<?php echo $donnees['Nom_de_variable_id']; ?>" /></td>
</tr>

<tr>
<td><label for="adresse_nouveau">Adresse pour faire un nouveau</label></td>
<td><input type="text" name="adresse_nouveau" value="<?php echo $donnees['adresse_nouveau']; ?>" /></td>
</tr>

<tr>
<td><label for="Adresse_dans_include">Adresse dans l'include:</label></td>
<td><input type="text" name="Adresse_dans_include" value="<?php echo $donnees['Adresse_dans_include']; ?>" /></td>
</tr>

<tr>
<td>Type d application</td>
<td>
   <select name="type">
   	   <option value="<?php echo $donnees['type']; ?>"><?php echo $donnees['type']; ?></option>
           <option value="contenu">contenu</option>
           <option value="conteneur">conteneur</option>
       </select>
</td>      
</tr>

<?php $type_conteneur=$donnees['type_conteneur']; ?>

<tr>
<td><input type="checkbox" name="type_conteneur" value="page" 
<?php if($type_conteneur=='page') { echo 'checked="checked"'; } ?> /></td>
<td><label for="type_conteneur">page</label></td>
</tr>


<?php 
$id_application=$donnees['id'];
$array_id_conteneur_selectionnes = array();
mysql_connect("$type_hote_base_de_donnee", "$Utilisateur_base_de_donnee", "$Code_base_de_donnee"); 
mysql_select_db("$Nom_base_de_donnee"); 
$reponse_id_conteneur_selectionnes = mysql_query("SELECT id_conteneur FROM liste_des_applications_J_conteneur WHERE id_application='$id_application'");
while ($donnees_id_conteneur_selectionnes = mysql_fetch_array($reponse_id_conteneur_selectionnes) )
{
$array_id_conteneur_selectionnes[] = $donnees_id_conteneur_selectionnes['id_conteneur'];
}

mysql_connect("$type_hote_base_de_donnee", "$Utilisateur_base_de_donnee", "$Code_base_de_donnee"); 
mysql_select_db("$Nom_base_de_donnee"); 
$reponse_id_conteneur = mysql_query("SELECT * FROM liste_des_applications WHERE type='conteneur'");
while ($donnees_id_conteneur = mysql_fetch_array($reponse_id_conteneur))
{ ?>
<tr>
<td><input type="checkbox" name="id_conteneur[]" value="<?php $id_conteneur=$donnees_id_conteneur['id']; echo $id_conteneur;?>" 
<?php if(in_array("$id_conteneur", $array_id_conteneur_selectionnes))
{ echo 'checked="checked"'; } ?> /></td>
<td><label for="id_conteneur[]"><?php echo $donnees_id_conteneur['Nom_de_l_application'];?></label></td>
</tr>
<?php } ?>

<tr>
<td colspan="2">
<input type="hidden" name="Modifier_application" value="<?php echo $donnees['id']; ?>" />
<input type="submit" name="Mod_application000" value="Enregistrer les modifications" />
</td>
</tr>

</table>
</form>	

<?php
}
} ?>