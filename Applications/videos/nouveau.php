<?php
if(isset($_SESSION['autorisation']) and(($_SESSION['autorisation'])=='superadministrateur') and(($_GET['visite'])!='fin'))
{ ?>
<table class="video_table">
<form action="application.php?table_de_l_application=videos" method="post" enctype="multipart/form-data"> 
<tr><td>
<input type="file" name="image_video" />
</td></tr>
<tr><td>
<input type="text" name="titre_video" />
</td></tr>
<tr><td>
Source du vid&#233;o:
<select name="type_source_video" >
<option value="natif">natif</option>
<option value="code">code</option>
</select>
</td></tr>
<tr><td>
Code du vid&#233;o:<textarea name="code_du_video"></textarea>
</td></tr>
<tr><td>
Description:<textarea name="description_du_video"></textarea>
</td></tr>
<tr><td>
 <input type="submit" name="nouvelle_video_poste" value="ok" />
</td></tr>
</form>
</table>
<?php } ?>