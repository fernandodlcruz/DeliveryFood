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

    // Create
    function createOrder($postdata) {

        $pdoAgent = new DatabaseAgent;

        $pdoAgent->query("INSERT INTO PlaceOrder (IdCompanyOrder, IdUserOrder, IdMenuOrder, idAddressOrder, OrderDate, Quantity, TotalPrice) 
        VALUES (:companyId, :userId, :menuId, :addressId, :orderDate, :quantity, :totalPrice);");

        // postdata is declared in the login file for testing
        $pdoAgent->bind('companyId',$postdata['companyId']);
        $pdoAgent->bind('userId',$postdata['userId']);
        $pdoAgent->bind('menuId',$postdata['menuId']);
        $pdoAgent->bind('addressId',$postdata['addressId']);
        $pdoAgent->bind('orderDate',date("Y-m-d H:i:s"));
        $pdoAgent->bind('quantity',$postdata['quantity']);
        $pdoAgent->bind('totalPrice',$postdata['totalPrice']);
        
        $pdoAgent->execute();

        return $pdoAgent->lastInsertId();
    }
}

?>