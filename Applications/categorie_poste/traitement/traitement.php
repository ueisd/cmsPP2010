<?php
if(isset($_POST['nouvelle_categorie_poste']))
{ 
include("Applications/categorie_poste/traitement/nouveau.php");
} 

if(isset($_POST['modifier_categorie_poste']))
{ 
include("Applications/categorie_poste/traitement/modifier.php");
} 

if(isset($_POST['supprimer']))
{ 
include("Applications/categorie_poste/traitement/supprimer.php");
} 
?>