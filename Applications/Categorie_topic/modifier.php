<?php session_start(); 
if(isset($_SESSION['autorisation']) and((($_SESSION['autorisation'])=='administrateur') or (($_SESSION['autorisation'])=='superadministrateur')) and(($_GET['visite'])!='fin'))
{

if(isset($_POST['Modifier_categorie']) and $_POST['Modifier_categorie']!='')
{

$id=$_POST['Modifier_categorie'];
mysql_connect("$type_hote_base_de_donnee", "$Utilisateur_base_de_donnee", "$Code_base_de_donnee"); 
mysql_select_db("$Nom_base_de_donnee"); 
$reponse = mysql_query("SELECT * FROM Categorie_topic WHERE id='$id'");
mysql_close();
while ($donnees = mysql_fetch_array($reponse) )
{ ?>
	
Modifier la cat&#233;gorie de topics:
<form action="<?php echo $_SESSION['administration_adresse_de_la_derniere_page_avec_variables']; ?>" method="post">

<table style="background-color:#ececec; border:4px double black;">
<tr>

<td>
<h3>Categories d'utilisateurs</h3>	
<?php
$Categorie_des_utilisateurs=$donnees['Categorie_des_utilisateurs'];
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

<td>
Non de la cat&#233;gorie de topics:
<input type="text" name="nom_de_categorie" value="<?php echo $donnees['nom_de_categorie']; ?>" size="30" maxlength="60"/>
</td>

<td>
Titre:
<select name="afficher_titre">
<option value="<?php echo $donnees['afficher_titre']; ?>"><?php echo $donnees['afficher_titre']; ?></option>
<option value="">Aucun</option>
<option value="rouge">Rouge</option>
<option value="noir">Noir</option>
<option value="non_centre">Non centre</option>
</select>
</td>

<td>
Enregistrer la modification:
<input type="hidden" name="Applications_en_include_modifier_table" value="Categorie_topic" />
<input type="hidden" name="Applications_en_include_modifier_id" value="<?php echo $id; ?>" />
<input type="submit" name="Modifier_categorie" value="<?php echo $id; ?>" />
</td>


</tr>
</table>	
</form>

<?php } 
}



} ?>