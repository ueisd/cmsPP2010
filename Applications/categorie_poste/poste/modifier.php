<?php
$id_poste=$_POST['modifier_image'];
$type_post=$_POST['type_post'];
$adresse_galerie_poste=$_POST['adresse_galerie_poste'];
mysql_connect("$type_hote_base_de_donnee", "$Utilisateur_base_de_donnee", "$Code_base_de_donnee"); 
mysql_select_db("$Nom_base_de_donnee");
$reponse = mysql_query("SELECT * FROM poste WHERE id='$id_poste' ");
while ($donnees = mysql_fetch_array($reponse) )
{
?>
<br/>
<br/>
<br/>
<br/>
<br/>
<center>
<table style="background-color:#ececec; border:4px double black;">

	  <tr>
	  <td colspan="2">


	  <table style="background-color:#bbbbbb; width:100%;">
	  <tr>

	  <td>
	  <img src="<?php echo 'image/poste/' . $donnees['adresse']; ?>" />
	  </td>
	  
	  <td valign="top">
	  <table>
	  <tr>
	  <td>Personne: </td>	  
	  <td><?php echo $donnees['personne']; ?></td>
	  </tr>
	  
	  <tr>
	  <td>Poste: </td>
	  <td><?php echo $donnees['poste']; ?></td>
	  </tr>
	  </table>
	  </td>
	  
	  
	  </tr>
	  </table>
	  
	  	  
	  </td>
	  </tr>

	  <tr>
	  <td>
          <form action="<?php echo $adresse_galerie_poste; ?>" method="post"  enctype="multipart/form-data">
          Image:
          </td>
          <td><input type="file" name="image_poste" /></td>
          <tr>
          
          <tr>
          <td>Personne:</td>
          <td><input type="text" name="nom_personne" value="<?php echo $donnees['personne']; ?>" /></td>
          </tr>
          
          <tr>
          <td>Poste:</td>
          <td><input type="text" name="nom_poste" value="<?php echo $donnees['poste']; ?>" /></td>
          </tr>
          
          <tr>
          <td colspan="2">
          <input type="hidden" name="id_modifier_poste" value="<?php echo $donnees['id']; ?>" />
          <input type="hidden" name="type_post" value="<?php echo $type_post; ?>" />
          <input type="hidden" name="modifier_image" value="enregistrer" />
          <input type="submit" name="modi_image000" value="Enregistrer la modification" />
          </form>
          <a href="<?php echo $adresse_galerie_poste; ?>">Anuler</a>
          </td>
          </tr>
          
</table>
</center>
<?php 
} 
mysql_close(); ?>