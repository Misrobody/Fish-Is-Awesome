<?php

/**
 * Fish Is Awesome — Helper Functions
 *
 * This file contains utility functions used across the application.
 * Responsibilities include:
 *  - handling image uploads and validation
 *  - validating form fields and user input
 *  - generating new IDs for poissons
 *  - formatting dates
 *  - constructing poisson objects from form data
 *  - connecting to the SQLite database
 *
 * All functions are documented individually using Doxygen-compatible
 * comment blocks to support automated documentation generation.
 *
 * @package FishIsAwesome
 * @author  Bigeishe
 * @license MIT
 */


require_once("Fish.php");


/**
 * Uploads an image into the uploads/ directory.
 *
 * @param string $image The name of the file input field.
 * @return string Status message ("Téléchargé", "Pas téléchargé", "Existe déjà").
 *
 * Checks if the file already exists, then attempts to move the uploaded file.
 * Note: The final assignment sets "Existe déjà" even after upload; logic may need review.
 */
function uploadImage($image){
	if (! (file_exists(__DIR__.'/uploads/'. $_FILES[$image]['name']))){
		if (move_uploaded_file($_FILES[$image]['tmp_name'], __DIR__.'/uploads/'. $_FILES[$image]['name'])){ 
			$upState = "Téléchargé";
		} 
		else{ 
			$upState = "Pas téléchargé"; 
		}					
	}
	$upState = "Existe déjà";
	return $upState;
}


/**
 * Validates an uploaded image file.
 *
 * @param string $image The name of the file input field.
 * @param string $action Either "insert" or "update".
 * @return array Associative array with:
 *               - uploadOk (bool)
 *               - message (string)
 *
 * Checks size (max 500 KB), empty file rules, and allowed extensions (jpg/jpeg).
 */
function controlerImage($image, $action){	
	$name = basename($_FILES[$image]["name"]);	
	$fileType = strtolower(pathinfo($name,PATHINFO_EXTENSION));	
	$msg = "";
	$uploadOk = true;
	
	if ($_FILES[$image]["size"] > 500000){
		$msg = "500ko max";
		$uploadOk = false;
	}
	else if ($_FILES[$image]['size'] == 0){
	   $msg = "Choisir une image";
	   if ($action == "update"){
		   $uploadOk = true;
	   }
	   else {
		   $uploadOk = false;
	   }		
	}
	else if ($fileType != "jpg" && $fileType != "jpeg"){
	   $msg = "Seulement JPG";
	   $uploadOk = false;
	}		
	return array("uploadOk" => $uploadOk, "message" => $msg);
}


/**
 * Retrieves a trimmed value from an associative array.
 *
 * @param string $nom The key to look for.
 * @param array $dico The associative array.
 * @return string|null Trimmed value or null if key does not exist.
 */
function getVar($nom, $dico){
	if (key_exists($nom, $dico)){
		return trim($dico[$nom]);
	}
	return null;
}


/**
 * Computes the next available poisson ID.
 *
 * @param PDO $connection Active database connection.
 * @return int The next ID (MAX(idP) + 1).
 */
function getNewId($connection){
	$requete="SELECT MAX(idP) FROM poissons;";
	$query  = $connection->query($requete);
	$query->setFetchMode(PDO::FETCH_NUM);
	$ligne = $query->fetch();
	return $ligne[0] + 1;
}


/**
 * Converts a date from YYYY-MM-DD to DD-MM-YYYY.
 *
 * @param string $dateN Input date string.
 * @return string Reformatted date.
 */
function formatDate($dateN){
	$elements = explode("-", $dateN);
	return $elements[2]. "-". $elements[1]. "-". $elements[0];
}


/**
 * Creates and returns a poisson object from form values.
 *
 * @param int $idP The poisson ID.
 * @param array $valeurs Associative array of field values.
 * @return poisson The constructed poisson instance.
 */
function setPoisson($idP, $valeurs){	
	$p = new poisson(
		$idP,
		$valeurs["nom"],
		$valeurs["dlc"],
		$valeurs["prix"],
		$valeurs["stock"],
		$valeurs["desc"],
		$valeurs["image"]
	);
	return $p;
}


/**
 * Validates form fields and populates an error array.
 *
 * @param array $valeurs Input values.
 * @param array $erreur Existing error array.
 * @param string $action Either "insert" or "update".
 * @return array Updated error array.
 *
 * Checks empty fields, numeric validity, date validity, and image validity.
 */
function setErreurMsg($valeurs, $erreur, $action){		
	foreach ($valeurs as $k => $v){
		if (($v == "" && $k != "image")
			|| ($action == "insert" && $k == "dlc" && controlerDate($v) == false)
			|| ($k == "prix" && controlerNum($v) == false)
			|| ($k == "stock" && controlerNum($v) == false)){
			$erreur[$k] = ucfirst($k). " invalide";
		}

		if ($k == "image"){
			$check = controlerImage($k, $action);
			if ($check["uploadOk"] == false){
				$erreur[$k] = $check["message"];
			}
		}
    }
	return $erreur;
}


/**
 * Determines whether the form has not been submitted.
 *
 * @return bool True if none of the expected POST fields exist.
 */
function theyDontExist(){
	return (!isset($_POST["nom"])
				&& !isset($_POST["dlc"])
				&& !isset($_POST["prix"])
				&& !isset($_POST["stock"])
				&& !isset($_POST["desc"])
				&& !isset($_POST["image"]));	
}


/**
 * Establishes a PDO connection to the SQLite database.
 *
 * @return PDO The database connection.
 *
 * Enables exceptions and foreign key constraints.
 * Terminates execution on failure.
 */
function connecter() {
    try {
        $dns = "sqlite:" .__DIR__ . '/../../database/database.sqlite';
        $options = array(
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        );
        $connection = new PDO($dns, null, null, $options);
        $connection->exec("PRAGMA foreign_keys = ON;");
        return $connection;
    }
    catch (Exception $e) {
        echo "Connection à SQLite impossible : ", $e->getMessage();
        die();
    }
}


/**
 * Validates a date string using regex and checkdate().
 *
 * @param string $valeur The date string.
 * @return bool True if the date is valid.
 *
 * Accepts DD/MM/YY, DD-MM-YY, DD.MM.YY, with optional 4-digit year.
 */
function controlerDate($valeur) {
    if (preg_match("/^(\d{1,2})[\/|\-|\.](\d{1,2})[\/|\-|\.](\d\d)(\d\d)?$/", $valeur, $regs)) {
        $jour = ($regs[1] < 10) ? "0".$regs[1] : $regs[1];
        $mois = ($regs[2] < 10) ? "0".$regs[2] : $regs[2];
        if ($regs[4]) $an = $regs[3] . $regs[4];
              if (checkdate($mois, $jour, $an)) return true;
        else return false;
    }
    else return false;
}


/**
 * Validates numeric input.
 *
 * @param string $valeur The value to check.
 * @param bool $strict If true, only digits are allowed.
 * @return bool True if the value is numeric according to the mode.
 *
 * Non-strict mode allows digits, spaces, signs, scientific notation, commas, dots.
 */
function controlerNum($valeur, $strict=false) {
    if ($strict) {
        if (ereg("^[0-9]+$", $valeur)) return true;
        else return false;
    }
    else if (preg_match("/^[\d|\s|\-|\+|E|e|,|\.]+$/", $valeur)) return true;
    else return false;
}
?>
