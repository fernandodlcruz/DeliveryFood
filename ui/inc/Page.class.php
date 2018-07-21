<?php

class Page {

public static $title = "Please set your title";

    static function header()   { ?>

        <!DOCTYPE html>
        <html>
            <head>
            <!--Import Google Icon Font-->
            <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
            <!--Import materialize.css-->
            <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>

            <!--Let browser know website is optimized for mobile-->
            <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
            
            </head>

            <body>

            <!--JavaScript at end of body for optimized loading-->
            <script type="text/javascript" src="js/materialize.min.js"></script>
            <div class="container">
    
        
    <?php }

    static function navbar()    {   ?>
        
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

    static function footer()    { ?>
        </div>
            </body>
        </html>
    <?php }

    static function showLogin() { ?>
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
    <?php }

    static function showMessages() {
        //Iterate through the messages
        foreach ($_SESSION['messages'] as $message) {
            //Show the message
            echo '<div class="card-panel #fff9c4 yellow lighten-4">'.$message.'</div>';
        }

        //Reset the messages after showing them
        $_SESSION['messages'] = array();
    }
}
?>