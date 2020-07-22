<?php
require_once(__DIR__ . "/../Model/RestModel.php");

class RestViewmodel extends cViewmodel
{
	function __construct($view)
	{
		parent::__construct($view, new RestModel($this));
	}
	function getObjectFromPath()
	{
		/**
		 * Abhängig von der URL wird ein anderer Part aufgerufen.
		 * ./rest.php/POST/<tabelle> zum Senden
		 * 
		 * ./rest.php/GET/<tabelle> für alle Datensätze in <tabelle>
		 * 
		 * ./rest.php/GET/<tabelle>/<zahl> für alle Datensätze mit "<tabelle>_id" = "<zahl>"
		 * 
		 * ./rest.php/GET/<tabelle>/<spalte>/<wert> für alle Datensätze in <tabelle> mit <wert> in spalte
		 * z.B. ./rest.php/GET/ausleihe/zurückgegeben/0 gibt alle Datensätze von der Tabelle "Ausleihe" zurück, wo die Spalte "zurückgegeben" den Wert "0" hat 
		 */
		$link = $_SERVER['PHP_SELF'];
		$urlparts = explode("/", $link);
		$countParts = count($urlparts);

		if($countParts < 5) { return -1; } //new cError(5, "Not enough arguments!"); }
		if($urlparts[3] !== "GET" && $urlparts[3] !== "POST" && $urlparts[3] !== "TESTPOST") { return -1; } //"Falscher URL Aufbau!"; }

		switch($urlparts[3])
		{
			case "GET":
				if ($countParts == 5) { return $this->model->GET($urlparts[4]); }
				else if ($countParts == 6) { return $this->model->GET($urlparts[4], $urlparts[4]."_id", $urlparts[5]); }
				else if ($countParts == 7) { return $this->model->GET($urlparts[4], $urlparts[5], $urlparts[6]); }
				return -1; //new cError(1, "Falsche URL!");
				break;
			case "POST":
				return $this->model->POST($urlparts[4]);
				break;
			case "UPDATE":
				break;
			case "DELETE":
				break;
			case "TESTPOST":
				return $this->model->testpost($urlparts[4]);
				break;
		}
		
		return null;
	}
	
}
?>