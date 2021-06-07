$adresse_description=$_SERVER['PHP_SELF'];
<?php
$description_id=$_POST['Modifier_description'];
mysql_connect("$type_hote_base_de_donnee", "$Utilisateur_base_de_donnee", "$Code_base_de_donnee"); 
mysql_select_db("$Nom_base_de_donnee"); 
$reponse = mysql_query("SELECT * FROM description WHERE id='$description_id'");
while ($donnees = mysql_fetch_array($reponse) )
{
?>

<table style="background-color:#ececec; border:4px double black;">
<tr>
<form action="<?php echo $_SESSION['administration_adresse_de_la_derniere_page_avec_variables']; ?>" method="post" enctype="multipart/form-data">

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
<table>

<tr>
<td><label for="image">Photo de la description:</label></td>
<td><input type="file" name="image" /></td>
</tr>

<tr>
<td><label for="Titre_de_la_description">Titre de la description:</label></td>
<td><input type="text" name="Titre_de_la_description" value="<?php echo $donnees['Titre_de_la_description']; ?>" /></td>
</tr>

<tr>
<td colspan="2"><label for="Texte_de_la_description">Texte de la description:</label><br/>

<textarea name="Texte_de_la_description" id="Texte_de_la_description"><?php echo $donnees['Texte_de_la_description']; ?></textarea>

<script type="text/javascript">

// This is a check for the CKEditor class. If not defined, the paths must be checked.
if ( typeof CKEDITOR == 'undefined' )
{
	document.write(
		'<strong><span style="color: #ff0000">Error</span>: CKEditor not found</strong>.' +
		'This sample assumes that CKEditor (not included with CKFinder) is installed in' +
		'the "/ckeditor/" path. If you have it installed in a different place, just edit' +
		'this file, changing the wrong paths in the &lt;head&gt; (line 5) and the "BasePath"' +
		'value (line 32).' ) ;
}
else
{
	var editor = CKEDITOR.replace( 'Texte_de_la_description' );

	// Just call CKFinder.SetupCKEditor and pass the CKEditor instance as the first argument.
	// The second parameter (optional), is the path for the CKFinder installation (default = "/ckfinder/").
	CKFinder.setupCKEditor( editor, 'Applications/ckfinder/' ) ;

	// It is also possible to pass an object with selected CKFinder properties as a second argument.
	// CKFinder.SetupCKEditor( editor, { BasePath : '../../', RememberLastFolder : false } ) ;
}

</script>

</td>
</tr>

<tr>
<td><label for="Nouvelle_decription">Enregistrer la nouvelle description:</label></td>
<td>Enregistrer les modifications: <input type="submit" name="Modifier_description" value="<?php echo $donnees['id']; ?>" /></td>
</tr>

</table>
</td>


</form>
</tr>
</table>

<?php } ?>