<?php
if(isset($_POST['modifier_calendrier']) and ($_POST['modifier_calendrier']!=''))
{
include("Applications/calendrier/traitement/modifier.php");
}

if(isset($_POST['supprimer_calendrier']) and ($_POST['supprimer_calendrier']!=''))
{
include("Applications/calendrier/traitement/supprimer.php");
}

if(isset($_POST['nouveau_calendrier']) and ($_POST['nouveau_calendrier']=='ok'))
{
include("Applications/calendrier/traitement/nouveau.php");
}
?>