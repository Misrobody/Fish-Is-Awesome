<?php

/*
 * Insert a given fish in the database.
 */

		$cible='insert';
		if (theyDontExist()){
			include(__DIR__ ."/../view/fishForm.php");
		}
		else{
			$nom = getVar("nom", $_POST);
			$dlc = getVar("dlc", $_POST);
			$prix = getVar("prix", $_POST);
			$stock = getVar("stock", $_POST);
			$desc = getVar("desc", $_POST);
			$image = getVar("image", $_POST);
			$valeurs = array(
				"nom" => $nom,
				"dlc" => $dlc,
				"prix" => $prix,
				"stock" => $stock,
				"desc" => $desc,
				"image" => $image
			);					
			$erreur = setErreurMsg($valeurs, $erreur, "insert");				
			$compteur_erreur=count($erreur);
			foreach ($erreur as $cle=>$valeur){
				if ($valeur==null) $compteur_erreur=$compteur_erreur-1;
			}
			if ($compteur_erreur == 0){			
				$idP = getNewId($connection);				
				$uploadDirectory = __DIR__.'../../public/uploads';
				
				if (! (file_exists($uploadDirectory . $_FILES["image"]['name']))){
					if (move_uploaded_file($_FILES['image']['tmp_name'], __DIR__.$uploadDirectory. $_FILES["image"]['name'])){ 
						$zonePrincipale = "Téléchargé";
					} 
					else{ 
						$zonePrincipale = "Pas téléchargé"; 
					}					
				}
				else{
					$zonePrincipale = "Existe déjà";
				}
			
				$requete = "INSERT INTO poissons VALUES (:ID, :NOM, :DLC, :PRIX, :STOCK, :DESC, :IMAGE);";
				$data = array(
					':ID' => $idP,
					':NOM' => $valeurs["nom"],
					':DLC' => formatDate($valeurs["dlc"]),
					':PRIX' => $valeurs["prix"],
					':STOCK' => $valeurs["stock"],
					':DESC' => $valeurs["desc"],
					':IMAGE' => "../uploads/". $_FILES["image"]['name']
				);
				$stmt = $connection->prepare($requete);
				$stmt->execute($data);

				$p = setPoisson($idP, $valeurs);
				$tabPoisson[$idP] = $p;

				$zonePrincipale = "Changement effectué.";
			}
			else {
				include(__DIR__ ."/../view/fishForm.php");
			}
		}
?>