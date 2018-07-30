<?php

class BusinessPage extends Page {
    static function jsBundle() { ?>
        <!--JavaScript at end of body for optimized loading-->
        <!--script type="text/javascript" src="js/materialize.min.js"></script-->
        <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
        <!-- Compiled and minified JavaScript -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-rc.2/js/materialize.min.js"></script>
        <script src="js/config.js"></script>
        <script src="js/business.js"></script>
    <?php }

static function showAllOrders() {?>
    <div class="container">
        <div class="row">
            <h3 class="header">All orders placed</h3>
        </div>

        <div class="row">
            <table>
                <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Company ID</th>
                    <th>User ID</th>
                    <th>Item ID</th>
                    <th>Quantity</th>
                    <th>Total price</th>
                </tr>
                </thead>
                <tbody id="orders">
                </tbody>
            </table>
        </div>
    </div>
<?php }

static function showMenu() {?>
    <div class="container">
        <div class="row">
            <h3 class="header">All items in the menu</h3>
        </div>
        <div class="row">
            <table>
                <thead>
                <tr>
                    <th>Menu ID</th>
                    <th>Item</th>
                    <th>Description</th>
                    <th>Unit</th>
                    <th>Price</th>
                </tr>
                </thead>
                <tbody id="menuItems">
                </tbody>
            </table>
        </div>
    </div>
<?php }


   

}