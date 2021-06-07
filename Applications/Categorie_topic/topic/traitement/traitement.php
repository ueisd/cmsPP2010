<?php
if(isset($_POST['Modifier_topic']) and $_POST['Modifier_topic']!='' and $_POST['id_de_categorie_du_topic']==$id_de_categorie_du_topic_selectionne)
{
include("Applications/Categorie_topic/topic/traitement/modifier.php");
}

if(isset($_POST['Supprimer_topic']) and ($_POST['Supprimer_topic']!='') and $_POST['id_de_categorie_du_topic']==$id_de_categorie_du_topic_selectionne)
{
include("Applications/Categorie_topic/topic/traitement/supprimer.php");
}

if(isset($_POST['Nouveau_topic']) and ($_POST['Nouveau_topic']=='valider') and $_POST['id_de_categorie_du_topic']==$id_de_categorie_du_topic_selectionne)
{
include("Applications/Categorie_topic/topic/traitement/nouveau.php");
}
?>