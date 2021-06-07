<?php $id_categorie_poste_modifier=$_POST['categorie_poste_modifier']; ?>

<form action="contenu_d_application_gestion.php?table_gestion=categorie_poste" method="post" enctype="multipart/form-data">
<input type="hidden" name="categorie_poste" value="<?php echo $_POST['categorie_poste_modifier']; ?>" />
<?php
$categorie_du_connecte=$_SESSION['categorie_du_connecte'];
mysql_connect("$type_hote_base_de_donnee", "$Utilisateur_base_de_donnee", "$Code_base_de_donnee"); 
mysql_select_db("$Nom_base_de_donnee");
$reponse2 = mysql_query("SELECT * FROM categorie_poste WHERE id='$id_categorie_poste_modifier'");
while ($donnees2 = mysql_fetch_array($reponse2) )
{ ?>

<table style="background-color:#ececec; border:4px double black;">
<tr>

<td>
<h3>Categories d'utilisateurs</h3>	
<?php
$Categorie_des_utilisateurs=$donnees2['Categorie_des_utilisateurs'];
$Array_Categorie_des_utilisateurs=explode(",", $Categorie_des_utilisateurs);
?>	
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
<td>
<td><label for="categorie_d_utilisateur[]"><?php echo $donnees_Categorie_des_utilisateurs['categorie'];?></label></td>
<td><input type="checkbox" name="categorie_d_utilisateur[]" value="<?php echo $donnees_Categorie_des_utilisateurs['id'];?>" 

<?php
$id_de_la_categorie_du_formulaire=$donnees_Categorie_des_utilisateurs['id'];
if (in_array($id_de_la_categorie_du_formulaire, $Array_Categorie_des_utilisateurs))
{ ?>
 checked="checked"
<?php } ?> /></td>
</tr>
<?php } 
}
?>
</table>
</div>
</td>

<td><input type="text" name="modifier_categorie_poste" value="<?php echo $donnees2['categorie_poste']; ?>" /></td>


<td><input type="submit" name="Modifier_categorie_poste_envoye" value="accepter ce nouveau nom" /></td>

</tr>
</table>

<?php } ?>

</form>