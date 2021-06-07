Nouvelle Galerie:
          <form action="<?php echo $_SESSION['administration_adresse_de_la_derniere_page_avec_variables']; ?>" method="post">
 
<table style="background-color:#ececec; border:4px double black;">
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

<td>Nom de la nouvelle galerie:<input type="text" name="adresse_galerie" /><br/>Pas d'apostrophe dans le nom...</td>
<td><input type="submit" name="nouvelle_galerie" value="ok" /></td>
    
</tr>
</table>      
          </form>