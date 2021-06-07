<table style="background-color:#ececec; border:4px double black;">
<tr>
<form action="<?php echo $_SESSION['administration_adresse_de_la_derniere_page_avec_variables']; ?>" method="post" enctype="multipart/form-data">

<td>
<h3>Categories d'utilisateurs</h3>	
<div style="height:150px; width:250px;; overflow:auto;">
<table>
<?php 
$categorie_du_connecte = $_SESSION['categorie_du_connecte'];
foreach($categorie_du_connecte as $id_categorie_du_connecte)
{
mysql_connect("$type_hote_base_de_donnee", "$Utilisateur_base_de_donnee", "$Code_base_de_donnee"); 
mysql_select_db("$Nom_base_de_donnee"); 
$reponse_Categorie_des_utilisateurs = mysql_query("SELECT * FROM Categorie_des_utilisateurs WHERE id='$id_categorie_du_connecte'");
while ($donnees_Categorie_des_utilisateurs = mysql_fetch_array($reponse_Categorie_des_utilisateurs) )
{ ?>
<tr>
<td><label for="categorie_d_utilisateur[]"><?php echo $donnees_Categorie_des_utilisateurs['categorie'];?></label></td>
<td><input type="checkbox" name="categorie_d_utilisateur[]" value="<?php echo $donnees_Categorie_des_utilisateurs['id'];?>" /></td>
</tr>
<?php } 
}
?>
</table>
</div>
</td>


<td>
<table>

<tr><td><label for="image">Photo de la description:</label></td>
<td><input type="file" name="image" /></td></tr>

<tr><td><label for="Titre_de_la_description">Titre de la description:</label></td>
<td><input type="text" name="Titre_de_la_description" /></td></tr>

<tr><td><label for="Texte_de_la_description">Texte de la description:</label></td>
<td><textarea name="Texte_de_la_description"></textarea></td></tr>

<tr><td><label for="Nouvelle_decription">Enregistrer la nouvelle description:</label></td>
<td>
<input type="submit" name="Nouvelle_decription" value="valider" /></td></tr>

</table>
</td>

</form>
</tr>
</table>