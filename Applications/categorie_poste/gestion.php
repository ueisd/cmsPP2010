<?php
$type= 'administration';

include("Applications/categorie_poste/traitement/traitement.php");

?>

	
	<table>
	
<?php 
mysql_connect("$type_hote_base_de_donnee", "$Utilisateur_base_de_donnee", "$Code_base_de_donnee"); 
mysql_select_db("$Nom_base_de_donnee");


$categories_acessibles_connecte=$_SESSION['categorie_du_connecte']; 
$array_id_categorie_toute=array('1');
$categories_acessibles_connecte_moin_array_id_categorie_toute=array_diff($categories_acessibles_connecte, $array_id_categorie_toute);

if(($categories_acessibles_connecte_moin_array_id_categorie_toute!=$categories_acessibles_connecte) or (isset($_SESSION['autorisation']) and ($_SESSION['autorisation']=='superadministrateur') and ($_GET['visite']!='fin')))
{
$reponse = mysql_query("SELECT * FROM categorie_poste");
}
else
{
$reponse = mysql_query("SELECT * FROM categorie_poste WHERE Categorie_des_utilisateurs IN (".implode(',', $categories_acessibles_connecte).")");
}


while ($donnees = mysql_fetch_array($reponse) )
{
?>

<tr>

<td colspan=3>
<a href="../galerie_poste.php?id=<?php echo $donnees['id'];?>&galerie_choisie=ok"><?php echo $donnees['categorie_poste']; ?></a>
</td>

<td colspan=3>
<form action="contenu_d_application_modifier.php?table_modifier=categorie_poste" method="post" enctype="multipart/form-data">
<input type="hidden" name="categorie_poste_modifier" value="<?php echo $donnees['id'];?>" />
<input type="hidden" name="titre_vieille_categorie" value="<?php echo $donnees['categorie_poste'];?>" />
<input type="submit" name="modifier" value="Modifier" />
</form>
</td>



<td colspan=3>
<form action="contenu_d_application_gestion.php?table_gestion=categorie_poste" method="post" enctype="multipart/form-data">
<input type="hidden" name="categorie_poste_supprimer" value="<?php echo $donnees['id'];?>" />
<input type="submit" name="supprimer" value="supprimer" />
Le id et nom variable:
<input type="text" name="id" value="<?php echo '<?php $type_poste_id=' . 
          $donnees['id'] . ';' . ' $adresse_galerie_poste=$_SERVER[\'PHP_SELF\'];' . ' include \'galerie_poste_en_include.php\'; ?>'; ?>" /> 
</form>
</td>

</tr>

<?php 
} 
mysql_close(); 
?>

</table>
<br/>

<table style="background-color:#ececec; border:4px double black;">
<form action="contenu_d_application_gestion.php?table_gestion=categorie_poste" method="post" enctype="multipart/form-data">
<tr>

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

<td>Nom de la nouvelle galerie de postes: </td>
<td><input type="text" name="nouvelle_categorie_poste" /></td>
<td><input type="submit" name="Nouvelle_categorie_envoye" value="Ajouter cette categorie" /></td>
</tr>
</form>
</table>


	</div>