<?php
if(isset($_POST['Supprimer_page']) and $_POST['Supprimer_page']!='')
{
$supprimer_page=$_POST['Supprimer_page'];
mysql_connect("$type_hote_base_de_donnee", "$Utilisateur_base_de_donnee", "$Code_base_de_donnee"); 
mysql_select_db("$Nom_base_de_donnee"); 
mysql_query("DELETE FROM Applications_des_pages WHERE id_de_la_page='$supprimer_page'");
mysql_query("DELETE FROM pages WHERE id='$supprimer_page'");
mysql_close();
$adresse_page=$supprimer_page . '.php';
}

if(isset($_POST['Nouvelle_page']) and $_POST['Nouvelle_page']=='valider')
{
$Nom_de_la_page = $_POST['Nom_de_la_page'];
$Tags = $_POST['Tags'];

mysql_connect("$type_hote_base_de_donnee", "$Utilisateur_base_de_donnee", "$Code_base_de_donnee"); 
mysql_select_db("$Nom_base_de_donnee"); 
mysql_query("INSERT INTO pages VALUES('', '$Nom_de_la_page', '$Tags')");
mysql_close();
}


mysql_connect("$type_hote_base_de_donnee", "$Utilisateur_base_de_donnee", "$Code_base_de_donnee"); 
mysql_select_db("$Nom_base_de_donnee"); 
$reponse = mysql_query("SELECT * FROM pages ORDER BY id DESC");
?>
<table style="background-color:#ececec; border:4px double black;"> 
<?php
while ($donnees = mysql_fetch_array($reponse) )
{ ?>

<tr>


<td>
<a href="<?php echo 'page.php?page_numero=' . $donnees['id']; ?>" ><strong><?php echo $donnees['Nom_de_la_page'] . ' '; ?></strong></a>
</td>

<td>
<form action="contenu_d_application_modifier.php?table_modifier=pages" method="post">
<input type="hidden" name="Modifier_page" value="<?php echo $donnees['id']; ?>" />
<input type="submit" name="Mod" value="Modifier" />
</form>
</td>

<td>
<form action="contenu_d_application_gestion.php?table_gestion=pages" method="post">
<input type="hidden" name="Supprimer_page" value="<?php echo $donnees['id']; ?>" />
<input type="submit" name="Sup" value="Supprimer" />
</form>
</td>


</tr>

<?php } ?> 
</table> 

<?php
mysql_close();
?>
		
<?php include("Applications/pages/nouveau.php") ?>