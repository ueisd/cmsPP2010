<style>
#profil
{
	background-color:white;
	border:1px solid black;
	font-size:18px;
}
table
{
	width:100%;
}
</style>

<?php
$id=$_POST['modifier_profil'];
mysql_connect("$type_hote_base_de_donnee", "$Utilisateur_base_de_donnee", "$Code_base_de_donnee"); 
mysql_select_db("$Nom_base_de_donnee"); 
$reponse = mysql_query("SELECT * FROM utilisateurs WHERE id='$id'");
while ($donnees = mysql_fetch_array($reponse) )
{ ?> 
 
<div id="profil">

	<form action="contenu_de_noyeau_gestion.php?table_gestion=utilisateurs" method="post" enctype="multipart/form-data">
	<table>
	
	<tr><td><label for="image">Nouvelle photo:</label></td>
	<td colspan="2"><input type="file" name="image" /></td></tr>
		
    	<tr><td><label for="nom">*Votre nom:</label></td>
	<td colspan="2"><input type="text" name="nom"  size="30" value="<?php echo $donnees['nom']; ?>" maxlength="50"/></td></tr>
	
	<tr><td><label for="password">*password:</label></td>
    	<td colspan="2"><input type="text" name="password"  size="30" value="<?php echo $donnees['mot_de_passe']; ?>" maxlength="30"/></td></tr>
	
    	<tr><td><label for="Verifier_password">*reecrire password:</label></td>
    	<td colspan="2"><input type="text" name="Verifier_password"  size="30" value="<?php echo $donnees['mot_de_passe']; ?>" maxlength="30"/></td></tr>

	<tr><td><label for="email">*email:</label></td>
    	<td><input type="text" name="email"  size="30" value="<?php echo $donnees['email']; ?>" maxlength="100"/></td>
    	<td><a href="Gestion_des_utilisateurs.php">annuler</a></td></tr>
	
	<tr><td><label for="Verifier_email">*Reecrire email:</label></td>
    	<td colspan="2"><input type="text" name="Verifier_email"  size="30" value="<?php echo $donnees['email']; ?>" maxlength="100"/></td></tr>	
   
       	<tr><td>Cat&#233;gorie demand&#233;e:</td>
    	<td colspan="2"><?php echo $donnees['demande_de_changement_de_categorie_d_utilisateur']; ?></td></tr>
    	
    	<tr><td><label for="demande_de_changement_de_categorie_d_utilisateur">Cat&#233;gorie d utilisateur:</label></td>
    	<td>
    	<select name="categorie_d_utilisateur" >
    	<option value="<?php echo $donnees['categorie_d_utilisateur']; ?>"><?php echo $donnees['categorie_d_utilisateur']; ?></option>
    	<option value="Ami">Ami du Petit Peuple</option>
    	<option value="membre">membre du Petit Peuple</option>
    	<option value="administrateur">administrateur</option>
    	<option value="superadministrateur">superadministrateur</option>
    	</select>
    	</td>
    	<td>Enregistrer la modification<input type="submit" name="Modifier_utilisateur" value="<?php echo $donnees['id']; ?>" /></td></tr>	
	</table>
	</form>

</div>

	
<?php } 
mysql_close();
?>