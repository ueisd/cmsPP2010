<?php
include("Applications/galerie_nom/traitement/traitement.php");
?>



<table style="background-color:#ececec; border:4px double black;">
<?php
mysql_connect("$type_hote_base_de_donnee", "$Utilisateur_base_de_donnee", "$Code_base_de_donnee"); 
mysql_select_db("$Nom_base_de_donnee");  
$reponse = mysql_query("SELECT * FROM galerie_nom");
mysql_close();
while ($donnees = mysql_fetch_array($reponse) )
{ 
$nom_galerie=$donnees['nom_galerie'];
$id_galerie_formulaire=$donnees['id'];
?>
	<tr>
	
	<td><a href="../galerie.php?id=<?php echo $donnees['id'];?>&galerie_choisie=ok"><?php echo $nom_galerie; ?></a></td>
	<td>
	<form action="contenu_d_application_modifier.php?table_modifier=galerie_nom" method="post" enctype="multipart/form-data">
	<input type="hidden" name="id_galerie_modifier" value="<?php echo $id_galerie_formulaire; ?>" />
    	<input type="submit" name="galerie_renomer" value="modifier" />
        </form>
        </td>
        
 	<td>
 	<form action="contenu_d_application_gestion.php?table_gestion=galerie_nom" method="post" enctype="multipart/form-data">
        <input type="hidden" name="galerie_suprimer" value="<?php echo $nom_galerie; ?>" />
        <input type="submit" name="supr_galerie000" value="Suprimer" />
        </form>
        </td>
        
        <td>Le code: </td>
        <td>
        <input type="text" name="id" value="<?php echo '<?php $galerie_id=' . 
          $donnees['id'] . ';' . ' $adresse_galerie=$_SERVER[\'PHP_SELF\'];' . ' include \'galerie_en_include_petite.php\'; ?>'; ?>" />
        </td> 

        </tr>
        
 <?php } ?>
</table>	
	
<?php include("Applications/galerie_nom/nouveau.php"); ?>