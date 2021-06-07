<?php 

$table_application='articles';

if(isset($_POST['modifier']) and ($_POST['modifier']=='modifier'))
{
$article_id=$_POST['article_id'];
mysql_connect("$type_hote_base_de_donnee", "$Utilisateur_base_de_donnee", "$Code_base_de_donnee"); 
mysql_select_db("$Nom_base_de_donnee");

$reponse = mysql_query("SELECT * FROM articles WHERE id='$article_id'");
while ($donnees = mysql_fetch_array($reponse) )
{
$jour_debut = ucwords(strftime("%Y-%m-%d", strtotime($donnees['date']))); 
$heure_debut = ucwords(strftime("%H:%M", strtotime($donnees['date']))); 

$jour_fin = ucwords(strftime("%Y-%m-%d", strtotime($donnees['date_fin']))); 
$heure_fin = ucwords(strftime("%H:%M", strtotime($donnees['date_fin'])));
}
}
?>

<script type="text/javascript">
//<![CDATA[

/*
        A "Reservation Date" example using two datePickers
        --------------------------------------------------

        * Functionality

        1. When the page loads:
                - We clear the value of the two inputs (to clear any values cached by the browser)
                - We set an "onchange" event handler on the startDate input to call the setReservationDates function
        2. When a start date is selected
                - We set the low range of the endDate datePicker to be the start date the user has just selected
                - If the endDate input already has a date stipulated and the date falls before the new start date then we clear the input's value

        * Caveats (aren't there always)

        - This demo has been written for dates that have NOT been split across three inputs

*/

function makeTwoChars(inp) {
        return String(inp).length < 2 ? "0" + inp : inp;
}

function initialiseInputs() {
        // Clear any old values from the inputs (that might be cached by the browser after a page reload)
        document.getElementById("sd").value = "<?php echo $jour_debut; ?>";
        document.getElementById("ed").value = "<?php echo $jour_fin; ?>";

        // Add the onchange event handler to the start date input
        datePickerController.addEvent(document.getElementById("sd"), "change", setReservationDates);
}

var initAttempts = 0;

function setReservationDates(e) {
        // Internet Explorer will not have created the datePickers yet so we poll the datePickerController Object using a setTimeout
        // until they become available (a maximum of ten times in case something has gone horribly wrong)

        try {
                var sd = datePickerController.getDatePicker("sd");
                var ed = datePickerController.getDatePicker("ed");
        } catch (err) {
                if(initAttempts++ < 10) setTimeout("setReservationDates()", 50);
                return;
        }

        // Check the value of the input is a date of the correct format
        var dt = datePickerController.dateFormat(this.value, sd.format.charAt(0) == "m");

        // If the input's value cannot be parsed as a valid date then return
        if(dt == 0) return;

        // At this stage we have a valid YYYYMMDD date

        // Grab the value set within the endDate input and parse it using the dateFormat method
        // N.B: The second parameter to the dateFormat function, if TRUE, tells the function to favour the m-d-y date format
        var edv = datePickerController.dateFormat(document.getElementById("ed").value, ed.format.charAt(0) == "m");

        // Set the low range of the second datePicker to be the date parsed from the first
        ed.setRangeLow( dt );
        
        // If theres a value already present within the end date input and it's smaller than the start date
        // then clear the end date value
        if(edv < dt) {
                document.getElementById("ed").value = "";
        }
}

function removeInputEvents() {
        // Remove the onchange event handler set within the function initialiseInputs
        datePickerController.removeEvent(document.getElementById("sd"), "change", setReservationDates);
}

datePickerController.addEvent(window, 'load', initialiseInputs);
datePickerController.addEvent(window, 'unload', removeInputEvents);

//]]>
</script>

<?php
if(isset($_POST['modifier']) and ($_POST['modifier']=='modifier'))
{
$article_id=$_POST['article_id'];
mysql_connect("$type_hote_base_de_donnee", "$Utilisateur_base_de_donnee", "$Code_base_de_donnee"); 
mysql_select_db("$Nom_base_de_donnee");

$reponse = mysql_query("SELECT * FROM articles WHERE id='$article_id'");
while ($donnees = mysql_fetch_array($reponse) )
{ ?> 

	<?php include("Applications/articles/style/css_article.php") ?>
	
	
	<table class="article">

		
<form action="<?php echo $_SESSION['administration_adresse_de_la_derniere_page_avec_variables']; ?>" method="post" enctype="multipart/form-data">	
	<tr class="article_top" style="color:white; font-size:20px;">	
	

	<td>
	<strong><label for="jour_debut">Debut jour: </label></strong>
	<input type="text" class="w8em format-y-m-d divider-dash highlight-days-12 range-low-1960-02-13 no-transparency" id="sd" name="jour_debut" maxlength="10" value=""/>
	<strong><label for="heure_debut">heure: </label></strong>
	<input type="text" name="heure_debut" maxlength="5" value="<?php echo $heure_debut; ?>"/>
	</td>
	
	<td>
	<strong>Fin jour:</strong>
	<input type="text" class="w8em format-y-m-d divider-dash highlight-days-12 range-low-1960-02-13 no-transparency" id="ed" name="jour_fin" maxlength="10" value=""/>	
	<strong>heure: </strong>
	<input type="text" name="heure_fin" maxlength="5" value="<?php echo $heure_fin; ?>"/>
	</td>

	<td colspan=2><strong> titre: </strong><input type="text" name="titre" value="<?php echo $donnees['titre'];?>"/></td>
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
	<td>Image: <input type="file" name="image" /></td>
	<td>alt: <input type="text" name="alt" value="<?php echo $donnees['alt'];?>"/></td>
	</tr>
	</table>
	
	
	Description de la photo:
	<br/>
	<textarea name="description_de_l_image" id="description_textarea"><?php echo $donnees['description_de_l_image'];?> </textarea>
	
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
	<br/>
	<textarea name="article" id="article_textarea" style="float:left;"><?php echo $donnees['article'];?></textarea>
	

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

<table>

<tr><td>Lien relatif: </td><td><input type="text" name="tag" value="<?php echo 'news_article.php?article_id=' . $donnees['id'];?>" size="10"/></td></tr>
	
	<tr><td><h3>Style:</h3></td></tr>
	
	<tr>
	<td>Avec photo?</td>
	<td>
	<select name="afficher" >
    	<option value="<?php echo $donnees['afficher'];?>">
	<?php $afficher=$donnees['afficher'] ;	
	if($afficher=='news')
	{ echo 'sans photo'; } 	
	if($afficher=='article')
	{ echo 'avec photo'; } ?></option>
    	<option value=""></option>
    	<option value="news">sans photo</option>
    	<option value="article">avec photo</option>
	</select>
	</td>	
	</tr>

	<tr>
	<td>Modele:</td>
	<td>
	<select name="style" >
    	<option value="<?php echo $donnees['style'];?>">
	<?php  echo $donnees['style']; ?></option>
    	<option value="complet">Complet</option>
    	<option value="aucun_style">aucun style</option>
	</select>
	</td>
	</tr>
	
</table>	
	<br/>	
		
	

<h3>Categories d'utilisateurs</h3>	
<table>
<?php 
$id_utilisateur=$_SESSION['id_utilisateur'];
$statut_administratif_de_l_utilisateur=$_SESSION['autorisation'];

mysql_connect("$type_hote_base_de_donnee", "$Utilisateur_base_de_donnee", "$Code_base_de_donnee"); 
mysql_select_db("$Nom_base_de_donnee"); 


/* #1 -Mise en tableau des id des categories d'utilisateurs accessibles a l'utilisateur */
$categorie_d_utilisateurs_accessibles_du_connecte = array();

if($statut_administratif_de_l_utilisateur!='superadministrateur')
{
$reponse_categories_d_utilisateurs_accessibles_a_l_utilisateur_pour_ecriture = mysql_query("SELECT categorie FROM categorie_des_utilisateurs_J_utilisateurs WHERE utilisateurs='$id_utilisateur'");
while ($donnees_categories_d_utilisateurs_accessibles_a_l_utilisateur_pour_ecriture = mysql_fetch_array($reponse_categories_d_utilisateurs_accessibles_a_l_utilisateur_pour_ecriture) )
{
$categories_d_utilisateurs_accessibles_a_l_utilisateur_pour_ecriture[] = $donnees_categories_d_utilisateurs_accessibles_a_l_utilisateur_pour_ecriture['categorie'];
}
}

else
{
$reponse_categories_d_utilisateurs_accessibles_a_l_utilisateur_pour_ecriture = mysql_query("SELECT id FROM categorie_des_utilisateurs");
while ($donnees_categories_d_utilisateurs_accessibles_a_l_utilisateur_pour_ecriture = mysql_fetch_array($reponse_categories_d_utilisateurs_accessibles_a_l_utilisateur_pour_ecriture) )
{
$categories_d_utilisateurs_accessibles_a_l_utilisateur_pour_ecriture[] = $donnees_categories_d_utilisateurs_accessibles_a_l_utilisateur_pour_ecriture['id'];
}
}

$String_categories_d_utilisateurs_accessibles_a_l_utilisateur_pour_ecriture=implode(",", $categories_d_utilisateurs_accessibles_a_l_utilisateur_pour_ecriture);

/* #1 -fin */


/* #2 -Mise en tableau des id des categories d'utilisateurs dont l'utilisateur est membre */
$array_categories_d_utilisateurs_selectionnes = array();
mysql_connect("$type_hote_base_de_donnee", "$Utilisateur_base_de_donnee", "$Code_base_de_donnee"); 
mysql_select_db("$Nom_base_de_donnee"); 
$reponse_categories_selectionnes = mysql_query("SELECT categorie_des_utilisateurs FROM categorie_des_utilisateurs_J_applications WHERE id_application='$article_id' AND table_application='articles' AND categorie_des_utilisateurs IN ($String_categories_d_utilisateurs_accessibles_a_l_utilisateur_pour_ecriture)");
while ($donnees_categories_selectionnes = mysql_fetch_array($reponse_categories_selectionnes) )
{
$array_categories_d_utilisateurs_selectionnes[] = $donnees_categories_selectionnes['categorie_des_utilisateurs'];
}
/* #2 -fin */


/* #3 -formulaire de modification des droits d'ecriture pour les categories d'utilisateurs */
mysql_connect("$type_hote_base_de_donnee", "$Utilisateur_base_de_donnee", "$Code_base_de_donnee"); 
mysql_select_db("$Nom_base_de_donnee"); 
$reponse_categories_d_utilisateurs_pour_formulaire = mysql_query("SELECT * FROM categorie_des_utilisateurs WHERE id IN ($String_categories_d_utilisateurs_accessibles_a_l_utilisateur_pour_ecriture)");
while ($donnees_categories_d_utilisateurs_pour_formulaire = mysql_fetch_array($reponse_categories_d_utilisateurs_pour_formulaire) )
{ ?>
<tr>
<td><input type="checkbox" name="categorie_d_utilisateur[]" value="<?php echo $donnees_categories_d_utilisateurs_pour_formulaire['id'];?>"

<?php 
$id_categorie_des_uilisateurs=$donnees_categories_d_utilisateurs_pour_formulaire['id'];
 if (in_array("$id_categorie_des_uilisateurs", $array_categories_d_utilisateurs_selectionnes))
{ echo 'checked="checked"'; } ?> 
/></td>
<td><label for="categorie_d_utilisateur[]"><?php echo $donnees_categories_d_utilisateurs_pour_formulaire['nom_de_la_categorie'];?></label></td>
</tr>
<?php 
} 
/* #3 -fin */ 
?>
<input type="hidden" name="categories_d_utilisateurs_complet" value="<?php echo $String_categories_d_utilisateurs_accessibles_a_l_utilisateur_pour_ecriture; ?>" />
</table>	




<br/>	
<a href="Gestion_categories_des_applications.php">Gestion des cat&#233;gories existantes</a>

</div>

<br/>







<h3>Cat&#233;gories pour l'article</h3>	

<table>
<?php 
mysql_connect("$type_hote_base_de_donnee", "$Utilisateur_base_de_donnee", "$Code_base_de_donnee"); 
mysql_select_db("$Nom_base_de_donnee"); 
$reponse_2 = mysql_query("SELECT categorie FROM categories_des_applications_J_applications WHERE id_application='$article_id' AND nom_de_table_de_l_application='$table_application'");
$categories_de_l_article = array();
while($donnes_2 = mysql_fetch_array($reponse_2))
{
    $categories_de_l_article[] = $donnes_2['categorie'];
}


$reponse_Categorie_des_articles = mysql_query("SELECT * FROM categories_des_applications");
while ($donnees_Categorie_des_articles = mysql_fetch_array($reponse_Categorie_des_articles) )
{ ?>
<tr>
<td><input type="checkbox" name="categorie_des_articles[]" value="<?php echo $donnees_Categorie_des_articles['id'];?>" 

<?php 
$id_de_Categorie_des_articles=$donnees_Categorie_des_articles['id'];
if(isset($categories_de_l_article) and $categories_de_l_article!='')
{ if (in_array("$id_de_Categorie_des_articles", $categories_de_l_article))
{ echo 'checked="checked"'; }}?> /></td>
<td><label for="categorie_des_articles[]"><?php echo $donnees_Categorie_des_articles['categorie'];?></label></td>
</tr>
<?php } ?>
</table>	

<br/>	
<a href="Gestion_categories_des_applications.php">Gestion des cat&#233;gories existantes</a>

<td>
</tr>	
</table>

</td>


</tr>
</table>
	
		
	</td>
	</tr>
	<tr class="article_header">
	<td class="article_header_auteur" >auteur(e): <input type="text" name="auteure" value="<?php echo $donnees['auteure'];?>"/></td>
	<td class="article_header_source" >source: <input type="text" name="source" value="<?php echo $donnees['source'];?>"/></td>
	


<?php } ?> 
	<td>
	<input type="hidden" name="article_id" value="<?php echo $article_id; ?>" />
	<input type="hidden" name="Applications_en_include_modifier_table" value="articles" />
	<input type="hidden" name="Applications_en_include_modifier_id" value="<?php echo $article_id; ?>" />
	<input type="submit" name="articles_modifier" value="Enregistrer" />
	</form>
	<a href="archives.php">anuler</a>
	</td>
	</tr>
	</table>
	</CENTER>
	</table>
	

<?php 
 mysql_close();
} ?> 