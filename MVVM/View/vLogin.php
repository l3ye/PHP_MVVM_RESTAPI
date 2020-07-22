<?php
require_once (__DIR__ . "/../Viewmodel/vmLogin.php");
class vLogin extends cView
{
    function __construct()
    {
        parent::__construct(new vmLogin($this));
    }

    function showView()
    {
        
    }
}
?>