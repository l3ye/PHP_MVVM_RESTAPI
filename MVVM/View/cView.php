<?php
abstract class cView
{
	protected $viewmodel;
	
	public function __construct($viewmodel)
	{
		$this->viewmodel = $viewmodel;
	}
	
	abstract public function showView();
}
?>