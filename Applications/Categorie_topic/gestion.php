<?php
$categories_acessibles_connecte=$_SESSION['categorie_du_connecte'];

$_SESSION['administration_adresse_de_la_derniere_page_avec_variables']=$_SERVER['REQUEST_URI'];

if(isset($_SESSION['autorisation']) and((($_SESSION['autorisation'])=='administrateur') or (($_SESSION['autorisation'])=='superadministrateur')) and(($_GET['visite'])!='fin'))
{


include("Applications/Categorie_topic/traitement/traitement.php");
?>
	

<br/>Les cat&#233;gories:<br/>


<table>

<?php
mysql_connect("$type_hote_base_de_donnee", "$Utilisateur_base_de_donnee", "$Code_base_de_donnee"); 
mysql_select_db("$Nom_base_de_donnee"); 


$categories_acessibles_connecte = $_SESSION['categorie_du_connecte'];
$array_id_categorie_toute=array('1');
$categories_acessibles_connecte_moin_array_id_categorie_toute=array_diff($categories_acessibles_connecte, $array_id_categorie_toute);

if(($categories_acessibles_connecte_moin_array_id_categorie_toute!=$categories_acessibles_connecte) or (isset($_SESSION['autorisation']) and ($_SESSION['autorisation']=='superadministrateur') and ($_GET['visite']!='fin')))
{
$reponse = mysql_query("SELECT * FROM Categorie_topic");
}
else
{
$reponse = mysql_query("SELECT * FROM Categorie_topic WHERE Categorie_des_utilisateurs IN (".implode(',', $categories_acessibles_connecte).")");
}


mysql_close();
while ($donnees = mysql_fetch_array($reponse) )
{ ?>
<tr>
<td><?php echo $donnees['nom_de_categorie']; ?></td>

<td>
<form action="contenu_d_application_modifier.php?table_modifier=Categorie_topic" method="post">
<input type="hidden" name="Modifier_categorie" value="<?php echo $donnees['id']; ?>" />
<input type="submit" name="Mod_bouton" value="Modifier" />
</form>
</td>

<td>
<form action="contenu_d_application_gestion.php?table_gestion=Categorie_topic" method="post">
<input type="hidden" name="Supprimer_categorie" value="<?php echo $donnees['id']; ?>" />
<input type="submit" name="supr_bouton" value="Suprimer" />
</form>
</td>

<td>zone de texte: <?php echo $donnees['id']; ?></td>

<td>
Code en noir:
<input type="text" name="code" value="<?php echo '<?php $id_de_categorie_du_topic_selectionne=' . 
$donnees['id'] . ';' . ' $adresse_topic_en_include=$_SERVER[\'PHP_SELF\'];' . ' $afficher_titre=\'noir\'; include \'Topic_en_include.php\'; ?>'; ?>" />
</td>
<td>
Code avec en rouge:
<input type="text" name="code" value="<?php echo '<?php $id_de_categorie_du_topic_selectionne=' . 
$donnees['id'] . ';' . ' $adresse_topic_en_include=$_SERVER[\'PHP_SELF\'];' . ' $afficher_titre=\'rouge\'; include \'Topic_en_include.php\'; ?>'; ?>" />
</td>
<td>
Code sans titre:
<input type="text" name="code" value="<?php echo '<?php $id_de_categorie_du_topic_selectionne=' . 
$donnees['id'] . ';' . ' $adresse_topic_en_include=$_SERVER[\'PHP_SELF\']; . include \'Topic_en_include.php\'; ?>'; ?>" />
</td>
</tr>
<?php } ?>


</table>


<?php include("Applications/Categorie_topic/nouveau.php"); ?>

<?php } ?>