<?php
class MysqlConnector
{
    private $pdo;
    
    function __construct() 
    {
        $this->pdo = new PDO('sqlsrv:Server=G80R11P03\\MSSQLServer02;Database=VideothekV1','WebApp','trottel');
    }
    
    function __destruct()
    {
        $this->pdo = null;
    }
    
    function executeInsert($query, $parameter)
    {
        $statement = $this->pdo->prepare($query);
        $statement->execute($parameter);
        
    }
    
    function querySelect($query)
    {
        return $this->pdo->query($query);
    }
     
    function executeSelect($query, $parameter)
    {
        $statement = $this->pdo->prepare($query);
        $statement->execute($parameter);
        return $statement;
    }
}
?>
