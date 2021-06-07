<?php
mysql_connect("$type_hote_base_de_donnee", "$Utilisateur_base_de_donnee", "$Code_base_de_donnee"); 
mysql_select_db("$Nom_base_de_donnee"); 

if(isset($_POST['formulaire_modifier_inscription_email']) AND $_POST['formulaire_modifier_inscription_email']!='')
{ 
$id_inscription_email=$_POST['formulaire_modifier_inscription_email'];
$reponse = mysql_query("SELECT * FROM inscription_email WHERE id='$id_inscription_email'");
while ($donnees = mysql_fetch_array($reponse) )
{ ?>

<table>
<form action="contenu_d_application_gestion.php?table_gestion=email" method="post" enctype="multipart/form-data">

<tr>
<td>destinataire final </td>
<td><input type="text" name="destinataire_final" value="<?php echo $donnees['destinataire_final'];?>"/></td>
</tr>

<tr>
<td>Sujet: </td>
<td><input type="text" name="sujet" value="<?php echo $donnees['sujet']; ?>" /></td>
</tr>

<tr>
<td>Sujet final: </td>
<td><input type="text" name="sujet_final" value="<?php echo $donnees['sujet_final']; ?>"/></td>
</tr>

<tr>
<td>Objet inscription: </td>
<td><input type="text" name="objet_inscription" value="<?php echo $donnees['objet_inscription']; ?>" /></td>
</tr>

<tr>
<td>webmaster: </td>
<td><input type="text" name="webmaster" value="<?php echo $donnees['webmaster']; ?>"/></td>
</tr>

<tr>
<input type="hidden" name="modifier_inscription_email" value="<?php echo $donnees['id']; ?>"/>
<td colspan="2"><input type="submit" name="bouton" value="Enregistrer la modification" /></td>
</tr>

</form>
</table>

<?php } 
} 



mysql_close();
?>