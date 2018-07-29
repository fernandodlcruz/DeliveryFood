<?php
//mysql> describe placeorder;
// +----------------+--------------+------+-----+---------+----------------+
// | Field          | Type         | Null | Key | Default | Extra          |
// +----------------+--------------+------+-----+---------+----------------+
// | idOrder        | int(11)      | NO   | PRI | NULL    | auto_increment |
// | IdCompanyOrder | int(11)      | YES  | MUL | NULL    |                |
// | IdUserOrder    | int(11)      | YES  | MUL | NULL    |                |
// | IdMenuOrder    | int(11)      | NO   | PRI | NULL    |                |
// | Quantity       | int(11)      | YES  |     | NULL    |                |
// | TotalPrice     | decimal(5,0) | YES  |     | NULL    |                |
// +----------------+--------------+------+-----+---------+----------------+

class PlaceOrderMapper{

    // Start create order



    // End create order

    // This function returns the a full order
    function getOrderByID($orderID){
        $order = null;

        $pdoAgent = new DatabaseAgent;

        $pdoAgent->query("SELECT * FROM placeorder WHERE idOrder = :id;");

        $pdoAgent->bind(':id',$orderID);

        $order = $pdoAgent->resultset();

        return $order;
    }

    function getOrdersFromCustomer($id){
        $order = null;

        $pdoAgent = new DatabaseAgent;

        $pdoAgent->query("SELECT * FROM placeorder WHERE IdUserOrder = :id;");

        $pdoAgent->bind(':id',$id);

        $order = $pdoAgent->resultset();

        return $order;
    }

    function getOrdersFromBusiness($id){
        $order = null;

        $pdoAgent = new DatabaseAgent;

        $pdoAgent->query("SELECT * FROM placeorder WHERE IdCompanyOrder = :id;");

        $pdoAgent->bind(':id',$id);

        $order = $pdoAgent->resultset();

        return $order;
    }

<<<<<<< HEAD
    function getLastID(){
        $id = null;
        $pdoAgent = new DatabaseAgent;
        $pdoAgent->query("SELECT MAX(idOrder) FROM placeorder;");
        $id = $pdoAgent->single();
        return $id['MAX(idOrder)']+1;
=======
    // Create
    function createOrder($postdata) {

        $pdoAgent = new DatabaseAgent;

        $pdoAgent->query("INSERT INTO PlaceOrder (IdCompanyOrder, IdUserOrder, IdMenuOrder, Quantity, TotalPrice) 
        VALUES (:companyId, :userId, :menuId, :quantity, :totalPrice);");

        // postdata is declared in the login file for testing
        $pdoAgent->bind('companyId',$postdata['companyId']);
        $pdoAgent->bind('userId',$postdata['userId']);
        $pdoAgent->bind('menuId',$postdata['menuId']);
        $pdoAgent->bind('quantity',$postdata['quantity']);
        $pdoAgent->bind('totalPrice',$postdata['totalPrice']);
        
        $pdoAgent->execute();

        return $pdoAgent->lastInsertId();
>>>>>>> f2f3a850d06601e73ed1fb45916b04bcfe97c2b4
    }
}

?>