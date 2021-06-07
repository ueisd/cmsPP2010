<?php
if(isset($_POST['form_suprimer']) and $_POST['form_suprimer']!='')
{
include("Applications/gestion_des_applications/traitement.php/supprimer.php");
}

if(isset($_POST['Modifier_application']) and $_POST['Modifier_application']!='')
{
include("Applications/gestion_des_applications/traitement.php/modifier.php");
}

if(isset($_POST['Nouvelle_application']) and $_POST['Nouvelle_application']=='valider')
{
include("Applications/gestion_des_applications/traitement.php/nouveau.php");
} 
?>