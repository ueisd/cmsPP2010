<?php
include("noyau/configuration/base_de_donnee.php");

$_SESSION['administration_adresse_de_la_derniere_page_avec_variables']=$_SERVER['REQUEST_URI'];
$_SESSION['adresse_visionneur']=$_SERVER['REQUEST_URI'];

$table_de_l_application=$_GET['table_de_l_application'];

$adresse_include='Applications/' . $table_de_l_application . '/application.php';

include($adresse_include);
?>