<?php
require_once("./conf.php");
class Connection extends PDO
{
    public function Connection(){
	    try{
	        parent::__construct("sqlsrv:Server=".SERVER.";Database=".BDD);
	        $this->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	    } 
	    catch(PDOException $e){
	        echo 'Ereur : ' . $e->getMessage();
	    }   
    }
}
?>