<?php session_start(); 
include("noyau/configuration/base_de_donnee.php");

if(isset($_SESSION['autorisation']))
{
$table_categories_acessibles_table='categorie_poste';
$id_table_categories_acessibles_table=$type_poste_id;
include("noyau/Applications/categorie_d_utilisateurs/acces/acces_par_categorie_d_utilisateurs.php");
}

$adresse_de_la_derniere_page_avec_variables=$_SESSION['adresse_de_la_derniere_page_avec_variables'];

if(isset($_SESSION['autorisation']) and(((($_SESSION['autorisation'])=='administrateur') and isset($Gestion_acessible) and $Gestion_acessible=='ok') or (($_SESSION['autorisation'])=='superadministrateur')) and(($_GET['visite'])!='fin'))
{
include("Applications/categorie_poste/poste/traitement/traitement.php");
}
?>


<style type="text/css">

#special1
{   
    overflow:auto;
    width:100%;
}
div#galerie1 
{  
    text-align: center ; 
    font: 0.9em Georgia, serif ;
    float:left;
    width:100%;
}
#table_poste
{
	width:100%;
	text-align:center;
}
h1
{
margin-top:0px;
padding-top:0px;
font-size:50px;
color:#cc3300;
}
.cadre_image
{
text-align:center;
width:22%;
}
.nom
{
color:#cc3300;
}
</style>
<div id="special1">
 
<div id="galerie1"> 

<?php  
mysql_connect("$type_hote_base_de_donnee", "$Utilisateur_base_de_donnee", "$Code_base_de_donnee"); 
mysql_select_db("$Nom_base_de_donnee");
$reponse = mysql_query("SELECT * FROM categorie_poste WHERE id='$type_poste_id' ORDER BY id LIMIT 0,1");
mysql_close();
while ($donnees = mysql_fetch_array($reponse) )
{ 
$type_poste = $donnees['id'];
$titre_type_poste = $donnees['categorie_poste'];
} 

if($type_poste!='')
{

if(isset($_SESSION['autorisation']) and(((($_SESSION['autorisation'])=='administrateur') and isset($Gestion_acessible) and $Gestion_acessible=='ok') or (($_SESSION['autorisation'])=='superadministrateur')) and(($_GET['visite'])!='fin'))
{ 
?>
     
<table border="0" cellspacing="0" cellpadding="2" width="100%" id="table_poste">
						<font style="FONT-FAMILY: Georgia" color="#cc3300" size="6">
						<tr><td colspan="7">
						<h1><?php echo $titre_type_poste; ?></h1><br/>	
						</td></tr>
						</font>
           
       <?php   
mysql_connect("$type_hote_base_de_donnee", "$Utilisateur_base_de_donnee", "$Code_base_de_donnee"); 
mysql_select_db("$Nom_base_de_donnee");


$reponse = mysql_query("select count(*) FROM poste WHERE type_poste='$type_poste'");
$row = mysql_fetch_row($reponse);
$nombre_d_entres = $row[0];
$nombre_ligne = ceil($nombre_d_entres/4);

$increm = 0;
while ($increm <= ($nombre_ligne-1))
{

$poste_debut= $increm*4;
?> 
<tr> 
<?php 



$reponse = mysql_query("SELECT * FROM poste WHERE type_poste='$type_poste' ORDER BY id LIMIT $poste_debut,4");
while ($donnees = mysql_fetch_array($reponse) )
{ ?> 

<td class="cadre_image">
 
<center>
<table>

<tr>
<td>
<form action="contenu_d_application_modifier.php?table_modifier=categorie_poste/poste" method="post">
<input type="hidden" name="type_post" value="<?php echo $type_post; ?>" />
<input type="hidden" name="galerie" value="<?php echo $galerie; ?>" />
<input type="hidden" name="adresse_galerie_poste" value="<?php echo $adresse_de_la_derniere_page_avec_variables; ?>" />
<input type="hidden" name="modifier_image" value="<?php echo $donnees['id']; ?>" />
<input type="submit" name="mod_image000" value="Modifier" />
</form> 
</td>
</tr>

<tr>
<td> 
 <form action="<?php echo $adresse_de_la_derniere_page_avec_variables; ?>" method="post">
<input type="hidden" name="type_post" value="<?php echo $type_post; ?>" />
<input type="hidden" name="galerie" value="<?php echo $galerie; ?>" />
<input type="hidden" name="suprimer_image" value="<?php echo $donnees['id']; ?>" />
<input type="submit" name="supr_image000" value="Suprimer" />
</form> 
</td>
</tr>

</table>
</center>

 <img src="<?php echo 'image/poste/' . $donnees['adresse']; ?>"  class="image">
 
 </td>
								 
 <?php } ?>
<br/>  
</tr>
<tr> <?php




$reponse = mysql_query("SELECT * FROM poste WHERE type_poste='$type_poste' ORDER BY id LIMIT $poste_debut,4");
while ($donnees = mysql_fetch_array($reponse) )
{ ?> 

<td valign="top" align=center><font class="nom"><?php echo $donnees['personne']; ?></font><br>
<font class="poste"><?php echo $donnees['poste']; ?></font></td>
								 
 <?php } ?>
<br/> 
</tr>

<tr>
<td colspan="7">
<br/> <br/> <br/> <br/> <br/> <br/>
</td>
</tr>
 
<?php   
$increm++;
}
?>

          
          <br/>
<tr>
<td colspan="7">
        
          <center>
          <table style="text-align:left; background-color:#ececec; border:4px double black;">
          <form action="<?php echo $adresse_de_la_derniere_page_avec_variables; ?>" method="post"  enctype="multipart/form-data">
          
          <tr>
          <td colspan="2">
          <center><span><strong>Nouveau Poste<strong></span></center>
          </td>
          </tr>
         
          <tr>
          <td>Image: </td><td><input type="file" name="image_poste" /></td>
          </tr>
          
          <tr>
          <td>Personne: </td><td><input type="text" name="nom_personne" /></td>
          </tr>
          
          <tr>
          <td>Poste: </td><td><input type="text" name="nom_poste" /></td>
          </tr>
          
          <tr>
          <td colspan="2">
          <input type="hidden" name="adresse_galerie_poste" value="<?php echo $adresse_de_la_derniere_page_avec_variables; ?>" />
          <input type="hidden" name="galerie_type" value="<?php echo $type_poste; ?>" />
          <input type="hidden" name="nouvelle_image_poste" value="ok" /> <br/>
          <input type="submit" name="nouve_image_poste000" value="Enregistrer le nouveau poste" />
          </td>
          </form>
          
          <tr>
          <td colspan="2">
          <a href="contenu_d_application_gestion.php?table_gestion=categorie_poste">Gestion des cat&eacute;gories des postes </a>
          </td>
          </tr>
          
          <tr>
          <td colspan="2">
          <a href="galerie_poste.php">Tout les postes</a>  
          </td>
          </tr>          
          </table>  
          </center>
       
</td>
</tr>
    
   
 </table>   
  
 
 
 
 
 
  <?php }   
else
{ ?> 


<table border="0" cellspacing="0" cellpadding="2" width="100%" id="table_poste">
						<font style="FONT-FAMILY: Georgia" color="#cc3300" size="6">
						<tr><td colspan="7">
						<h1><?php echo $titre_type_poste; ?></h1><br/>	
						</td></tr>
						</font>
           
       <?php   
mysql_connect("$type_hote_base_de_donnee", "$Utilisateur_base_de_donnee", "$Code_base_de_donnee"); 
mysql_select_db("$Nom_base_de_donnee");


$reponse = mysql_query("select count(*) FROM poste WHERE type_poste='$type_poste'");
$row = mysql_fetch_row($reponse);
$nombre_d_entres = $row[0];
$nombre_ligne = ceil($nombre_d_entres/4);

$increm = 0;
while ($increm <= ($nombre_ligne-1))
{

$poste_debut= $increm*4;
?> 
<tr> 
<?php 



$reponse = mysql_query("SELECT * FROM poste WHERE type_poste='$type_poste' ORDER BY id LIMIT $poste_debut,4");
while ($donnees = mysql_fetch_array($reponse) )
{ ?> 

 <td class="cadre_image">
 
 <img src="<?php echo 'image/poste/' . $donnees['adresse']; ?>"  class="image"></td>
								 
 <?php } ?>
<br/>  
</tr>
<tr> <?php




$reponse = mysql_query("SELECT * FROM poste WHERE type_poste='$type_poste' ORDER BY id LIMIT $poste_debut,4");
while ($donnees = mysql_fetch_array($reponse) )
{ ?> 

<td valign="top" align=center><font class="nom"><?php echo $donnees['personne']; ?></font><br>
<font class="poste"><?php echo $donnees['poste']; ?></font></td>
								 
 <?php } ?>
<br/> 
</tr>

<tr>
<td colspan="7">
<br/> <br/> <br/> <br/> <br/> <br/>
</td>
</tr>
 
<?php   
$increm++;
}
?>

          
          <br/>
          <tr><td colspan="7">
                
</td>
</tr>
    
   
 </table>   
    

<?php } 



} 
else
{
echo 'La galerie photo ayant le id:' . $galerie_id . ' est inexistante!';
} ?>
</div>
</div>  
<?php $Gestion_acessible=''; ?>