<?php

class CustomerPage extends Page {
    static function jsBundle() { ?>
        <!--JavaScript at end of body for optimized loading-->
        <!--script type="text/javascript" src="js/materialize.min.js"></script-->
        <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
        <!-- Compiled and minified JavaScript -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-rc.2/js/materialize.min.js"></script>
        <script src="js/config.js"></script>
        <script src="js/customer.js"></script>
    <?php }

    static function showMenuSelection() {?>
        <div class="container">
            <div class="row">
                <div class="input-field col s12">
                    <select id="business" name="business">
                        <option value="" disabled selected>Choose your option</option>                                    
                    </select>
                <label>Select your restaurant</label>
                </div>
            </div>

            <div class="row">
                <div class="fixed-action-btn">
                    <a class="btn-floating btn-large red tooltipped disabled" data-position="top" data-tooltip="Add your items to the cart">
                        <i class="large material-icons">shopping_cart</i>
                    </a>
                </div>
                <div id="menuView" style="display: none">
                    <h3 class="header">Choose from menu</h3>
                    <ul class="collapsible popout" id="menuList">
                    </ul>
                </div>
            </div>
        </div>
    <?php }

    static function showConfirmation() {?>
        <div class="container">
            <div class="row">
                <h3 class="header">Confirm your order</h3>
            </div>

            <div class="row">
                <table>
                    <thead>
                    <tr>
                        <th>Item</th>
                        <th>Price</th>
                        <th>Quantity</th>
                    </tr>
                    </thead>
                    <tbody id="menuItems">
                    </tbody>
                </table>
                <p class="right-align"><b>Total of your order: $<span id="totalOrder"></span></b></p>
            </div>
        </div>
    <?php }

    static function showAddressForm() {?>
        <div class="container">
            <div class="row">
                <h4 class="header">Inform your address</h4>
            </div>

            <div class="row">
                <div class="col s6">
                    <h5 class="header">Select from the list or</h5>
                    <span id="addressList"></span>
                </div>
                <div class="col s6">
                    <h5 class="header">Inform a new address</h5>
                    <form class="col s12" method="POST" action="">
                        <input id="hdnUid" name="hdnUid" type="hidden" value="<?php echo $_SESSION['idUser']; ?>">
                        <div class="row">
                            <div class="input-field col s12">
                                <input id="addressLine1" name="addressLine1" type="text" class="validate">
                                <label for="addressLine1">Address Line 1</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s12">
                                <input id="addressLine2" name="addressLine2" type="text" class="validate">
                                <label for="addressLine2">Address Line 2</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s4">
                                <input id="city" name="city" type="text" class="validate">
                                <label for="city">City</label>
                            </div>
                            <div class="input-field col s4">
                                <input id="stateProv" name="stateProv" type="text" class="validate">
                                <label for="stateProv">State/Province</label>
                            </div>
                            <div class="input-field col s4">
                                <input id="postalCode" name="postalCode" type="text" class="validate">
                                <label for="postalCode">Postal Code</label>
                            </div>
                        </div>                        
                    </form>
                </div>
            </div>
            <div class="row center">
                <div class="input-field col s12">
                <button class="btn waves-effect waves-light" type="button" name="btnPlaceOrder" id="btnPlaceOrder">Place Order
                    <i class="material-icons right">send</i>
                </button>
                </div>
            </div>
        </div>
    <?php }

    static function createModal() {?>
        <div id="modalFinish" class="modal">
            <div class="modal-content">
                <h4>All Done!</h4>
                <i class="large material-icons">check_circle_outline</i>
                <p>You´ve completed your order! Now just wait until your food has been delivered!</p>
            </div>
            <div class="modal-footer">
                <a href="#!" class="modal-close waves-effect waves-green btn-flat">Ok</a>
            </div>
        </div>
    <?php }
}