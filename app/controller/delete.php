<?php

/*
 * Delete action for a given fish.
 */

$idP = getVar("idP", $_GET);
$requete = "DELETE FROM poissons WHERE idP=:ID;";	
$data = array(':ID' => $idP);
$data = base64_encode(serialize($data));
include(__DIR__ ."/../view/confirmForm.php");	
?>