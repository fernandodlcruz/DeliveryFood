<?php 

// +---------------+-------------+------+-----+---------+----------------+
// | Field         | Type        | Null | Key | Default | Extra          |
// +---------------+-------------+------+-----+---------+----------------+
// | idAddress     | int(11)     | NO   | PRI | NULL    | auto_increment |
// | Line1         | varchar(45) | YES  |     | NULL    |                |
// | Line2         | varchar(45) | YES  |     | NULL    |                |
// | City          | varchar(45) | YES  |     | NULL    |                |
// | StateProvince | varchar(45) | YES  |     | NULL    |                |
// | PostalCode    | varchar(45) | YES  |     | NULL    |                |
// | IdUser        | int(11)     | YES  | MUL | NULL    |                |
// +---------------+-------------+------+-----+---------+----------------+


class AddressMapper{

    function getAddressByUserId($id) {
        $address = null;

        $pdoAgent = new DatabaseAgent;

        $pdoAgent->query("SELECT * FROM address WHERE IdUser = :id;");

        $pdoAgent->bind(':id',$id);

        $address = $pdoAgent->resultset();

        return $address;
    }

    // Create
    function createAddress($postdata) {

        $pdoAgent = new DatabaseAgent;

        $pdoAgent->query("INSERT INTO address (Line1, Line2, City, StateProvince, PostalCode, IdUser) 
        VALUES (:line1, :line2, :city, :stateProv, :postal, :idUser);");

        // postdata is declared in the login file for testing
        $pdoAgent->bind('line1',$postdata['Line1']);
        $pdoAgent->bind('line2',$postdata['Line2']);
        $pdoAgent->bind('city',$postdata['City']);
        $pdoAgent->bind('stateProv',$postdata['StateProvince']);
        $pdoAgent->bind('postal',$postdata['PostalCode']);
        $pdoAgent->bind('idUser',$postdata['idUser']);
        
        $pdoAgent->execute();

        return $pdoAgent->lastInsertId();
    }
}

?>