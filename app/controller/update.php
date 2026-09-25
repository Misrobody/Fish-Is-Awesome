<?php

/*
 * Update a given fish in the database.
 */ 

		$idP = getVar("idP", $_GET);
		$cible='update&idP='.$idP;
		
		$p = $tabPoisson[$idP];	
		$nom = $p->getNom();
		$dlc = $p->getDlc();
		$prix = $p->getPrix();
		$stock = $p->getStock();
		$desc = $p->getDesc();	
		$image = $p->getImage();
		$valeurs = $p->getValeurs();		
		
		if (theyDontExist()){
			include(__DIR__ ."/../view/fishForm.php");
			$zonePrincipale = "<article><h2>Modify</h2>". 
								$zonePrincipale. 
								"<section>								
								<h2>Current Image</h2>
								<p>Will be kept if no other image is selected :</p>".
								$p->printImage(). 
								"</section></article>";
		}		
		else {	
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
			$erreur = setErreurMsg($valeurs, $erreur, "update");				
			$compteur_erreur=count($erreur);
			foreach ($erreur as $cle=>$valeur){
				if ($valeur==null) $compteur_erreur=$compteur_erreur-1;
			}
			if ($compteur_erreur == 0){		
				$uploadDirectory = '../uploads';
				
				$upState = uploadImage("image");
				echo $upState;
				
				$imgToUp = "uploads/". $_FILES["image"]['name'];
				if ($upState == "Existe déjà"){
					$imgToUp = $p->getImage();
				}								
				$requete = "UPDATE poissons
								SET nom = :NOM,
								dlc = :DLC,
								prix = :PRIX,
								stock = :STOCK,
								desc = :DESC,
								image = :IMAGE
							WHERE idP = :IDP;";									
				$data = array(
					':NOM' => $valeurs["nom"],
					':DLC' => $valeurs["dlc"],
					':PRIX' => $valeurs["prix"],
					':STOCK' => $valeurs["stock"],
					':DESC' => $valeurs["desc"],
					':IMAGE' => $imgToUp,
					':IDP' => intval($idP)
				);
				$data = base64_encode(serialize($data));
				include(__DIR__ ."/../view/confirmForm.php");		
			}
			else {
				include(__DIR__ ."/../view/fishForm.php");
				$zonePrincipale = "<article><h2>Modify</h2>". 
									$zonePrincipale. 
									"<section>								
									<h2>Current Image</h2>
									<p>Will be kept if no other image is selected :</p>".
									$p->printImage(). 
									"</section></article>";
			}
		}
?>