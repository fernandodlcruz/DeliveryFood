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

    function createOrder($order){
        // $order needs the following data:
        //  $order['companyID'], $order['userID'], $order['menuID']
        //  $order['qty'], $order['totalPrice'].

        $pdoAgent = new DatabaseAgent;

        $pdoAgent->query("INSERT INTO placeorder (idOrder,IdCompanyOrder, IdUserOrder, IdMenuOrder,
        Quantity, TotalPrice) 
        VALUES (:orderID, :companyId, :userId, :menuId, :qty, :totalprice);");

        $orderID = 1;
        // if(isset($order['orderID'])){
        //     $orderID = $order['orderID'];
        // }
        // else{
        //     $orderID = $this->getLastID();
        // }

        $pdoAgent->bind(':orderID', $orderID);
        $pdoAgent->bind(':companyId',$order['companyId']);
        $pdoAgent->bind(':userId',$order['userId']);
        $pdoAgent->bind(':menuId',$order['menuId']);
        $pdoAgent->bind(':qty',$order['quantity']);
        $pdoAgent->bind(':totalprice',$order['totalPrice']);

        $pdoAgent->execute();

        return $pdoAgent->lastInsertId();
    }

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

    function getLastID(){
        $id = 0;
        $pdoAgent = new DatabaseAgent;
        $pdoAgent->query("SELECT MAX(idOrder) FROM placeorder;");
        $id = $pdoAgent->single();
        return $id['MAX(idOrder)']+1;
    }
}

?>