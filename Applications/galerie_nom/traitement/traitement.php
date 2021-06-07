<?php
if(isset($_POST['nouvelle_galerie']) and ($_POST['nouvelle_galerie']=='ok'))
{
include("Applications/galerie_nom/traitement/nouveau.php");
}

if(isset($_POST['galerie_r']))
{ 
include("Applications/galerie_nom/traitement/modifier.php");
}

if(isset($_POST['galerie_suprimer']))
{ 
include("Applications/galerie_nom/traitement/supprimer.php");
}
?>