<?php
require_once(__DIR__ . "/../Viewmodel/RestViewmodel.php");
class RestJsonView extends cView
{
	function __construct()
	{
		Parent::__construct(new RestViewmodel($this));
	}
	
	function showView()
	{
		$result = $this->viewmodel->getObjectFromPath();

		if (!is_null($result))
		{
			echo json_encode($result, JSON_NUMERIC_CHECK | JSON_UNESCAPED_UNICODE);// | JSON_PRETTY_PRINT);
		}
		else
		{
			echo "Kein Result o.o";
		}
	}
}
?>