<?php

/*
 * List the fishes in the database.
 */

	$corps="<h2>Fish List</h2>";		
	$corps.= "<ol>";
			
	foreach(array_keys($tabPoisson) as $id){
		$corps.= $tabPoisson[$id]->printLi();
	}
	$corps.= "</ol>";
	$zonePrincipale=$corps;
?>