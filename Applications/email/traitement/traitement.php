<?php
if(isset($_POST['supprimer_inscription_email']) AND $_POST['supprimer_inscription_email']!='')
{ 
include("Applications/email/traitement/supprimer.php");
}
	
if(isset($_POST['nouveau_inscription_email']) AND $_POST['nouveau_inscription_email']=='Enregistrer')
{
include("Applications/email/traitement/nouveau.php");
} 

if(isset($_POST['modifier_inscription_email']) AND $_POST['modifier_inscription_email']!='')
{
include("Applications/email/traitement/modifier.php");
}
?>