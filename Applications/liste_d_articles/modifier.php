<?php
$table_de_l_application='liste_d_articles';

if(isset($_POST['modifier_liste_d_article']) AND $_POST['modifier_liste_d_article']!='' )
{ 
$liste_d_articles_id=$_POST['modifier_liste_d_article'];

mysql_connect("$type_hote_base_de_donnee", "$Utilisateur_base_de_donnee", "$Code_base_de_donnee"); 
mysql_select_db("$Nom_base_de_donnee");
$reponse = mysql_query("SELECT * FROM liste_d_articles WHERE id='$liste_d_articles_id'");
while ($donnees = mysql_fetch_array($reponse) )
{ ?>
<center> <h3>Modifier le mur d'articles</h3> </center>


<table>
<form action="<?php echo $_SESSION['administration_adresse_de_la_derniere_page_avec_variables']; ?>" method="post">
<tr><td>Titre de la liste d'articles: </td><td> <input type="text" name="titre_de_la_liste_d_articles" value="<?php echo $donnees['titre_de_la_liste_d_articles']; ?>" /></td></tr>
<tr><td>Nom de la liste d'articles dans la section administration: </td><td><input type="text" name="nom_de_la_liste_d_articles_administration" value="<?php echo $donnees['nom_de_la_liste_d_articles_administration']; ?>" /></td></tr>

<tr><td colspan="2">Afficher toutes les articles de toutes les cat&#233;gories: <input type="checkbox" name="afficher_toutes_les_categories" 
<?php if($donnees['afficher_toutes_les_categories']=='on')
{ ?>
checked="checked"
<?php } ?>
 /><td></tr>
</table>




<h3>Cat&#233;gories des articles</h3>
<div style="height:150px; width:300px;; overflow:auto;">


<table>

<tr>
<td>Nom</td>
<td>Inclure</td>
<td>Exclure</td>
<td>Rien</td>
</tr>

<?php 
$array_id_categories_des_articles = array();
$array_categorie_inclure = array();
$array_categorie_exclure = array();

mysql_connect("$type_hote_base_de_donnee", "$Utilisateur_base_de_donnee", "$Code_base_de_donnee"); 
mysql_select_db("$Nom_base_de_donnee"); 

$reponse_array_categorie_inclure = mysql_query("SELECT * FROM applications_J_inclure_categories WHERE id_application='$liste_d_articles_id' AND nom_de_table_de_l_application='$table_de_l_application'");
while($donnees_array_categorie_inclure = mysql_fetch_array($reponse_array_categorie_inclure) )
{ 
$array_categorie_inclure[] = $donnees_array_categorie_inclure['id_categorie'];
}

$reponse_array_categorie_exclure = mysql_query("SELECT * FROM applications_J_exclure_categories WHERE id_application='$liste_d_articles_id' AND nom_de_table_de_l_application='$table_de_l_application'");
while($donnees_array_categorie_exclure = mysql_fetch_array($reponse_array_categorie_exclure ) )
{ 
$array_categorie_exclure[] = $donnees_array_categorie_exclure['id_categorie'];
}

$reponse_Categorie_d_articles = mysql_query("SELECT * FROM categories_des_applications");
while ($donnees_Categorie_d_articles = mysql_fetch_array($reponse_Categorie_d_articles) )
{ 
$array_id_categories_des_articles[] = $donnees_Categorie_d_articles['id'];
$id_Categorie_d_articles=$donnees_Categorie_d_articles['id'];
?>
<tr>
<td> <label for="Categorie_d_articles[]"><?php echo $donnees_Categorie_d_articles['categorie'];?></label> </td>
<td> <input type="radio" name="<?php echo $donnees_Categorie_d_articles['id'];?>" value="inclure"
<?php
if (in_array($id_Categorie_d_articles, $array_categorie_inclure, true))
{?>
checked="checked"
<?php } ?> 
/> </td>
<td> <input type="radio" name="<?php echo $donnees_Categorie_d_articles['id'];?>" value="exclure" 
<?php
if (in_array($id_Categorie_d_articles, $array_categorie_exclure, true))
{?>
checked="checked"
<?php } ?> 
/> </td>
<td> <input type="radio" name="<?php echo $donnees_Categorie_d_articles['id'];?>" value="rien" 
<?php
if (in_array($id_Categorie_d_articles, $array_categorie_inclure, true) or in_array($id_Categorie_d_articles, $array_categorie_exclure, true))
{} 
else
{?>
checked="checked"
<?php } ?> 
/> </td>


</tr>
<?php } ?>

</table>
</div>

Trier les articles selon le ou la
<select name="champ_de_tri">


    <option value="<?php echo $donnees['champ_de_tri']; ?>"><?php echo $donnees['champ_de_tri']; ?></option>
    <option value="date">date</option>
    <option value="titre">titre</option>
</select>

en ordre
<?php 

if($ordre_de_tri=$donnees['ordre_de_tri']=='DESC')
{ 
$ordre_de_tri_texte='d&#233;croissant';
} 
if($ordre_de_tri=$donnees['ordre_de_tri']=='ASC')
{ 
$ordre_de_tri_texte='croissant';
} 
?>
<select name="ordre_de_tri">
    <option value="<?php echo $donnees['ordre_de_tri']; ?>"><?php echo $ordre_de_tri_texte; ?></option>
    <option value="ASC">croissant</option>
    <option value="DESC">d&#233;croissant</option>
</select>

<select name="rapport_avec_la_date_actuelle">
    <option value="<?php echo $donnees['rapport_avec_la_date_actuelle']; ?>"><?php echo $donnees['rapport_avec_la_date_actuelle']; ?></option>
    <option value="sans importance">sans importance</option>
    <option value="avant">avant</option>
    <option value="apres">apr&#232;s</option>
</select>
par rapport &#224; la date actuelle.
<br/><br/>
<input  name='tableau' type='hidden' value='",implode("|",$tableau),"'>
<input type="hidden" name="modifier_liste_d_articles" value="<?php echo $liste_d_articles_id; ?>" />
<input type="hidden" name="array_id_categories_des_articles" value="<?php echo implode("|",$array_id_categories_des_articles); ?>" />
<input type="submit" name="soumettre" value="Enregistrer la modification de la liste d'articles" />

</form>

<?php
}

}
?>	