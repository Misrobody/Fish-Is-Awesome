<?php

$corps =<<<EOT
<form action="index.php?action=sauvegarde" method="post">	
    <input type="hidden" name="idP" value="{$idP}">
    <input type="hidden" name="requete" value="{$requete}">
	<input type="hidden" name="data" value="{$data}">
	<fieldset>
		<legend>Save the changes?</legend>
		<button type="submit" class="btn btn-danger">Confirm</button>
		<a href="index.php?action=liste" class="btn btn-secondary">Cancel</a>
	</fieldset>     
</form>
EOT;
$zonePrincipale=$corps ;
?>