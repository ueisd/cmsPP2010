<?php
if(isset($_POST['nouvelle_image_poste']) and ($_POST['nouvelle_image_poste']=='ok'))
{
include("Applications/categorie_poste/poste/traitement/nouveau.php");
}

if(isset($_POST['modifier_image']) and ($_POST['modifier_image']=='enregistrer'))
{
include("Applications/categorie_poste/poste/traitement/modifier.php");
}

if(isset($_POST['suprimer_image']) and ($_POST['suprimer_image']!=''))
{
include("Applications/categorie_poste/poste/traitement/supprimer.php");
}
?>