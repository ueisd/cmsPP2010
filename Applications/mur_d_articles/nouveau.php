<center> <h3>Nouveau mur d'articles</h3> </center>


<table>
<form action="<?php echo $_SESSION['administration_adresse_de_la_derniere_page_avec_variables']; ?>" method="post">
<tr><td>Titre du mur d'articles: </td><td> <input type="text" name="titre_du_mur_d_articles" /></td></tr>
<tr><td>Nom du mur d'articles dans la section administration: </td><td><input type="text" name="nom_du_mur_d_articles_administration" /></td></tr>
<tr><td>Nombre d'articles par pages du mur: </td><td><input type="text" name="nombre_d_articles_par_pages" value="1" /></td></tr>

<tr><td colspan="2">Afficher toutes les articles de toutes les cat&#233;gories: <input type="checkbox" name="afficher_toutes_les_categories" /><td></tr>
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

mysql_connect("$type_hote_base_de_donnee", "$Utilisateur_base_de_donnee", "$Code_base_de_donnee"); 
mysql_select_db("$Nom_base_de_donnee"); 
$reponse_Categorie_d_articles = mysql_query("SELECT * FROM categories_des_applications");
while ($donnees_Categorie_d_articles = mysql_fetch_array($reponse_Categorie_d_articles) )
{ 
$array_id_categories_des_articles[] = $donnees_Categorie_d_articles['id'];
?>
<tr>
<td> <label for="Categorie_d_articles[]"><?php echo $donnees_Categorie_d_articles['categorie'];?></label> </td>
<td> <input type="radio" name="<?php echo $donnees_Categorie_d_articles['id'];?>" value="inclure" /> </td>
<td> <input type="radio" name="<?php echo $donnees_Categorie_d_articles['id'];?>" value="exclure" /> </td>
<td> <input type="radio" name="<?php echo $donnees_Categorie_d_articles['id'];?>" value="rien" checked="checked" /> </td>


</tr>
<?php } ?>

</table>
</div>

Trier les articles selon le ou la
<select name="champ_de_tri">
    <option value="date">date</option>
    <option value="titre">titre</option>
</select>

en ordre
<select name="ordre_de_tri">
    <option value="ASC">croissant</option>
    <option value="DESC">d&#233;croissant</option>
</select>

<select name="rapport_avec_la_date_actuelle">
    <option value="sans importance">sans importance</option>
    <option value="avant">avant</option>
    <option value="apres">apr&#232;s</option>
</select>
par rapport &#224; la date actuelle.
<br/><br/>
<input  name='tableau' type='hidden' value='",implode("|",$tableau),"'>
<input type="hidden" name="nouveau_mur_d_articles" value="ok" />
<input type="hidden" name="array_id_categories_des_articles" value="<?php echo implode("|",$array_id_categories_des_articles); ?>" />
<input type="submit" name="soumettre" value="Enregistrer le nouveau mur d'articles" />

</form>