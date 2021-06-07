<?php
if(isset($_POST['modifier_categorie']) and ($_POST['modifier_categorie']!=''))
{
mysql_connect("$type_hote_base_de_donnee", "$Utilisateur_base_de_donnee", "$Code_base_de_donnee"); 
mysql_select_db("$Nom_base_de_donnee");
$nom_de_categorie_d_utilisateurs=$_POST['categorie'];
$modifier_categorie=$_POST['modifier_categorie'];
$array_utilisateurs_a_mettre=$_POST['utilisateurs_a_mettre'];
mysql_query("UPDATE categorie_des_utilisateurs SET nom_de_la_categorie='$nom_de_categorie_d_utilisateurs' WHERE id='$modifier_categorie'");

if(isset($_POST['utilisateurs_a_mettre']) and ($_POST['utilisateurs_a_mettre']!=''))
{
foreach($array_utilisateurs_a_mettre as $utilisateurs_a_mettre)
{
mysql_query("INSERT INTO categorie_des_utilisateurs_J_utilisateurs VALUES('$modifier_categorie', '$utilisateurs_a_mettre')");
}
}

}




if(isset($_POST['supprimer_categorie']) and ($_POST['supprimer_categorie']!=''))
{
$id=$_POST['supprimer_categorie'];
mysql_connect("$type_hote_base_de_donnee", "$Utilisateur_base_de_donnee", "$Code_base_de_donnee"); 
mysql_select_db("$Nom_base_de_donnee");
mysql_query("DELETE FROM categorie_des_utilisateurs WHERE id='$id'");
mysql_query("DELETE FROM categorie_des_utilisateurs_J_utilisateurs WHERE categorie='$id'");
}


if(isset($_POST['nouvelle_categorie']) and ($_POST['nouvelle_categorie']=='ok'))
{
$categorie=$_POST['categorie'];
mysql_connect("$type_hote_base_de_donnee", "$Utilisateur_base_de_donnee", "$Code_base_de_donnee"); 
mysql_select_db("$Nom_base_de_donnee");
mysql_query("INSERT INTO categorie_des_utilisateurs VALUES('', '$categorie')");
$categorie_id= mysql_insert_id();

if(isset($_POST['utilisateurs']) and $_POST['utilisateurs']!='')
{
$array_utilisateurs=$_POST['utilisateurs'];
foreach($array_utilisateurs as $id_utilisateurs)
{
mysql_query("INSERT INTO categorie_des_utilisateurs_J_utilisateurs VALUES('$categorie_id', '$id_utilisateurs')");
}
}
}



mysql_connect("$type_hote_base_de_donnee", "$Utilisateur_base_de_donnee", "$Code_base_de_donnee"); 
mysql_select_db("$Nom_base_de_donnee");
$reponse = mysql_query("SELECT * FROM categorie_des_utilisateurs GROUP BY nom_de_la_categorie");

?> <table> <?php
while ($donnees = mysql_fetch_array($reponse) )
{ ?>
<tr>

<td> <?php echo $donnees['nom_de_la_categorie'];?> </td>

<td>
<?php 
$id_categorie_utilisateur=$donnees['id'];
$reponse2 = mysql_query("SELECT DISTINCT utilisateurs.nom AS utilisateurs FROM utilisateurs, categorie_des_utilisateurs, categorie_des_utilisateurs_J_utilisateurs WHERE categorie_des_utilisateurs_J_utilisateurs.categorie=$id_categorie_utilisateur AND utilisateurs.id=categorie_des_utilisateurs_J_utilisateurs.utilisateurs");
while ($donnees2 = mysql_fetch_array($reponse2) )
{ ?>
 espace <?php echo $donnees2['utilisateurs']; ?>
<?php } ?>
</td>

<td>Modifier: </td>
<td><form action="contenu_de_noyeau_modifier.php?table_modifier=categorie_d_utilisateurs" method="post">
<input type="submit" name="modifier_categorie" value="<?php echo $donnees['id']; ?>" />
</form></td>

<td>Supprimer: </td>
<td><form action="contenu_de_noyeau_gestion.php?table_gestion=categorie_d_utilisateurs" method="post">
<input type="submit" name="supprimer_categorie" value="<?php echo $donnees['id']; ?>" />
</form></td>

</tr>

<?php } ?>
</table>



	nouvelle cat&#233;gories d'utilisateurs
<table style="background-color:#ececec; border:4px double black;">
<form action="contenu_de_noyeau_gestion.php?table_gestion=categorie_d_utilisateurs" method="post">

<tr>
<td>Nom de la cat&#233;gorie: <input type="text" name="categorie" /></td>
</tr>


<tr>
<td>
<h3>Utilisateurs</h3>	
<div style="height:150px; width:250px;; overflow:auto;">

<table>
<?php 
mysql_connect("$type_hote_base_de_donnee", "$Utilisateur_base_de_donnee", "$Code_base_de_donnee"); 
mysql_select_db("$Nom_base_de_donnee"); 
$reponse_Categorie_des_utilisateurs = mysql_query("SELECT * FROM utilisateurs WHERE categorie_d_utilisateur!='En approbation'");
while ($donnees_Categorie_des_utilisateurs = mysql_fetch_array($reponse_Categorie_des_utilisateurs) )
{ ?>
<tr>
<td><label for="categorie_d_utilisateur[]"><?php echo $donnees_Categorie_des_utilisateurs['nom'];?></label></td>
<td><input type="checkbox" name="utilisateurs[]" value="<?php echo $donnees_Categorie_des_utilisateurs['id'];?>" /></td>
</tr>
<?php } ?>

</div>
</table>

</td>
</tr>


<tr>
<td><input type="submit" name="nouvelle_categorie" value="ok" /></td>
</tr>

</form>
</table>