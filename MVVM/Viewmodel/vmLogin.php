<?php
require_once(__DIR__ . "/../Model/mLogin.php");
class vmLogin extends cViewmodel
{
    function __construct($view)
    {
        parent::__construct($view, new mLogin($this));
    }
}
?>