<?php	
if(isset($_POST['modifier_video_2']) and $_POST['modifier_video_2']!='')
{
include("Applications/videos/traitement/modifier.php");
}

if(isset($_POST['supprimer_video']) and $_POST['supprimer_video']!='')
{
include("Applications/videos/traitement/supprimer.php");
}

if(isset($_POST['nouvelle_video_poste']) and $_POST['nouvelle_video_poste']=='ok')
{
include("Applications/videos/traitement/nouveau.php");
}
?>