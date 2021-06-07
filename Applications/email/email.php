<style>
form
{
	margin-left:40px;
}
textarea
{
	width:300px;
	height:150px;
}
</style>

<?php include("Applications/entete/entete.php"); ?> 

<?php

if(isset($_GET['specialid']) and $_GET['specialid']!='')
{ 
$id_inscription_email=$_GET['specialid'];
}

if(isset($_GET['id']))
{ 
$id_inscription_email=$_GET['id'];
}
if(isset($_POST['id']))
{ 
$id_inscription_email=$_POST['id'];
}
mysql_connect("$type_hote_base_de_donnee", "$Utilisateur_base_de_donnee", "$Code_base_de_donnee"); 
mysql_select_db("$Nom_base_de_donnee"); 

$reponse = mysql_query("SELECT * FROM inscription_email WHERE id='$id_inscription_email'");
while ($donnees = mysql_fetch_array($reponse) )
{ 
$destinataire_final=$donnees['destinataire_final'];
$sujet = $donnees['sujet'];
$sujet_final = $donnees['sujet'];
$objet_inscription = $donnees['objet_inscription'];
$webmaster = $donnees['webmaster'];
$site = 'www.lepetitpeuple.org';
}

mysql_close();
?> 


<h3>Si vous voulez vous inscrire <?php echo $objet_inscription; ?>, vous devrez remplir le formulaire ci-dessous
et ensuite aller sur l'adresse email que vous aurez inscrite dans la case ci-dessous pour confirmer votre demande.</h3><br/> 

<form action="email.php" method="post" enctype="multipart/form-data">
<table>
Formulaire:
<tr><td>Nom: </td><td><input type="text" name="nom" /></td></tr>
<tr><td>Email: </td><td><input type="text" name="email" /></td></tr>
<tr><td>Message(facultatif): </td><td><textarea name="message" id="description_textarea"></textarea></td></tr>
<input type="hidden" name="envoyer_email" value="1860essai"/>
<input type="hidden" name="sujet" value="<?php echo $sujet; ?>"/>
<input type="hidden" name="email_source" value="Le Petit Peuple"/>
<input type="hidden" name="id" value="<?php echo $id_inscription_email; ?>"/>
<tr><td><a href="index.php">anuler</a> </td><td><input type="submit" name="mail_soumis" value="Envoyer la demande" /></td></tr>
</table>
</form>

<?php
if($_POST['envoyer_email']=='1860essai')
{ 
?> 
<h3>Un email demandant votre confirmation pour vous inscrire <?php echo $objet_inscription; ?> vous a ete transmis a l'adresse suivante: <?php echo $_POST['email']; ?>. Vous n'aurez qu'a cliquer 
sur le lien contenu dans ce email pour confirmer votre demande et aussi que vous etes bien le proprietaire de l'adresse email que vous avez inscrite.</h3>
<?php


mysql_connect("$type_hote_base_de_donnee", "$Utilisateur_base_de_donnee", "$Code_base_de_donnee"); 
mysql_select_db("$Nom_base_de_donnee"); 
$sujet=$_POST['sujet'];
$nom=$_POST['nom'];
$email=$_POST['email'];
$message=$_POST['message'];
$timestamp=time();
$email_source=$_POST['email_source'];
mysql_query("INSERT INTO email VALUES('', '$sujet', '$nom', '$email', '$message', '$timestamp', '$email_source')");
mysql_close();

$boundary = "_".md5 (uniqid (rand())); 
$from = "MIME-Version: 1.0\n"; 
$from .= "From: ".$webmaster." \n"; 
$from .= "Reply-to: ".$site." <".$webmaster.">\n"; 
$from .= "X-Sender: <www.".strtolower($site).".com>\n"; 
$from .= "X-Mailer: PHP\n"; 
$from .= "X-auth-smtp-user: ".$webmaster." \n"; 
$from .= "X-abuse-contact: ".$webmaster." \n"; 
$from .= "Content-Type: text/html; charset=UTF-8; boundary=".$boundary."\n"; 
$sujet = $_POST['sujet']; 
$message = ''; 
$message .= '
<br><br><br>Une demande d inscription de votre adresse email ' . $objet_inscription  . ' a ete faite.<br>
Si vous voulez que votre demande soit accepte, vous devez: <a href="email.php?timestamp=' . $timestamp . '&amp;id=' . $id_inscription_email . '">cliquer ici pour confirmer.</a><br><br>

'; 

$destinataire = $email; 

@mail($destinataire,$sujet,$message,$from); 
}

if(isset($_GET['timestamp']))
{
mysql_connect("$type_hote_base_de_donnee", "$Utilisateur_base_de_donnee", "$Code_base_de_donnee"); 
mysql_select_db("$Nom_base_de_donnee"); 
$timestamp=$_GET['timestamp'];
$reponse = mysql_query("SELECT * FROM email WHERE timestamp='$timestamp'");
while ($donnees = mysql_fetch_array($reponse) )
{
echo 'Votre demande est accepte. Bonne journee.';

$webmaster = $_POST['email_source'];
$boundary = "_".md5 (uniqid (rand())); 
$from = "MIME-Version: 1.0\n"; 
$from .= "From: ".$webmaster." \n"; 
$from .= "Reply-to: ".$site." <".$webmaster.">\n"; 
$from .= "X-Sender: <www.".strtolower($site).".com>\n"; 
$from .= "X-Mailer: PHP\n"; 
$from .= "X-auth-smtp-user: ".$webmaster." \n"; 
$from .= "X-abuse-contact: ".$webmaster." \n"; 
$from .= "Content-Type: text/html; charset=UTF-8; boundary=".$boundary."\n"; 
$sujet = $_POST['sujet']; 
$message = ''; 

$message .= '
Une contact demande de l insrire ' . $objet_inscription . ' <br>
Voici les informations: <br>
<br>Nom: ' . $donnees['nom'] . '<br>
Email: ' . $donnees['email'] . '<br>
Message: ' . $donnees['message'] . '<br>
Ajoutez ces informations dans vos contactes<br><br>'; 
$sujet = $sujet_final ; 
@mail($destinataire_final,$sujet,$message,$from); 
}
mysql_close();
}

if(isset($_SESSION['autorisation']) and((($_SESSION['autorisation'])=='administrateur') or (($_SESSION['autorisation'])=='superadministrateur')) and(($_GET['visite'])!='fin'))
{ ?>
<a href="contenu_d_application_gestion.php?table_gestion=email">gestion des liste d'inscriptions</a>
<?php } ?>