<?php

/*
 * Save a given fish in the database.
 */

$requete = getVar("requete", $_POST);		
$data = unserialize(base64_decode($_POST['data']));		
$stmt = $connection->prepare($requete);
$stmt->execute($data);			
$zonePrincipale = "Change made";
?>