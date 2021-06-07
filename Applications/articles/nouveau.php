<?php include("Applications/articles/style/css_article.php") ?>
	
	<table class="article">
	<form action="
<?php
if(isset($_GET['ajouter_a_modifier_page']) AND $_GET['ajouter_a_modifier_page']!='')
{
$id_de_la_page_pour_ajouter_application=$_GET['ajouter_a_modifier_page'];
echo 'Modifier_les_pages.php';
}
else
{
echo 'traitement.php';
}	
?>
	" method="post" enctype="multipart/form-data">
	
	<tr class="article_top" style="color:white; font-size:20px;">
	<td>
	<strong><label for="jour_debut">Debut jour: </label></strong>
	<input type="text" class="w8em format-y-m-d divider-dash highlight-days-12 range-low-1960-02-13 no-transparency" id="sd" name="jour_debut" maxlength="10"/>	
	<strong><label for="heure_debut">heure: </label></strong>
	<input type="text" name="heure_debut" maxlength="5"/>
	</td>
	
	<td>
	<strong>Fin jour:</strong>
	<input type="text" class="w8em format-y-m-d divider-dash highlight-days-12 range-low-1960-02-13 no-transparency" id="ed" name="jour_fin" maxlength="10"/>	
	<strong>heure: </strong>
	<input type="text" name="heure_fin" maxlength="5"/>
	</td>

	<td colspan="2"><strong>Titre: </strong><input type="text" name="titre" /></td>
	</tr>
	
	
	<tr class="article_contenu">
	<td colspan="4" class="article_contenu_texte">
	
<CENTER>	
<table style="background-color:#ffffef; border: 4px double black; text-align:left;">	

<tr>	
<td>
	<table style="background-color:#ececec;">
	<tr>
	<td>	
	<div style="width:700px; float:left; margin:5px; background-color:#bbbbbb;">
	
	<CENTER><h3>Photo</h3></CENTER>
	<table style="width:100%;">
	<tr>	
	<td>Image:<input type="file" name="image" /></td>
	<td>alt:<input type="text" name="alt" /></td>
	</tr>
	</table>

	
	Description de la photo: 
	<textarea name="description_de_l_image" id="description_textarea"></textarea>	

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
	var editor = CKEDITOR.replace( 'description_textarea' );

	// Just call CKFinder.SetupCKEditor and pass the CKEditor instance as the first argument.
	// The second parameter (optional), is the path for the CKFinder installation (default = "/ckfinder/").
	CKFinder.setupCKEditor( editor, 'Applications/ckfinder/' ) ;

	// It is also possible to pass an object with selected CKFinder properties as a second argument.
	// CKFinder.SetupCKEditor( editor, { BasePath : '../../', RememberLastFolder : false } ) ;
}

		</script>

	</div>
	</td>
	</tr>
	
	<tr>
	<td>
	<CENTER><h3>Corps de l'article</h3></CENTER>
	Texte de l'article: 

	<textarea name="article" id="article_textarea"></textarea>
	
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
	var editor = CKEDITOR.replace( 'article_textarea' );

	// Just call CKFinder.SetupCKEditor and pass the CKEditor instance as the first argument.
	// The second parameter (optional), is the path for the CKFinder installation (default = "/ckfinder/").
	CKFinder.setupCKEditor( editor, 'Applications/ckfinder/' ) ;

	// It is also possible to pass an object with selected CKFinder properties as a second argument.
	// CKFinder.SetupCKEditor( editor, { BasePath : '../../', RememberLastFolder : false } ) ;
}

		</script>

	</td>
	</tr>
	</table>
</td>

<td valign="top">

<table style="background-color:#f5f5f5;">
<tr>
<td>			
	<h3>Style</h3>

<table>	

	<tr>
	<td>Avec photo?</td>
	<td>
	<select name="afficher" >
    	<option value="news">sans photo</option>
    	<option value="article">avec photo</option>
	</select>
	</td>
	</tr>
	
	<tr>
	<td>Mod&#232;le:</td>
	<td>
	<select name="style" >
    	<option value="complet">Complet</option>
    	<option value="aucun_style">aucun style</option>
	</select>
	</td>
	</tr>

</table>	



<table>
<h3>Categories d'utilisateurs</h3>

<tr>
<td colspan="2">&#224; inclure</td>
</tr>
	
<?php
$categorie_d_utilisateurs_accessibles_du_connecte=$_SESSION['categorie_d_utilisateurs_du_connecte'];
$statut_administratif_de_l_utilisateur=$_SESSION['autorisation'];

if($statut_administratif_de_l_utilisateur!='superadministrateur')
{
foreach($categorie_d_utilisateurs_accessibles_du_connecte as $id_categorie_d_utilisateurs)
{
mysql_connect("$type_hote_base_de_donnee", "$Utilisateur_base_de_donnee", "$Code_base_de_donnee"); 
mysql_select_db("$Nom_base_de_donnee"); 
$reponse_categorie_des_utilisateurs_accessibles_du_connecte = mysql_query("SELECT * FROM categorie_des_utilisateurs WHERE id='$id_categorie_d_utilisateurs'");
while ($donnees_categorie_des_utilisateurs_accessibles_du_connecte = mysql_fetch_array($reponse_categorie_des_utilisateurs_accessibles_du_connecte) )
{ ?>
<tr>
<td><input type="checkbox" name="categorie_d_utilisateur[]" value="<?php echo $donnees_categorie_des_utilisateurs_accessibles_du_connecte['id'];?>" /></td>
<td><label for="categorie_d_utilisateur[]"><?php echo $donnees_categorie_des_utilisateurs_accessibles_du_connecte['nom_de_la_categorie'];?></label></td>
</tr>
<?php } 
}
}

else
{
mysql_connect("$type_hote_base_de_donnee", "$Utilisateur_base_de_donnee", "$Code_base_de_donnee"); 
mysql_select_db("$Nom_base_de_donnee"); 
$reponse_categorie_des_utilisateurs_accessibles_du_connecte = mysql_query("SELECT * FROM categorie_des_utilisateurs");
while ($donnees_categorie_des_utilisateurs_accessibles_du_connecte = mysql_fetch_array($reponse_categorie_des_utilisateurs_accessibles_du_connecte) )
{ ?>
<tr>
<td><input type="checkbox" name="categorie_d_utilisateur[]" value="<?php echo $donnees_categorie_des_utilisateurs_accessibles_du_connecte['id'];?>" /></td>
<td><label for="categorie_d_utilisateur[]"><?php echo $donnees_categorie_des_utilisateurs_accessibles_du_connecte['nom_de_la_categorie'];?></label></td>
</tr>
<?php }
}
?>
</table>
</div>
<br/>


<table>
<h3>Cat&#233;gories pour l'article</h3>	

<?php 
mysql_connect("$type_hote_base_de_donnee", "$Utilisateur_base_de_donnee", "$Code_base_de_donnee"); 
mysql_select_db("$Nom_base_de_donnee"); 
$reponse_Categorie_des_articles = mysql_query("SELECT * FROM categories_des_applications");
while ($donnees_Categorie_des_articles = mysql_fetch_array($reponse_Categorie_des_articles) )
{ ?>
<tr>
<td><input type="checkbox" name="categorie_des_articles[]" value="<?php echo $donnees_Categorie_des_articles['id'];?>" /></td>
<td><label for="categorie_des_articles[]"><?php echo $donnees_Categorie_des_articles['categorie'];?></label></td>
</tr>
<?php } ?>
</table>

</td>
</tr>
</table>

<br/>
<a href="Gestion_categories_des_applications.php">Gestion des cat&#233;gories existantes</a>



</td>
</tr>
</table>
</CENTER>	
		
	</td>
	</tr>
	
	
	<tr class="article_header">
	<td class="article_header_auteur" >auteur(e): <input type="text" name="auteure" /></td>
	<td class="article_header_source" >source: <input type="text" name="source" />
<?php
if(isset($_GET['ajouter_a_modifier_page']) AND $_GET['ajouter_a_modifier_page']!='')
{
$id_de_la_page_pour_ajouter_application=$_GET['ajouter_a_modifier_page'];

$reponse = mysql_query("SELECT id FROM liste_des_applications WHERE table_de_l_application='articles'");
while ($donnees = mysql_fetch_array($reponse))
{
$id_de_l_application=$donnees['id'];
}
?>
<input type="hidden" name="id_nouvelle_application_par_fichier_externe" value="<?php echo $id_de_l_application; ?>" />
<input type="hidden" name="Modifier_page" value="<?php echo $id_de_la_page_pour_ajouter_application; ?>" />
<?php } ?>
	
	
	</td>
	
	<td><input type="submit" name="articles_nouveau" value="Enregistrer" /><a href="archives.php"> anuler</a></td>
	</tr>
	</table>
	</table>