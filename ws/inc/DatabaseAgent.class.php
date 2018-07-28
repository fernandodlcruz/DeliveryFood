<?php

/*
* Reference class from: http://www.culttt.com/2012/10/01/roll-your-own-pdo-php-class
*/

class DatabaseAgent {
    //Predfined Constants
    private $host = DB_HOST;  
    private $user = DB_USER;  
    private $pass = DB_PASS;  
    private $dbname = DB_NAME;
    
    //Dbh
    private $dbh;  
    private $error;

    private $stmt;

    public function __construct() {

        $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->dbname;  

        // Set options  
        $options = array(  
            PDO::ATTR_PERSISTENT => true,  
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION  
            ); 

        //Try to connect, if not barf
        try {  
            $this->dbh = new PDO($dsn, $this->user, $this->pass, $options);  
        }  catch (PDOException $e) {
            $this->error = $e->getMessage();  
        }  
    }

    public function query($query){  
        $this->stmt = $this->dbh->prepare($query);  
    }
    
    public function bind($param, $value, $type = null)  {
        if (is_null($type)) {  
            switch (true) {  
                case is_int($value):  
                $type = PDO::PARAM_INT;  
                break;  
                case is_bool($value):  
                $type = PDO::PARAM_BOOL;  
                break;  
                case is_null($value):  
                $type = PDO::PARAM_NULL;  
                break;  
                default:  
                $type = PDO::PARAM_STR;  
            }  
        }

    //Run bind value
    $this->stmt->bindValue($param, $value, $type); 
    
}

    //Execute all the things!
    public function execute($params = null){  
        if (is_null($params)) {
            return $this->stmt->execute();
        } else {
            return $this->stmt->execute($params);
        }
    }

    //Returns single rows
    public function single(){
        $this->execute();  
        return $this->stmt->fetch(PDO::FETCH_ASSOC);
    }

    //Get the last inserted id
    public function lastInsertId(){  
        return $this->dbh->lastInsertId();  
    }  

    //Return the number of rows affected
    public function rowCount(){  
        return $this->stmt->rowCount();  
    }  

    //resultset returns multiple records
    public function resultset($params = null){
        $this->execute($params);
        return $this->stmt->fetchAll(PDO::FETCH_OBJ);  
    }  

    //Initiate Database Transaction
    public function beginTransaction(){  
        return $this->dbh->beginTransaction();
    }

    //End Database Transaction
    public function endTransaction(){  
        return $this->dbh->commit();  
    }

    //Cancel Transaction
    public function cancelTransaction(){  
        return $this->dbh->rollBack();  
    }

    //Debug params here
    public function debugDumpParams(){  
        return $this->stmt->debugDumpParams();  
    }  
}

?>