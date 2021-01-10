<?php
// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}

// Include config file
require_once __DIR__.'/config/database.php';

// Define variables and initialize with empty values
$new_psw = $confirm_psw = "";
$new_psw_err = $confirm_psw_err = "";

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){

    // Validate new password
    if(empty(trim($_POST["new_psw"]))){
        $new_psw_err = "Bitte geben Sie Ihr neues Passwort ein.";
    } elseif(strlen(trim($_POST["new_psw"])) < 6){
        $new_psw_err = "Das Passwort muss mindestens 6 Zeichen haben.";
    } else{
        $new_psw = trim($_POST["new_psw"]);
    }

    // Validate confirm password
    if(empty(trim($_POST["confirm_psw"]))){
        $confirm_psw_err = "Bitte bestätigen Sie Ihr Passwort.";
    } else{
        $confirm_psw = trim($_POST["confirm_psw"]);
        if(empty($new_psw_err) && ($new_psw != $confirm_psw)){
            $confirm_psw_err = "Passwort stimmt nicht überein..";
        }
    }

    // Check input errors before updating the database
    if(empty($new_psw_err) && empty($confirm_psw_err)){
        // Prepare an update statement
        $sql = "UPDATE benutzer SET Passwort = :psw WHERE BID = :id";

        if($stmt = $pdo->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":psw", $param_psw, PDO::PARAM_STR);
            $stmt->bindParam(":id", $param_id, PDO::PARAM_INT);

            // Set parameters
            $param_psw = password_hash($new_psw, PASSWORD_DEFAULT);
            $param_id = $_SESSION["id"];

            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // Password updated successfully. Destroy the session, and redirect to login page
                session_destroy();
                header("location: login.php");
                exit();
            } else{
                echo "Oops! Something went wrong. Please try again later.";
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

    <title>Passwort zurücksetzen</title>

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
                                            <!--<head>
    <meta charset="UTF-8">
    <title>Passwort zurücksetzen</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        body{ font: 14px sans-serif; }
        .wrapper{ width: 350px; padding: 20px; }
    </style>
</head>
<body>-->

                                            <h2>Passwort zurücksetzen</h2>
                                            <p>Bitte füllen Sie diese Felder aus, um Ihr Passwort zurückzusetzen.</p>
                                            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                                                <div class="form-group <?php echo (!empty($new_pswerr)) ? 'has-error' : ''; ?>">
                                                    <label>Neues Passwort</label>
                                                    <input type="password" name="new_psw" class="form-control" value="<?php echo $new_psw; ?>">
                                                    <span class="help-block"><?php echo $new_psw_err; ?></span>
                                                </div>
                                                <div class="form-group <?php echo (!empty($confirm_psw_err)) ? 'has-error' : ''; ?>">
                                                    <label>Passwort bestätigen</label>
                                                    <input type="password" name="confirm_psw" class="form-control">
                                                    <span class="help-block"><?php echo $confirm_psw_err; ?></span>
                                                </div>
                                                <div class="form-group">
                                                    <input type="submit" class="btn btn-primary" value="Senden">
                                                    <a class="btn btn-link" href="profil.php">Abbrechen</a>
                                                </div>
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

        <?php
error_reporting(-1);
ini_set('display_errors','On');
require __DIR__.'/templates/templateSidebar.php'?>

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
