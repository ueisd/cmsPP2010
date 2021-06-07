<?php session_start(); 
include("noyau/configuration/base_de_donnee.php");

if(isset($_GET['galerie_choisie']) and ($_GET['galerie_choisie']=='ok'))
{
$galerie_id = $_GET['id'];
}
else
{
mysql_connect("$type_hote_base_de_donnee", "$Utilisateur_base_de_donnee", "$Code_base_de_donnee"); 
mysql_select_db("$Nom_base_de_donnee"); 
$reponse = mysql_query("SELECT * FROM galerie_nom ORDER BY id LIMIT 0,1");
mysql_close();
while ($donnees = mysql_fetch_array($reponse) )
{
$galerie_id = $donnees['id'];
}
}

if(isset($_SESSION['autorisation']))
{
$table_categories_acessibles_table='galerie_nom';
$id_table_categories_acessibles_table=$galerie_id;
include("noyau/Applications/categorie_d_utilisateurs/acces/acces_par_categorie_d_utilisateurs.php");
}
?> 
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" >
	<head>
		<title>Galerie</title>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
		<meta name="keywords" content="">
		<meta name="description" content="">
		<script type="text/javascript" src="noyau/style/csshover.js"></script> 
	</head>
	<body bgcolor="#14285f" link="#9900cc">	
<style type="text/css">
body
{
background-image:url(null);
background-attachment:fixed;  
background-repeat:no-repeat;
background-color:#f0f7f8;
margin:0px;
padding:0px;
text-align:center;
}
#contenu
{
	width:100%;
	position:absolute;
	top:35px; left:0px; 
	margin:0px; padding:0px;
}
</style>
<script type="text/javascript">
function displayPics() 
{ 
    var photos = document.getElementById('galerie_mini') ; 
    // On r�cup�re l'�l�ment ayant pour id galerie_mini 
    var liens = photos.getElementsByTagName('a') ; 
    // On r�cup�re dans une variable tous les liens contenu dans galerie_mini 
    var big_photo = document.getElementById('big_pict') ; 
    // Ici c'est l'�l�ment ayant pour id big_pict qui est r�cup�r�, c'est notre photo en taille normale 
 
    var titre_photo = document.getElementById('photo').getElementsByTagName('dt')[0] ; 
    // Et enfin le titre de la photo de taille normale 
 
    // Une boucle parcourant l'ensemble des liens contenu dans galerie_mini 
    for (var i = 0 ; i < liens.length ; ++i) { 
        // Au clique sur ces liens  
        liens[i].onclick = function() { 
            big_photo.src = this.href; // On change l'attribut src de l'image en le rempla�ant par la valeur du lien 
            big_photo.alt = this.title; // On change son titre 
            titre_photo.firstChild.nodeValue = this.title; // On change le texte de titre de la photo 
            return false; // Et pour finir on inhibe l'action r�elle du lien 
        }; 
    } 
} 
window.onload = displayPics; 
// Il ne reste plus qu'� appeler notre fonction au chargement de la page      
</script>


<style type="text/css">
div#galerie 
{ 
    background: #eed ; 
    border: 1px solid #dcb ; 
    padding: 15px ; 
    margin: 15px 30px ; 
    text-align: center ; 
    font: 0.9em Georgia, serif ; 
    float: left ;
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
    float: right;
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
</style>
<?php include("Applications/entete/entete.php"); ?>


<?php session_start(); 
if(isset($_SESSION['autorisation']) and(((($_SESSION['autorisation'])=='administrateur') and isset($Gestion_acessible) and $Gestion_acessible=='ok') or (($_SESSION['autorisation'])=='superadministrateur')) and(($_GET['visite'])!='fin'))
{ ?>
<?php
$galerie_nom=$_POST['galerie_nom'];
if(isset($_POST['nouvelle_image']) and ($_POST['nouvelle_image']=='ok'))
{


if($_FILES['image']['type']=='image/jpeg')
{
$type_photo='jpg';
}
elseif($_FILES['image']['type']=='image/gif')
{
$type_photo='gif';
}
elseif($_FILES['image']['type']=='image/png')
{
$type_photo='png';
}
elseif($_FILES['image']['type']=='image/bmp')
{
$type_photo='bmp';
}


if(isset($_POST['nom_photo']) and ($_POST['nom_photo']!=''))
{
$titre_photo=$_POST['nom_photo'];
}

else
{
$titre_photo=$_FILES['image']['name'];
}
$galerie_id=$_POST['galerie_id'];
mysql_connect("$type_hote_base_de_donnee", "$Utilisateur_base_de_donnee", "$Code_base_de_donnee"); 
mysql_select_db("$Nom_base_de_donnee"); 
$reponse = mysql_query("SELECT id FROM galerie ORDER BY id DESC LIMIT 0,1");
while ($donnees = mysql_fetch_array($reponse) )
{$image_id=$donnees['id'] + 1;}
$nom_photo=$image_id . '.' . $type_photo;
mysql_query("INSERT INTO galerie VALUES('', '$titre_photo', '$nom_photo', '$galerie_id')");
mysql_close();
$adresse='image/galerie/' . $nom_photo;
$resultat = move_uploaded_file($_FILES['image']['tmp_name'], 'image/galerie/preminiat.jpg' );


$source = imagecreatefromjpeg("image/galerie/preminiat.jpg");

$largeur_source = imagesx($source);
$hauteur_source = imagesy($source);

if($largeur_source >= $hauteur_source)
{
$largeur_nouveaux = '600';
$hauteur_nouveaux = $largeur_nouveaux/$largeur_source*$hauteur_source;
}
else
{
$hauteur_nouveaux = '500';
$largeur_nouveaux = $hauteur_nouveaux/$hauteur_source*$largeur_source;
}

$destination = imagecreatetruecolor($largeur_nouveaux, $hauteur_nouveaux); 
$largeur_destination = imagesx($destination);
$hauteur_destination = imagesy($destination);

imagecopyresampled($destination, $source, 0, 0, 0, 0, $largeur_destination, $hauteur_destination, $largeur_source, $hauteur_source);

imagejpeg($destination, $adresse);

}

if(isset($_POST['suprimer_image']) and ($_POST['suprimer_image']!=''))
{
$id=$_POST['suprimer_image'];
mysql_connect("$type_hote_base_de_donnee", "$Utilisateur_base_de_donnee", "$Code_base_de_donnee"); 
mysql_select_db("$Nom_base_de_donnee"); 

$reponse = mysql_query("SELECT nom_photo FROM galerie WHERE id='$id'");
while ($donnees = mysql_fetch_array($reponse) )
{
$nom_photo=$donnees['nom_photo'];
$image='image/galerie/' . $nom_photo;
}
unlink($image);

mysql_query("DELETE FROM galerie WHERE id='$id'");
mysql_close();
}
?>
<?php } ?>



		<!-- Page Principal-->
	<div id="contenu">


<form action="<?php echo $_SESSION['adresse_visionneur']; ?>" method="post" enctype="multipart/form-data">
Consulter la galerie:
<select name="id" >
<?php
mysql_connect("$type_hote_base_de_donnee", "$Utilisateur_base_de_donnee", "$Code_base_de_donnee"); 
mysql_select_db("$Nom_base_de_donnee"); 
$reponse = mysql_query("SELECT * FROM galerie_nom");
mysql_close();
while ($donnees = mysql_fetch_array($reponse) )
{ ?>
<option value="<?php echo $donnees['id']; ?>"><?php echo $donnees['nom_galerie']; ?></option>
<?php } 

?>
</select>
<input type="submit" name="galerie_choisie" value="ok" />
</form>

		
<div id="galerie"> 
<?php 
if(isset($_POST['galerie_choisie']) and ($_POST['galerie_choisie']=='ok'))
{
$galerie_id = $_POST['id'];
}
else
{
mysql_connect("$type_hote_base_de_donnee", "$Utilisateur_base_de_donnee", "$Code_base_de_donnee"); 
mysql_select_db("$Nom_base_de_donnee"); 
$reponse = mysql_query("SELECT * FROM galerie_nom ORDER BY id LIMIT 0,1");
mysql_close();
while ($donnees = mysql_fetch_array($reponse) )
{
$galerie_id = $donnees['id'];
}
}

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
<form action="<?php echo $_SESSION['adresse_visionneur']; ?>" method="post">
<input type="hidden" name="adresse_galerie" value="<?php echo $_SESSION['adresse_visionneur']; ?>" />
<input type="hidden" name="galerie" value="<?php echo $galerie; ?>" />
<input type="hidden" name="suprimer_image" value="<?php echo $donnees['id']; ?>" />
<input type="submit" name="supr000_image" value="Suprimer" />
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
          
          <table style="background-color:#ececec; border:4px double black; text-align:left;">
          
          <tr>
          <td>
          <form action="<?php echo $_SESSION['adresse_visionneur']; ?>" method="post" enctype="multipart/form-data">
          Image:
          </td>
          <td><input type="file" name="image" /></td>
          </tr>
          
          <tr>
          <td>Nouveaux nom de l'image?:</td>
          <td><input type="text" name="nom_photo" /></td>
          </tr>
          
          <tr>
          <td colspan="2">
          <input type="hidden" name="adresse_galerie" value="<?php echo $_SESSION['adresse_visionneur']; ?>" />
          <input type="hidden" name="galerie_nom" value="<?php echo $galerie_nom; ?>" />
          <input type="hidden" name="galerie_id" value="<?php echo $galerie_id; ?>" />
          <input type="hidden" name="nouvelle_image" value="ok" />
          <input type="hidden" name="galerie_choisie" value="<?echo $galerie_id; ?>" />
          <input type="submit" name="nouv000_image" value="Enregistrer la nouvelle image" />
          </form>
          </td>
          </tr>
          
          <tr>
          <td colspan="2">
          
          <table style="background-color:#bbbbbb; width:100%;">
          <tr>
          <td><a href="contenu_d_application_gestion.php?table_gestion=galerie_nom" />gestion des galeries</a></td>
	  <td>Galerie: <?php echo ' ' . $galerie_nom; ?></td> 
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
       <dl id="photo"> 
       
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
</body>
</html>
<?php $Gestion_acessible=''; ?> 