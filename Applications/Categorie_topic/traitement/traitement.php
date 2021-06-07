<?php
if(isset($_POST['Nouvelle_categorie']) and $_POST['Nouvelle_categorie']=='Nouvelle_categorie')
{
include("Applications/Categorie_topic/traitement/nouveau.php");
}

if(isset($_POST['Supprimer_categorie']) and $_POST['Supprimer_categorie']!='')
{
include("Applications/Categorie_topic/traitement/supprimer.php");
}

if(isset($_POST['Modifier_categorie']) and $_POST['Modifier_categorie']!='')
{
include("Applications/Categorie_topic/traitement/modifier.php");
}
?>