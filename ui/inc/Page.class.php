<?php

class Page {
    public static $title = "Group Project";

    static function header() {?>
        <!DOCTYPE html>
        <html>
            <head>
                <!--Import Google Icon Font-->
                <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
                <!--Import materialize.css-->
                <link type="text/css" rel="stylesheet" href="style.css"/>
                
                <!--link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/-->
                <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-rc.2/css/materialize.min.css">

                <!--Let browser know website is optimized for mobile-->
                <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
                
                <title>Sign-up</title>
            </head>
            <body id="body-color">
    <?php }

    static function footer() { ?>
        </div>
                <!--JavaScript at end of body for optimized loading-->
                <!--script type="text/javascript" src="js/materialize.min.js"></script-->
                <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
                <!-- Compiled and minified JavaScript -->
                <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-rc.2/js/materialize.min.js"></script>    
                <script>
                    $(document).ready(function(){
                        $('.tabs').tabs();
                    });
                </script>
            </body>
        </html>
    <?php }

    static function navbar() {?>
        <nav>
            <div class="nav-wrapper">
            <a href="#" class="brand-logo">&emsp;<?php echo self::$title; ?></a>
            <ul id="nav-mobile" class="right hide-on-med-and-down">
                <?php
                //Check if the user is logged in
                if (isset($_SESSION['logged']) && $_SESSION['logged']) {
                        //If they are show a logout button that sends them to logout.php
                        echo '<li><a href="logout.php">Logout</a></li>';
                } else {
                        //If they arent show a login button (link to the controller file)
                        echo '<li><a href="Lab09FCr_63758.php">Login</a></li>';
                }
                ?>
            </ul>
            </div>
        </nav>
    <?php }

    static function showLogin() { ?>
        <div class="row"></div>
        <div class="container">
            <ul id="login_signup" class="tabs tabs-fixed-width">
                <li class="tab col s3"><a class="active" href="#login">Login</a></li>
                <li class="tab col s3"><a href="#signup">Signup</a></li>
            </ul>
            <div id="login" class="col s12">
                <div class="row">
                    <form class="col s12" method="POST" action="">
                    <div class="row">
                        <div class="input-field col s12">
                            <i class="material-icons prefix">account_circle</i>
                            <input id="username" name="username" type="text" class="validate">
                            <label for="icon_prefix">Username</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12">
                        <i class="material-icons prefix">lock</i>
                        <input id="password" name="password" type="password" class="validate">
                        <label for="password">Password</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12">
                        <button class="btn waves-effect waves-light" type="submit" name="action">Login
                            <i class="material-icons right">send</i>
                        </button>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
            <div id="signup" class="col s12">
                <div class="row">
                    <form class="col s12" method="POST" action="">
                        <div class="row">
                            <div class="switch">
                                <label>
                                    I am a company
                                    <input type="checkbox" name="chkCustomer" id="chkCustomer">
                                    <span class="lever"></span>
                                    I am a customer
                                </label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s12">
                                <i class="material-icons prefix">account_circle</i>
                                <input id="username" name="username" type="text" class="validate">
                                <label for="icon_prefix">Name</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s12">
                                <i class="material-icons prefix">alternate-email</i>
                                <input id="email" name="email" type="text" class="validate">
                                <label for="icon_prefix">E-mail</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s12">
                                <i class="material-icons prefix">phone</i>
                                <input id="phone" name="phone" type="text" class="validate">
                                <label for="icon_prefix">Phone number</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s12">
                            <i class="material-icons prefix">lock</i>
                            <input id="password" name="password" type="password" class="validate">
                            <label for="password">Password</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s12">
                            <i class="material-icons prefix">lock</i>
                            <input id="confPassword" name="confPassword" type="password" class="validate">
                            <label for="password">Confirm Password</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s12">
                            <button class="btn waves-effect waves-light" type="submit" name="action">Signup
                                <i class="material-icons right">send</i>
                            </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            </div>
    <?php }
}
?>