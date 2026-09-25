<?php

$corps =<<<EOT
  <form method="post" action="index.php?action={$cible}&idP={$idP}" enctype="multipart/form-data">
  <label>Name </label><br>
  <input type="text" name="nom" value="{$nom}">
  <span>{$erreur["nom"]}</span><br>
     
  <label>Use-by Date</label><br>
  <input type="text" name="dlc" placeholder="jj-mm-aaaa" value="{$dlc}">
  <span>{$erreur["dlc"]}</span><br> 
  
  <label>Price</label><br>
  <input type="text" name="prix" value="{$prix}">
  <span>{$erreur["prix"]}</span><br>
   
  <label>Stock</label><br>
  <input type="text" name="stock" value="{$stock}">
  <span>{$erreur["stock"]}</span><br>  
   
  <label>Image</label><br>
  <input type="file" name="image">
  <span>{$erreur["image"]}</span><br> 
   
  <label>Description</label><br>
  <textarea cols="30" rows="5" name="desc">{$desc}</textarea>
  <span>{$erreur["desc"]}</span><br>
      	  				
  <input type="submit" name="user_valider" value="Save this fish entry">     
</form>

EOT;
$zonePrincipale=$corps ;
?>