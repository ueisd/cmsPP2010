<?php
if(isset($_POST['nouveau_mur_d_articles']) and ($_POST['nouveau_mur_d_articles']=='ok'))
{
include("Applications/mur_d_articles/traitement/nouveau.php");
}

if(isset($_POST['modifier_mur_d_articles']) and ($_POST['modifier_mur_d_articles']!=''))
{
include("Applications/mur_d_articles/traitement/modifier.php");
}

if(isset($_POST['supprimer_mur_d_articles']) and ($_POST['supprimer_mur_d_articles']!=''))
{
include("Applications/mur_d_articles/traitement/supprimer.php");
}
?>