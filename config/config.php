<?php

/**
 * @brief Initializes global variables and loads all poissons from the database.
 *
 * This block prepares the application state before any controller logic runs.
 *
 * Responsibilities:
 *   - create an empty main display zone ($zonePrincipale)
 *   - establish a SQLite database connection
 *   - fetch all poissons from the database
 *   - instantiate poisson objects and store them in $tabPoisson
 *   - initialize form-related variables (idP, nom, dlc, prix, stock, desc, image)
 *   - initialize error arrays and value arrays used by form validation
 *
 * Global variables created:
 *   - $zonePrincipale : string, main HTML content area
 *   - $tabPoisson     : array<int, poisson>, indexed by idP
 *   - $connection     : PDO, active SQLite connection
 *   - $idP, $nom, $dlc, $prix, $stock, $desc, $image : form fields
 *   - $erreur         : associative array of validation errors
 *   - $valeurs        : associative array of form values
 *
 * Database loading:
 *   - Executes "SELECT * FROM poissons"
 *   - For each row, constructs a poisson object
 *   - Stores each object in $tabPoisson using idP as the key
 *
 * This initialization ensures that all poissons are available in memory
 * and that form variables are ready for insert/update operations.
 */

$zonePrincipale = "";
$tabPoisson = array();	
$connection = connecter();
$requete="SELECT * FROM poissons";
$query = $connection->query($requete);
$query->setFetchMode(PDO::FETCH_NUM);
while($l = $query->fetch()){
	$p = new poisson($l[0],
						$l[1],
						$l[2],
						$l[3],
						$l[4],
						$l[5],
						$l[6]);
	$tabPoisson[$l[0]] = $p;
}

$idP = null;
$nom = null;
$dlc = null;
$prix = null;
$stock =  null;
$desc = null;
$image = null;

$erreur = array(
	"nom" => null,
	"dlc" => null,
	"prix" => null,
	"stock" => null,
	"desc" => null,
	"image" => null);
	
$valeurs = array(
	"nom" => null,
	"dlc" => null,
	"prix" => null,
	"stock" => null,
	"desc" => null,
	"image" => null);
?>