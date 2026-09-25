<?php
require_once("../app/model/lib.php");
require_once("../config/config.php");

$action = getVar("action", $_GET);
switch ($action){	
	case "extra":
		require_once("../app/view/extra.html");
		break;
	
	case "liste":
		require_once("../app/controller/list.php");
		break;

	case "insert":
		require_once("../app/controller/insert.php");
		break;
		
	case "delete":
		require_once("../app/controller/delete.php");
		break;

	case "sauvegarde":	
		require_once("../app/controller/save.php");
		break;

	case "select":	
		require_once("../app/controller/select.php");		
		break;		
		
	case "update":	
		require_once("../app/controller/update.php");
		break;
		
	default:
		require_once("../app/controller/list.php");
		break;
}
include("../app/view/skeleton.php");
?>
