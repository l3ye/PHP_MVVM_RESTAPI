<?php
abstract class cModel
{
    protected $viewmodel;
	
	public function __construct($viewmodel)
	{
		$this->viewmodel = $viewmodel;
	}
}
?>