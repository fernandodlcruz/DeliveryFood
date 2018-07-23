<?php

// +-------------+--------------+------+-----+---------+----------------+
// | Field       | Type         | Null | Key | Default | Extra          |
// +-------------+--------------+------+-----+---------+----------------+
// | idUser      | int(11)      | NO   | PRI | NULL    | auto_increment |
// | Name        | varchar(45)  | YES  |     | NULL    |                |
// | PhoneNumber | varchar(15)  | YES  |     | NULL    |                |
// | Email       | varchar(80)  | YES  |     | NULL    |                |
// | UserType    | char(1)      | YES  |     | NULL    |                |
// | Pwd         | varchar(255) | YES  |     | NULL    |                |
// | IdCuisine   | int(11)      | YES  | MUL | NULL    |                |
// +-------------+--------------+------+-----+---------+----------------+

class UserMapper    {

    function getAllUsers() {
        $users = null;

        //Create a new PDOAgent
        $pdoAgent = new DatabaseAgent();

        //Setup the query()
        $pdoAgent->query("SELECT * FROM user");

        //Pull the resultset
        $users = $pdoAgent->resultset();

        //var_dump($users);
        return $users;
    }

    function getAllUsersByType($type) {
        // Type is "C" for customer and
        // "B" for business
        $users = null;

        //Create a new PDOAgent
        $pdoAgent = new DatabaseAgent();

        //Setup the query()
        $pdoAgent->query("SELECT * FROM user WHERE UserType = :type;");

        //Setup the bind parameters
        $pdoAgent->bind(':type',$type);

        //Pull the resultset
        $users = $pdoAgent->resultset();

        //var_dump($users);
        return $users;
    }

    function getUserById($id) {
        $user = null;

        $pdoAgent = new DatabaseAgent();

        $pdoAgent->query("SELECT * FROM user WHERE  idUser = :id;");

        $pdoAgent->bind(':id',$id);

        $user = $pdoAgent->single();

        //var_dump($user);
        return $user;
    }
}

?>