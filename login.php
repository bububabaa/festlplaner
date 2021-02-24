<!DOCTYPE html>
<html>
<style>
    #eingaben {
        width: 600px;
    }

    input[type=text]#logmail,
    input[type=password]#logpass {
        height: 50px;
        width: 100%;
        padding: 15px;
        margin: 5px 0 22px 0;
        display: inline-block;
        border: none;
        background: #f1f1f1;
    }

    input[type=text]#logmail:focus,
    input[type=password]#logpass:focus {
        background-color: #e1e1e1;
        outline: none;
    }
</style>

<?php
// Initialize the session
session_start();

// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){

 $user_ist_ = $_SESSION['user_ist'];
    switch($user_ist_) {
        case 'anbieter': $user_ist_ = 'anbieter';
            header("location: anbieterprofil.php");
            break;
            case 'benutzer': $user_ist_ = 'benutzer';
            header("location: profil.php");
            break;
            case 'admin': $user_ist_ = 'admin';
            header("location: admin.php");
           //echo("<script>location.href='/admin.php';</script>");
            break;
    }
    exit;
}

// Include config file
require_once __DIR__.'/config/database.php';

// Define variables and initialize with empty values
$username = $password = $usernamebenutzer = $passwordbenutzer ="";
$username_err = $password_err = $usernamebenutzer_err = $passwordbenutzer_err ="";
$bgid =0;
$user_ist="";

if(isset($_POST['submit1']))
{
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){

    // Check if username is empty
    if(empty(trim($_POST["usernamebenutzer"]))){
        $usernamebenutzer_err = "Bitte geben Sie eine Email ein.";
    } else{
        $usernamebenutzer = trim($_POST["usernamebenutzer"]);
    }

    // Check if password is empty
    if(empty(trim($_POST["passwordbenutzer"]))){
        $passwordbenutzer_err = "Bitte geben Sie ein Passwort ein.";
    } else{
        $passwordbenutzer = trim($_POST["passwordbenutzer"]);
    }

    // Validate credentials
    if(empty($usernamebenutzer_err) && empty($passwordbenutzer_err)){
        // Prepare a select statement
        $user_ist="";
        $sql = "SELECT BID, BGID, Email, Passwort FROM benutzer WHERE Email = :usernamebenutzer";
         // $sql = "SELECT AID, Email, Passwort FROM anbieter WHERE Email = :username";

        if($stmt = $pdo->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":usernamebenutzer", $param_usernamebenutzer, PDO::PARAM_STR);

            // Set parameters
            $param_usernamebenutzer = trim($_POST["usernamebenutzer"]);

            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // Check if username exists, if yes then verify password
                if($stmt->rowCount() == 1){
                    if($row = $stmt->fetch()){
                        $bid = $row["BID"];
                        //$id = $row["AID"];
                        $usernamebenutzer = $row["Email"];
                        $bgid =$row["BGID"];
                        $hashed_passwordbenutzer = $row["Passwort"];
                        //$user_ist="anbieter";
                        //echo $bgid;
                        //echo $password;
                        //echo $hashed_password;
                        if(password_verify($passwordbenutzer, $hashed_passwordbenutzer)){
                        //if(strcmp($password, $hashed_password) == 0){
                            // Password is correct, so start a new session
                            //session_start();

                            // Store data in session variables
                            $_SESSION["loggedin"] = true;
                            $_SESSION["bid"] = $bid;
                            $_SESSION["usernamebenutzer"] = $usernamebenutzer;
                            $_SESSION["bgid"]=$bgid;
                            //echo $bgid;

                            if($bgid == 2)
                            {
                                $user_ist="admin";
                                $_SESSION["user_ist"]=$user_ist;
                                header("location: admin.php");
                                //echo("<script>location.href='/festlplaner/admin.php';</script>");

                            }
                            else if($bgid == 1)
                            {
                            // Redirect user to welcome page
                                $user_ist="benutzer";
                                $_SESSION["user_ist"]=$user_ist;
                                header("location: profil.php");
                            }
                            // header("location: admin.php");
                            //header("location: anbieterprofil.php");
                        } else{
                            // Display an error message if password is not valid
                            $passwordbenutzer_err = "Das Passwort ist inkorrekt.";
                        }
                    }
                }
                else{
                    // Display an error message if username doesn't exist
                    $usernamebenutzer_err = "Diese Email ist unbekannt.";
                }
            } else{
                echo "Oops! Etwas ist schief gelaufen. Bitte probieren Sie es später noch einmal.";
            }

            // Close statement
            unset($stmt);
        }
    }

    // Close connection
    unset($pdo);
}
}

if(isset($_POST['submit2']))
{
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){

    // Check if username is empty
    if(empty(trim($_POST["username"]))){
        $username_err = "Bitte geben Sie eine Email ein.";
    } else{
        $username = trim($_POST["username"]);
    }

    // Check if password is empty
    if(empty(trim($_POST["password"]))){
        $password_err = "Bitte geben Sie ein Passwort ein.";
    } else{
        $password = trim($_POST["password"]);
    }

    // Validate credentials
    if(empty($username_err) && empty($password_err)){
        // Prepare a select statement
        $user_ist="";
        //$sql = "SELECT BID, BGID, Email, Passwort FROM benutzer WHERE Email = :username";
          $sql = "SELECT AID, Email, Passwort FROM anbieter WHERE Email = :username";

        if($stmt = $pdo->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":username", $param_username, PDO::PARAM_STR);

            // Set parameters
            $param_username = trim($_POST["username"]);

            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // Check if username exists, if yes then verify password
                if($stmt->rowCount() == 1){
                    if($row = $stmt->fetch()){;
                        $id = $row["AID"];
                        $username = $row["Email"];
                        $hashed_password = $row["Passwort"];
                        $user_ist="anbieter";
                        //echo $username;
                        //echo $password;
                        //echo $hashed_password;
                        if(password_verify($password, $hashed_password)){
                        //if(strcmp($password, $hashed_password) == 0){
                            // Password is correct, so start a new session


                            // Store data in session variables
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["username"] = $username;

                            $user_ist="anbieter";
                            $_SESSION["user_ist"]=$user_ist;
                            header("location: anbieterprofil.php");
                        } else{
                            // Display an error message if password is not valid
                            $password_err = "Das Passwort ist inkorrekt.";
                        }
                    }
                }
                else{
                    // Display an error message if username doesn't exist
                    $username_err = "Diese Email ist unbekannt.";
                }
            } else{
                echo "Oops! Etwas ist schief gelaufen. Bitte probieren Sie es später noch einmal.";
            }

            // Close statement
            unset($stmt);
        }
    }

    // Close connection
    unset($pdo);
}
}
?>

<!DOCTYPE html>
<html lang="de">
<link rel="icon" type="image/x-icon" href="assets/images/favicon.ico">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700" rel="stylesheet">

    <title>Festlplaner</title>

    <!-- Bootstrap core CSS -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">

    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="assets/css/fontawesome.css">
    <link rel="stylesheet" href="assets/css/templatemo-style.css">
    <link rel="stylesheet" href="assets/css/owl.css">

    <!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">-->
</head>

<body class="is-preload">

    <!-- Wrapper -->
    <div id="wrapper">

        <!-- Main -->
        <div id="main">
            <div class="inner">

                <!-- Header -->
                <header id="header">
                    <div class="logo">
                        <a href="index.php">Festlplaner</a>
                    </div>
                </header>

                <!--ab hier Code einfügen-->
                <section class="main-banner">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="banner-caption">
                                           <div class="wrapper">
                                                    <div class="tab">
                                                        <button class="tablinks" onclick="openTab(event, 'Benutzer')" id="defaultOpen">Benutzer</button>
                                                        <button class="tablinks" onclick="openTab(event, 'Anbieter')">Anbieter</button>
                                                    </div>

                                                    <div id="Benutzer" class="tabcontent">
                                                        <h2>Benutzer Login</h2>
                                                            <p>Bitte geben Sie Ihre Benutzerdaten an.</p>
                                                            <form id="eingaben" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                                                                <div class="form-group <?php echo (!empty($usernamebenutzer_err)) ? 'has-error' : ''; ?>">
                                                                    <label>E-Mail</label>
                                                                    <input type="text" id="logmail" name="usernamebenutzer" placeholder="E-Mail eingeben" class="form-control" value="<?php echo $usernamebenutzer; ?>">
                                                                    <span class="help-block"><?php echo $usernamebenutzer_err; ?></span>
                                                                </div>
                                                                <div class="form-group <?php echo (!empty($passwordbenutzer_err_err)) ? 'has-error' : ''; ?>">
                                                                    <label>Passwort</label>
                                                                    <input type="password" id="logpass" name="passwordbenutzer" placeholder="Passwort" class="form-control">
                                                                    <span class="help-block"><?php echo $passwordbenutzer_err; ?></span>
                                                                </div>
                                                                <div class="form-group">
                                                                    <input type="submit" name="submit1" class="btn btn-primary" value="Login">
                                                                    <input type="reset" name="reset1" class="btn btn-default" value="Reset">
                                                                </div>
                                                                <p>Haben Sie noch keinen Account? <a href="./registrieren.php">Registrieren Sie sich jetzt</a>.</p>

                                                            </form>
                                                    </div>

                                                    <div id="Anbieter" class="tabcontent">
                                                        <h2>Anbieter Login</h2>
                                                           <p>Bitte geben Sie Ihre Benutzerdaten an.</p>
                                                           <form id="eingaben" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                                                               <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                                                                   <label>E-Mail</label>
                                                                   <input type="text" id="logmail" name="username" placeholder="E-Mail eingeben" class="form-control" value="<?php echo $username; ?>">
                                                                   <span class="help-block"><?php echo $username_err; ?></span>
                                                               </div>
                                                               <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                                                                   <label>Passwort</label>
                                                                   <input type="password" id="logpass" name="password" placeholder="Passwort" class="form-control">
                                                                   <span class="help-block"><?php echo $password_err; ?></span>
                                                               </div>
                                                               <div class="form-group">
                                                                   <input type="submit" name="submit2" class="btn btn-primary" value="Login">
                                                                   <input type="reset" name="reset2" class="btn btn-default" value="Reset">
                                                               </div>
                                                               <p>Haben Sie noch keinen Account? <a href="./registrieren.php">Registrieren Sie sich jetzt</a>.</p>

                                                           </form>
                                                    </div>
                                           </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!--bis hier Code einfügen-->

            </div>
        </div>

        <?php
error_reporting(-1);
ini_set('display_errors','On');
require __DIR__.'/templates/templateSidebar.php'?>

    </div> <!-- Wrapper -->

    <!-- Scripts -->
    <!-- Bootstrap core JavaScript -->
<?php
error_reporting(-1);
ini_set('display_errors','On');
    require __DIR__.'/templates/templateScripts.php'?>

    <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>-->

    <!--<script>
        $(document).ready(function() {
            $(".nav-tabs a").click(function() {
                $(this).tab('show');
            });
        });
    </script>-->

    <script>
        function openTab(evt, tabName) {
            // Declare all variables
            var i, tabcontent, tablinks;

            // Get all elements with class="tabcontent" and hide them
            tabcontent = document.getElementsByClassName("tabcontent");
            for (i = 0; i < tabcontent.length; i++) {
                tabcontent[i].style.display = "none";
            }

            // Get all elements with class="tablinks" and remove the class "active"
            tablinks = document.getElementsByClassName("tablinks");
            for (i = 0; i < tablinks.length; i++) {
                tablinks[i].className = tablinks[i].className.replace(" active", "");
            }

            // Show the current tab, and add an "active" class to the button that opened the tab
            document.getElementById(tabName).style.display = "block";
            evt.currentTarget.className += " active";
        }
    </script>

    <script>
        // Get the element with id="defaultOpen" and click on it
        document.getElementById("defaultOpen").click();
    </script>

    <style>
        /* Style the tab */
        .tab {
            overflow: hidden;
            border: 1px solid #ccc;
            background-color: #f1f1f1;
        }

        /* Style the buttons that are used to open the tab content */
        .tab button {
            background-color: inherit;
            float: left;
            border: none;
            outline: none;
            cursor: pointer;
            padding: 14px 16px;
            transition: 0.3s;
        }

        /* Change background color of buttons on hover */
        .tab button:hover {
            background-color: #ddd;
        }

        /* Create an active/current tablink class */
        .tab button.active {
            background-color: #ccc;
        }

        /* Style the tab content */
        .tabcontent {
            display: none;
            padding: 6px 12px;
            border: 1px solid #ccc;
            border-top: none;
        }
        .tabcontent {
            animation: fadeEffect 1s; /* Fading effect takes 1 second */
        }

        /* Go from zero to full opacity */
        @keyframes fadeEffect {
            from {opacity: 0;}
            to {opacity: 1;}
        }
    </style>

</body>

</html>
