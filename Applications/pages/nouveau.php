Cr&#233;ation de pages:

<table style="background-color:#ececec; border:4px double black;">
<tr>
<form action="contenu_d_application_gestion.php?table_gestion=pages" method="post">

<td>
<table>

<tr><td><label for="Nom_de_la_page">Titre de la page:</label></td>
<td><input type="text" name="Nom_de_la_page" /></td></tr>

<tr><td><label for="Tags">Liste des tags:</label></td>
<td><textarea name="Tags"></textarea></td></tr>
<tr><td>
<?php echo 'Bonjour ' . $_SESSION['nom_utilisateur'] . ' id=' . $_SESSION['id_utilisateur']; ?>
</td></tr>

<tr><td><label for="Nouveau_topic">Enregistrer la nouvelle page:</label></td>
<td>
<input type="submit" name="Nouvelle_page" value="valider" /></td></tr>

</table>
</td>

</form>
</tr>
</table>


<a href="contenu_d_application_gestion.php?table_gestion=gestion_des_applications">G&#233;rer les applications disponibles</a>