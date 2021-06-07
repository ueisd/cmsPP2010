<?php
if(isset($_POST['galerie_renomer']))
{ ?>

<?php
$id_galerie_modifier=$_POST['id_galerie_modifier'];

mysql_connect("$type_hote_base_de_donnee", "$Utilisateur_base_de_donnee", "$Code_base_de_donnee"); 
mysql_select_db("$Nom_base_de_donnee"); 
$reponse5 = mysql_query("SELECT * FROM galerie_nom WHERE id='$id_galerie_modifier'");
while ($donnees5 = mysql_fetch_array($reponse5) )
{
?>

<table style="background-color:#ececec; border:4px double black;">
<tr>
          <form action="<?php echo $_SESSION['administration_adresse_de_la_derniere_page_avec_variables']; ?>" method="post" enctype="multipart/form-data">   

<td>       
<h3>Categories d'utilisateurs</h3>	
<?php
$Categorie_des_utilisateurs=$donnees5['Categorie_des_utilisateurs'];
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
         
           <td>Nom de la galerie photo: </td>
           <td><input type="text" name="nom_galerie_nouveau" value="<?php echo $donnees5['nom_galerie']; ?>" /></td>
           
          <td>
          <input type="hidden" name="id_galerie_modifier" value="<?php echo $id_galerie_modifier; ?>" />         
          <input type="submit" name="galerie_r" value="Enregistrer" />
          </td>
          </form>
          
          </tr>
          </table>
<?php
}
 } ?>