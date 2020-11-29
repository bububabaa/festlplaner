<!DOCTYPE html>
<html>
<style>
    #eingaben {
        width: 600px;
    }

    input[type=text]#logmail,
    input[type=password]#logpass {
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
    header("location: profil.php");
    exit;
}

// Include config file
require_once __DIR__.'/config/database.php';

// Define variables and initialize with empty values
$username = $password = "";
$username_err = $password_err = "";

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
        $sql = "SELECT BID, Email, Passwort FROM benutzer WHERE Email = :username";

        if($stmt = $pdo->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":username", $param_username, PDO::PARAM_STR);

            // Set parameters
            $param_username = trim($_POST["username"]);

            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // Check if username exists, if yes then verify password
                if($stmt->rowCount() == 1){
                    if($row = $stmt->fetch()){
                        $id = $row["BID"];
                        $username = $row["Email"];
                        $hashed_password = $row["Passwort"];
                        //echo $username;
                        //echo $password;
                        //echo $hashed_password;
                        if(password_verify($password, $hashed_password)){
                        //if(strcmp($password, $hashed_password) == 0){
                            // Password is correct, so start a new session
                            session_start();

                            // Store data in session variables
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["username"] = $username;

                            // Redirect user to welcome page
                            header("location: profil.php");
                        } else{
                            // Display an error message if password is not valid
                            $password_err = "Das Passwort ist inkorrekt.";
                        }
                    }
                } else{
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
?>

<!DOCTYPE html>
<html lang="de">

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
                                            <h2>Login</h2>
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
                                                    <input type="submit" class="btn btn-primary" value="Login">
                                                    <input type="reset" class="btn btn-default" value="Reset">
                                                </div>
                                                <?php
                                               // error_reporting(-1);
                                                //ini_set('display_errors','On');
                                                //require __DIR__.'/registrieren.php'?>
                                                <p>Haben Sie bereits einen Account? <a href="./registrieren.php">Registrieren Sie sich jetzt</a>.</p>

                                            </form>
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

        <!-- Sidebar -->

        <div id="sidebar">

            <div class="inner">

                <!-- Search Box -->
                <section id="search" class="alt">
                    <form method="get" action="#">
                        <input type="text" name="search" id="search" placeholder="Search..." />
                    </form>
                </section>

                <!-- Menu -->
                <nav id="menu">
                    <ul>
                        <li><a href="index.php">Homepage</a></li>
                        <li><a href="login.php">Login</a></li>
                        <li><a href="shortcodes.php">Shortcodes</a></li>
                        <li><a href="kalender.php">Kalender</a></li>
                        <li><a href="galerie.php">Galerie</a></li>
                        <li><a href="karte.php">Karte</a></li>
                        <li>
                            <span class="opener">Abos</span>
                            <ul>
                                <li><a href="#">Abo 1</a></li>
                                <li><a href="#">Abo 2</a></li>
                                <li><a href="#">Abo 3</a></li>
                            </ul>

                        <li><a target="_blank" href="https://hakmistelbach.ac.at/">externer Link</a></li>
                        <li><a href="ueberuns.php">Über uns</a></li>
                    </ul>
                </nav>

                <!-- Footer -->
                <footer id="footer">
                    <p class="copyright">Copyright &copy; 2021 Festlplaner &amp; Co. KG
                        <br>Erstellt von <a rel="nofollow" href="">Uns</a>
                    </p>
                </footer>

            </div>
        </div>
    </div> <!-- Wrapper -->

    <!-- Scripts -->
    <!-- Bootstrap core JavaScript -->
    <script src="assets/jquery/jquery.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>

    <script src="assets/js/browser.min.js"></script>
    <script src="assets/js/breakpoints.min.js"></script>
    <script src="assets/js/transition.js"></script>
    <script src="assets/js/owl-carousel.js"></script>
    <script src="assets/js/custom.js"></script>

</body>

</html>
