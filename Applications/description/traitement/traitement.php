<?php
if(isset($_POST['Modifier_description']) and $_POST['Modifier_description']!='')
{ 
include("Applications/description/traitement/modifier.php");
}

if(isset($_POST['Supprimer_description']) and ($_POST['Supprimer_description']!=''))
{
include("Applications/description/traitement/supprimer.php");
}

if(isset($_POST['Nouvelle_decription']) and ($_POST['Nouvelle_decription']=='valider'))
{
include("Applications/description/traitement/nouveau.php");
}
?>