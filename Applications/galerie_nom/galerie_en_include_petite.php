<?php 
session_start(); 
include("noyau/configuration/base_de_donnee.php");

if(isset($_SESSION['autorisation']))
{
$table_categories_acessibles_table='galerie_nom';
$id_table_categories_acessibles_table=$galerie_id;
include("noyau/Applications/categorie_d_utilisateurs/acces/acces_par_categorie_d_utilisateurs.php");
}
$adresse_de_la_derniere_page_avec_variables=$_SESSION['adresse_de_la_derniere_page_avec_variables'];

if(isset($_SESSION['autorisation']) and(((($_SESSION['autorisation'])=='administrateur') and isset($Gestion_acessible) and $Gestion_acessible=='ok') or (($_SESSION['autorisation'])=='superadministrateur')) and(($_GET['visite'])!='fin'))
{ 
?>
	
<?php
$galerie_nom=$_POST['galerie_nom'];

include("Applications/galerie_nom/galerie/traitement/traitement.php");

} ?>


<script type="text/javascript">
function displayPics() 
{ 
    var photos = document.getElementById('galerie_mini') ; 
    // On r&#233;cup&#232;re l'&#233;l&#233;ment ayant pour id galerie_mini 
    var liens = photos.getElementsByTagName('a') ; 
    // On r&#233;cup&#232;re dans une variable tous les liens contenu dans galerie_mini 
    var big_photo = document.getElementById('big_pict') ; 
    // Ici c'est l'&#233;l&#233;ment ayant pour id big_pict qui est r&#233;cup&#233;r&#233;, c'est notre photo en taille normale 
 
    var titre_photo = document.getElementById('photo').getElementsByTagName('dt')[0] ; 
    // Et enfin le titre de la photo de taille normale 
 
    // Une boucle parcourant l'ensemble des liens contenu dans galerie_mini 
    for (var i = 0 ; i < liens.length ; ++i) { 
        // Au clique sur ces liens  
        liens[i].onclick = function() { 
            big_photo.src = this.href; // On change l'attribut src de l'image en le rempla&#231;ant par la valeur du lien 
            big_photo.alt = this.title; // On change son titre 
            titre_photo.firstChild.nodeValue = this.title; // On change le texte de titre de la photo 
            return false; // Et pour finir on inhibe l'action r&#233;elle du lien 
        }; 
    } 
} 
window.onload = displayPics; 
// Il ne reste plus qu'&#224; appeler notre fonction au chargement de la page      
</script>


<style type="text/css">
div#special
{ 
    width:100%;
}
div#galerie 
{ 
    background: #eed ; 
    border: 1px solid #dcb ; 
    padding: 15px ; 
    margin: 15px 30px ;
    text-align: center ; 
    font: 0.9em Georgia, serif ;
    float:left;
} 
 
ul#galerie_mini 
{ 
    margin: 0 ; 
    padding: 0 ; 
    list-style-type: none ; 
    width: 230px ;
    height: 500px ;
    overflow: auto ;
} 
 
ul#galerie_mini li 
{ 
    float: left ; 
} 
 
ul#galerie_mini li a img 
{ 
    margin: 2px 1px ; 
    border: 1px solid #dcb ;
    width: 100px; 
} 
 
dl#photo 
{ 
    clear: both ; 
    margin: 0 auto ;
    float:right;
} 
 
dl#photo dt 
{ 
    font: italic 2.5em/1.5em Georgia, serif ; 
    color: #dcb ; 
} 
 
dl#photo dd 
{ 
    margin: 0 ; 
} 
 
dl#photo img 
{ 
    border: 1px solid #dcb ; 
} 
#special
{   
    overflow:auto;
}
</style>
<div id="special">
 
<div id="galerie"> 

<?php  
mysql_connect("$type_hote_base_de_donnee", "$Utilisateur_base_de_donnee", "$Code_base_de_donnee"); 
mysql_select_db("$Nom_base_de_donnee"); 
$reponse = mysql_query("SELECT * FROM galerie_nom WHERE id='$galerie_id' ORDER BY id LIMIT 0,1");
mysql_close();
while ($donnees = mysql_fetch_array($reponse) )
{ 
$galerie_nom = $donnees['nom_galerie']; 
} 

if($galerie_nom!='')
{

if(isset($_SESSION['autorisation']) and(((($_SESSION['autorisation'])=='administrateur') and isset($Gestion_acessible) and $Gestion_acessible=='ok') or (($_SESSION['autorisation'])=='superadministrateur')) and(($_GET['visite'])!='fin'))
{
?>

<table>
<tr>


<td valign="top">
    <ul id="galerie_mini">  

<?php   
mysql_connect("$type_hote_base_de_donnee", "$Utilisateur_base_de_donnee", "$Code_base_de_donnee"); 
mysql_select_db("$Nom_base_de_donnee"); 
$reponse = mysql_query("SELECT * FROM galerie WHERE galerie='$galerie_id'");
while ($donnees = mysql_fetch_array($reponse) )
{ ?>
<li>
<form action="<?php echo $adresse_de_la_derniere_page_avec_variables; ?>" method="post">
<input type="hidden" name="adresse_galerie" value="<?php echo $adresse_de_la_derniere_page_avec_variables; ?>" />
<input type="hidden" name="galerie" value="<?php echo $galerie; ?>" />
<input type="hidden" name="suprimer_image" value="<?php echo $donnees['id']; ?>" />
<input type="submit" name="supr_image000" value="Suprimer" />
</form> 
<br/>
<a href="image/galerie/<?php echo $donnees['nom_photo']; ?>" title="<?php echo $donnees['titre_photo']; ?>"><img src="image/galerie/<?php echo $donnees['nom_photo']; ?>" alt="<?php echo $donnees['titre_photo']; ?>" /></a></li>
<?php } ?>    
            
    </ul> 
</td>



<td valign="top">
       <dl id="photo">
       <?php   
mysql_connect("$type_hote_base_de_donnee", "$Utilisateur_base_de_donnee", "$Code_base_de_donnee"); 
mysql_select_db("$Nom_base_de_donnee"); 
$reponse = mysql_query("SELECT * FROM galerie WHERE galerie='$galerie_id' ORDER BY id LIMIT 0,1");
mysql_close();
while ($donnees = mysql_fetch_array($reponse) )
{ ?> 
        <dt><?php echo $donnees['titre_photo']; ?></dt> 
        <dd><img id="big_pict" src="image/galerie/<?php echo $donnees['nom_photo']; ?>" alt="<?php echo $donnees['titre_photo']; ?>" />
  
 <?php } ?> 
          
          <br/>
          
          <table style="background-color:#ececec; border:4px double black; text-align:left;">
          
          <tr>
          <td colspan="2">
          <strong>Nouvelle photo pour la galerie <?php echo $galerie_nom; ?></strong>
          </td>
          </tr>
          
          <tr>          
          <td>
          <form action="<?php echo $adresse_de_la_derniere_page_avec_variables; ?>" method="post" enctype="multipart/form-data">
          Image:
          </td>
          
          <td><input type="file" name="image" /></td>
          </tr>
          
          <tr>
          <td>Nouveaux nom de l'image?: </td>
          <td><input type="text" name="nom_photo" /></td>
          </tr>
          
          <tr>       
          <td colspan="2">
          <input type="hidden" name="adresse_galerie" value="<?php echo $adresse_de_la_derniere_page_avec_variables; ?>" />
          <input type="hidden" name="galerie_nom" value="<?php echo $galerie_nom; ?>" />
          <input type="hidden" name="galerie_id" value="<?php echo $galerie_id; ?>" />
          <input type="hidden" name="nouv_image000" value="ok" />
          <input type="submit" name="nouvelle_image" value="Enregister la nouvelle image" />
          </form>
          </td>
          </tr>
          
          <tr>
          <td colspan="2">
          <table style="background-color:#bbbbbb; width:100%;">
          <tr>
          <td><a href="contenu_d_application_gestion.php?table_gestion=galerie_nom" />Gestion des galeries</a></td>
          
          <td><a href="visionneur.php?table_de_l_application=galerie_nom">Toutes nos photos</a></td>
	  </tr>
	  </table>
	  </td>
	  </tr>
	  
	  </table>

	      
        </dd> 
    </dl>
</td>


</tr>
</table>
 
  <?php } 
  
  
  
  
else
{ ?> 

<table>
<tr>


<td valign="top">
    <ul id="galerie_mini">  

<?php   
mysql_connect("$type_hote_base_de_donnee", "$Utilisateur_base_de_donnee", "$Code_base_de_donnee"); 
mysql_select_db("$Nom_base_de_donnee"); 
$reponse = mysql_query("SELECT * FROM galerie WHERE galerie='$galerie_id'");
while ($donnees = mysql_fetch_array($reponse) )
{ ?>
<li><a href="image/galerie/<?php echo $donnees['nom_photo']; ?>" title="<?php echo $donnees['titre_photo']; ?>"><img src="image/galerie/<?php echo $donnees['nom_photo']; ?>" alt="<?php echo $donnees['titre_photo']; ?>" /></a></li>
<?php } ?>    
     
    </ul> 
</td>   
 
 

<td valign="top"> 
       <dl id="photo"> 
 <?php   
mysql_connect("$type_hote_base_de_donnee", "$Utilisateur_base_de_donnee", "$Code_base_de_donnee"); 
mysql_select_db("$Nom_base_de_donnee");  
$reponse = mysql_query("SELECT * FROM galerie WHERE galerie='$galerie_id' ORDER BY id LIMIT 0,1");
mysql_close();
while ($donnees = mysql_fetch_array($reponse) )
{ ?> 
        <dt><?php echo $donnees['titre_photo']; ?></dt> 
        <dd><img id="big_pict" src="image/galerie/<?php echo $donnees['nom_photo']; ?>" alt="<?php echo $donnees['titre_photo']; ?>" />
  
 <?php } ?> 
<br/> Galerie: <?php echo ' ' . $galerie_nom; ?>
<a href="visionneur.php?table_de_l_application=galerie_nom">Toutes nos photos</a>
        </dd> 
    </dl>  
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