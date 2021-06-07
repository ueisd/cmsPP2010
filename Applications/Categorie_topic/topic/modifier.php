<?php 
$Adresse_modifier_topic=$_POST['Adresse_modifier_topic'];
$id_du_topic=$_POST['Modifier_topic'];

mysql_connect("$type_hote_base_de_donnee", "$Utilisateur_base_de_donnee", "$Code_base_de_donnee"); 
mysql_select_db("$Nom_base_de_donnee"); 
$reponse = mysql_query("SELECT * FROM topic WHERE id='$id_du_topic'");
while ($donnees = mysql_fetch_array($reponse) )
{
?>

<br/>
<br/>
<br/>
<br/>

<center>
<table style="background-color:#ececec; border:4px double black;">

<tr>
<td colspan="2"><center><strong>Modifier un topic</strong></center></td>
</tr>

<tr>
<td>
<form action="<?php echo $Adresse_modifier_topic; ?>" method="post" enctype="multipart/form-data">
<label for="image">Photo du topic:</label>
</td>
<td><input type="file" name="image" /></td>
</tr>

<tr>
<td><label for="nom_du_topic">Titre du topic:</label></td>
<td><input type="text" name="titre_du_topic" value="<?php echo $donnees['titre_du_topic']; ?>" /></td>
</tr>

<tr>
<td><label for="lien_du_topic">Lien du topic:</label></td>
<td><input type="text" name="lien_du_topic" value="<?php echo $donnees['lien_du_topic']; ?>" /></td>
</tr>

<tr>
<td><label for="description_du_topic">Description du topic:</label></td>
<td>
<textarea name="description_du_topic" id="description_topic"><?php echo $donnees['description_du_topic']; ?></textarea>

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
	var editor = CKEDITOR.replace( 'description_topic' );

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
<td colspan="2">
<input type="hidden" name="id_de_categorie_du_topic" value="<?php echo $_POST['id_de_categorie_du_topic'] ?>" />
<input type="hidden" name="Modifier_topic" value="<?php echo $donnees['id']; ?>" />
<input type="hidden" name="Applications_en_include_modifier_table" value="topic" />
<input type="submit" name="Mod_topic000" value="Enregistrer la modification" />
</form>
</td>
</tr>

</table>
</center>

	
<?php } ?>