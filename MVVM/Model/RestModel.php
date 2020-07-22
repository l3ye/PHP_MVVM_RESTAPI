<?php
require_once(__DIR__ . "/../../Sql/MysqlConnector.php");
class RestModel extends cModel
{
	function __construct($viewmodel)
	{
		parent::__construct($viewmodel);
	}
	
	/**
	*/
	function GET($table, $spalte = "", $id = -1)
	{
		$sql = new MysqlConnector();
		$basequery = "SELECT * FROM $table";
		$sqlresult = $sql->executeSelect($basequery . ($id == -1 ? "" : " WHERE $spalte = ?"), [$id]);

		$result = array();
		while($row = $sqlresult->fetchObject("$table"))
		{
			array_push($result, $row);
		}

		$sql = null;
		return $result;
	}

	function POST($table)
	{
		if(count($_POST) == 0)
		{
			return -1;
			//return new cError(-1, "Keine POST-Daten!");
		}

		$sql = new MysqlConnector();
		$strInsertNames = "";
		$strInsertValues = "";
		$arrInsertValues = array();
		foreach($_POST as $key=>$value)
		{
			$strInsertNames .= "$key,";
			$strInsertValues .= "?,";
			array_push($arrInsertValues, $value);
		}

		$strInsertNames = substr($strInsertNames, 0, strlen($strInsertNames) - 1);
		$strInsertValues = substr($strInsertValues, 0, strlen($strInsertValues) - 1);

		try
		{
			$sql->executeInsert("INSERT INTO $table ($strInsertNames) VALUES ($strInsertValues);", $arrInsertValues);
		}
		catch(Exception $ex)
		{
			
		}
		$sql = null;
	}

	function testpost($table)
	{
		$data = array(	'bezeichnung' => 'wik'
		);
		$url = 'http://192.168.100.31/GiVoLib/rest.php/POST/ort';
		$query = http_build_query($data);

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		//curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0); // Read the notice bellow!
		$response = curl_exec($ch);
		echo $response;
		//return new cError(-1, $response);
	}
}
?>