<?php
if(isset($_POST['modifier_video_1']) and $_POST['modifier_video_1']!='')
{ 
$id_modifier_video=$_POST['modifier_video_1'];
mysql_connect("$type_hote_base_de_donnee", "$Utilisateur_base_de_donnee", "$Code_base_de_donnee"); 
mysql_select_db("$Nom_base_de_donnee"); 
$reponse = mysql_query("SELECT * FROM videos WHERE id='$id_modifier_video'");
while ($donnees = mysql_fetch_array($reponse) )
{ ?>

<table class="video_table">
<form action="application.php?table_de_l_application=videos" method="post" enctype="multipart/form-data"> 
<tr><td>
<input type="file" name="image_video" />
</td></tr>
<tr><td>
<input type="text" name="titre_video" value="<?php echo $donnees['titre_video']; ?>" />
</td></tr>
<tr><td>
Source du vid&#233;o:
<select name="type_source_video" >
<option value="<?php echo $donnees['type_source_video']; ?>"><?php echo $donnees['type_source_video']; ?></option>
<option value="natif">natif</option>
<option value="code">code</option>
</select>
</td></tr>
<tr><td>
Code du vid&#233;o:<textarea name="code_du_video"><?php echo $donnees['code_du_video']; ?></textarea>
</td></tr>
<tr><td>
Description:<textarea name="description_du_video"><?php echo $donnees['description_du_video']; ?></textarea>
</td></tr>
<tr><td>
Enregistrer la modification: <input type="submit" name="modifier_video_2" value="<?php echo $donnees['id']; ?>" />
</td></tr>
</form>
</table>

<?php } ?>
<?php } ?>