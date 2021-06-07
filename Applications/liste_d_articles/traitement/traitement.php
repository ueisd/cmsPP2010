<?php
if(isset($_POST['nouvelle_liste_d_articles']) and ($_POST['nouvelle_liste_d_articles']=='ok'))
{
include("Applications/liste_d_articles/traitement/nouveau.php");
}

if(isset($_POST['modifier_liste_d_articles']) and ($_POST['modifier_liste_d_articles']!=''))
{
include("Applications/liste_d_articles/traitement/modifier.php");
}

if(isset($_POST['supprimer_liste_d_articles']) and ($_POST['supprimer_liste_d_articles']!=''))
{
include("Applications/liste_d_articles/traitement/supprimer.php");
}
?>