<?php
session_start();

require './MVVM/View/cView.php';
require './MVVM/Model/cModel.php';
require './MVVM/ViewModel/cViewmodel.php';
require './MVVM/View/RestJsonView.php';
require './ORM/Datei.php';
require './ORM/Kategorie.php';
require './MVVM/View/vLogin.php';
require_once('./Base/viewHead.php');

if((new vLogin())->showView())
{
    //(new viewHead())->showView();
    (new RestJsonView())->showView();
}
?>