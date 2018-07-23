<?php

// +-------------+-------------+------+-----+---------+----------------+
// | Field       | Type        | Null | Key | Default | Extra          |
// +-------------+-------------+------+-----+---------+----------------+
// | idCuisine   | int(11)     | NO   | PRI | NULL    | auto_increment |
// | Description | varchar(45) | NO   |     | NULL    |                |
// +-------------+-------------+------+-----+---------+----------------+

class CuisineMapper{

    function getAllCuisines(){
        $cuisines = null;

        //Create a new PDOAgent
        $pdoAgent = new DatabaseAgent();

        //Setup the query()
        $pdoAgent->query("SELECT * FROM cuisine");

        //Pull the resultset
        $cuisines = $pdoAgent->resultset();

        //var_dump($cuisines);
        return $cuisines;
    }
}

?>