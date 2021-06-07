<?php
if(isset($_POST['nouvelle_image']) and ($_POST['nouvelle_image']=='ok'))
{
include("Applications/galerie_nom/galerie/traitement/nouveau.php");
}

if(isset($_POST['suprimer_image']) and ($_POST['suprimer_image']!=''))
{
include("Applications/galerie_nom/galerie/traitement/supprimer.php");
}
?>