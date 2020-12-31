<!DOCTYPE html>
<html>
<style>
    * {
        box-sizing: border-box;
    }

    .wrapper {
        width: 350px;
    }

    #registrieren {
        color: dodgerblue;
        text-decoration: underline;
    }

    /* Full-width input fields */
    input[type=text]#regmail,
    input[type=text]#regvor,
    input[type=text]#regnach,
    input[type=date]#reggebdat,
    input[type=password]#regpass,
    input[type=password]#regpassagain {
        width: 100%;
        padding: 15px;
        margin: 5px 0 22px 0;
        display: inline-block;
        border: none;
        background: #f1f1f1;
    }

    div[id=YesNo] {
        width: 10%;
    }

    /* Add a background color when the inputs get focus */
    input[type=text]#regmail:focus,
    input[type=text]#regvor:focus,
    input[type=text]#regnach:focus,
    input[type=date]#reggebdat:focus,
    input[type=password]#regpass:focus,
    input[type=password]#regpassagain:focus {
        background-color: #e1e1e1;
        outline: none;
    }

    /* Set a style for all buttons */
    button {
        background-color: #535ba0;
        color: white;
        padding: 14px 20px;
        margin: 8px 0;
        border: none;
        cursor: pointer;
        width: 100%;
        opacity: 0.9;
    }

    button:hover {
        opacity: 1;
    }

    /* Extra styles for the cancel button */
    .cancelbtn {
        padding: 14px 20px;
        color: black;
        background-color: transparent;
    }

    /* Float cancel and signup buttons and add an equal width */
    .cancelbtn,
    .signupbtn {
        float: left;
        width: 50%;
    }

    /* Add padding to container elements */
    .container {
        padding: 16px;
    }

    /* The Modal (background) */
    .modal {
        display: none;
        /* Hidden by default */
        position: fixed;
        /* Stay in place */
        z-index: 1;
        /* Sit on top */
        left: 0;
        top: 0;
        width: 100%;
        /* Full width */
        height: 100%;
        /* Full height */
        overflow: auto;
        /* Enable scroll if needed */
        background-color: #ffffff;
        padding-top: 50px;
    }

    /* Modal Content/Box */
    .modal-content {
        background-color: #fefefe;
        margin: 5% auto 15% auto;
        /* 5% from the top, 15% from the bottom and centered */
        border: 1px solid #888;
        width: 80%;
        /* Could be more or less, depending on screen size */
    }

    /* Style the horizontal ruler */
    hr {
        border: 1px solid #f1f1f1;
        margin-bottom: 25px;
    }

    /* The Close Button (x) */
    .close {
        position: absolute;
        right: 35px;
        top: 15px;
        font-size: 40px;
        font-weight: bold;
        color: #454545;
    }

    .close:hover,
    .close:focus {
        color: #f44336;
        cursor: pointer;
    }

    /* Clear floats */
    .clearfix::after {
        content: "";
        clear: both;
        display: table;
    }

    /* Change styles for cancel button and signup button on extra small screens */
    @media screen and (max-width: 300px) {

        .cancelbtn,
        .signupbtn {
            width: 100%;
        }
    }


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
</style>

<?php
// Include config file
require_once __DIR__.'/config/database.php';

// Define variables and initialize with empty values
$email = $vorname = $nachname = $gebdat = $psw = $confirm_psw = "";
$bgid="1";
$email_err = $vorname_err = $nachname_err = $gebdat_err = $bgid_err = $psw_err = $confirm_psw_err = "";
$verified=FALSE;

// Define variables and initialize with empty values
$emaila = $name = $plz = $ort = $strasse = $ansprechp = $telefon = $pswa = $confirm_pswa = "";
$emaila_err = $name_err = $ort_err = $plz_err = $strasse_err = $ansprechp_err = $telefon_err = $pswa_err = $confirm_pswa_err = $verified_err="";

if(isset($_POST['submit1']))
{
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){

    // Validate username
    if(empty(trim($_POST["email"]))){
        $email_err = "Bitte geben Sie Ihre Email ein.";
    } else{
        // Prepare a select statement
        $sql = "SELECT BID FROM benutzer WHERE Email = :email";

        if($stmt = $pdo->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":email", $param_email, PDO::PARAM_STR);

            // Set parameters
            $param_email = trim($_POST["email"]);

            // Attempt to execute the prepared statement
            if($stmt->execute()){
                if($stmt->rowCount() == 1){
                    $email_err = "Diese Email ist bereits vergeben.";
                } else{
                    $email = trim($_POST["email"]);
                    //echo $email;
                }
            } else{
                echo "Oops! Etwas ist schief gelaufen. Bitte probieren Sie es später noch einmal.";
            }

            // Close statement
            unset($stmt);
        }
    }
    if(empty(trim($_POST["vorname"]))){
        $vorname_err = "Bitte geben Sie Ihren Vornamen ein.";
    }
    else{
        $vorname = trim($_POST["vorname"]);
        //echo $vorname;
    }

    if(empty(trim($_POST["nachname"]))){
        $nachname_err = "Bitte geben Sie Ihren Nachnamen ein.";
    }
    else{
        $nachname = trim($_POST["nachname"]);
        //echo $nachname;
    }

    if(empty(trim($_POST["gebdat"]))){
        $gebdat_err = "Bitte geben Sie Ihr Geburtsdatum ein.";
    }
    else{
        $gebdat = trim($_POST["gebdat"]);
        // echo $gebdat;
    }

    $bgid = trim($_POST["bgid"]);
   // echo $bgid;

    // Validate password
    if(empty(trim($_POST["psw"]))){
        $psw_err = "Bitte geben Sie ein Passwort ein.";
    } elseif(strlen(trim($_POST["psw"])) < 6){
        $psw_err = "Das Passwort muss mindestens 6 Zeichen haben.";
    } else{
        $psw = trim($_POST["psw"]);
       // echo $psw;
    }

    // Validate confirm password
    if(empty(trim($_POST["confirm_psw"]))){
        $confirm_psw_err = "Bitte bestätigen Sie Ihr Passwort.";
    } else{
        $confirm_psw = trim($_POST["confirm_psw"]);
        if(empty($psw_err) && ($psw != $confirm_psw)){
            $confirm_psw_err = "Passwort stimmt nicht überein.";
        }
    }

    // Check input errors before inserting in database
    if(empty($email_err) && empty($psw_err) && empty($confirm_psw_err) && empty($vorname_err) && empty($nachname_err) && empty($gebdat_err)){

        // Prepare an insert statement
        $sql = "INSERT INTO benutzer (Vorname, Nachname, Gebdat, BGID, Email, Passwort) VALUES (:vorname, :nachname, :gebdat, :bgid, :email, :psw)";
        // $sql = "INSERT INTO benutzer (Vorname, Nachname, Gebdat, Email, Passwort) VALUES (:vorname, :nachname, :gebdat, :email, :psw)";

        if($stmt = $pdo->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":vorname", $param_vorname, PDO::PARAM_STR);
            $stmt->bindParam(":nachname", $param_nachname, PDO::PARAM_STR);
            $stmt->bindParam(":gebdat", $param_gebdat, PDO::PARAM_STR);
            $stmt->bindParam(":bgid", $param_bgid, PDO::PARAM_STR);
            $stmt->bindParam(":email", $param_email, PDO::PARAM_STR);
            $stmt->bindParam(":psw", $param_psw, PDO::PARAM_STR);

            // Set parameters
            $param_vorname = $vorname;
            $param_nachname = $nachname;
            $param_gebdat = $gebdat;
            $param_bgid = $bgid;
            $param_email = $email;
           // $param_psw = psw_hash($psw, PASSWORD_DEFAULT); // Creates a password hash
            $psw= password_hash($psw, PASSWORD_DEFAULT); // Creates a password hash
            $param_psw = $psw;

            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // Redirect to login page
                header("location: login.php");
            } else{
                echo "Etwas ist schief gelaufen. Bitte probieren Sie es später noch einmal.";
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

    // Validate username
    if(empty(trim($_POST["emaila"]))){
        $emaila_err = "Bitte geben Sie Ihre Email ein.";
    } else{
        // Prepare a select statement
        $sql = "SELECT AID FROM anbieter WHERE Email = :emaila";

        if($stmt = $pdo->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":emaila", $param_email, PDO::PARAM_STR);

            // Set parameters
            $param_emaila = trim($_POST["emaila"]);

            // Attempt to execute the prepared statement
            if($stmt->execute()){
                if($stmt->rowCount() == 1){
                    $emaila_err = "Diese Email ist bereits vergeben.";
                } else{
                    $emaila = trim($_POST["emaila"]);
                    //echo $email;
                }
            } else{
                echo "Oops! Etwas ist schief gelaufen. Bitte probieren Sie es später noch einmal.";
            }

            // Close statement
            unset($stmt);
        }
    }
    if(empty(trim($_POST["name"]))){
        $name_err = "Bitte geben Sie Ihren Name ein.";
    }
    else{
        $name = trim($_POST["name"]);
        //echo $vorname;
    }

// Function to check string starting
// with given substring
/*function startsWith ($string, $startString)
{
    $len = strlen($startString);
    return (substr($string, 0, $len) === $startString);
} */

    if(empty(trim($_POST["plz"]))){
        $plz_err = "Bitte geben Sie Ihre Postleitzahl ein.";
    }
    elseif(strlen(trim($_POST["plz"])) > 5){
        $plz_err = "Die Postleitzahl darf nicht länger als 4 Stellen sein.";
    }
    /*elseif(startsWith("plz","3")){
        $plz = trim($_POST["plz"]);
    }*/
    else{
        $plz = trim($_POST["plz"]);
        //echo $nachname;
    }

    if(empty(trim($_POST["ort"]))){
        $ort_err = "Bitte geben Sie Ihren Ort ein.";
    }
    else{
        $ort = trim($_POST["ort"]);
        //echo $nachname;
    }

    if(empty(trim($_POST["strasse"]))){
        $strasse_err = "Bitte geben Sie Ihre Straße ein.";
    }
    else{
        $strasse = trim($_POST["strasse"]);
        //echo $nachname;
    }

    if(empty(trim($_POST["ansprechp"]))){
        $ansprechp_err = "Bitte geben Sie Ihre Ansprechsperson ein.";
    }
    else{
        $ansprechp = trim($_POST["ansprechp"]);
        // echo $ansprechp;
    }
    if(empty(trim($_POST["telefon"]))){
        $telefon_err = "Bitte geben Sie Ihre Telefonnummer ein.";
    }
    else{
        $telefon = trim($_POST["telefon"]);
        // echo $telefon;
    }
    // $verified = trim($_POST["verified"]);

    // Validate password
    if(empty(trim($_POST["pswa"]))){
        $pswa_err = "Bitte geben Sie ein Passwort ein.";
    } elseif(strlen(trim($_POST["pswa"])) < 6){
        $pswa_err = "Das Passwort muss mindestens 6 Zeichen haben.";
    } else{
        $pswa = trim($_POST["pswa"]);
       // echo $psw;
    }

    // Validate confirm password
    if(empty(trim($_POST["confirm_pswa"]))){
        $confirm_pswa_err = "Bitte bestätigen Sie Ihr Passwort.";
    } else{
        $confirm_pswa = trim($_POST["confirm_pswa"]);
        if(empty($pswa_err) && ($pswa != $confirm_pswa)){
            $confirm_pswa_err = "Passwort stimmt nicht überein.";
        }
    }

    // Check input errors before inserting in database
    if(empty($emaila_err) && empty($pswa_err) && empty($confirm_pswa_err) && empty($name_err) && empty($plz_err) && empty($ort_err) && empty($strasse_err) && empty($ansprechp_err && empty($telefon_err))){

        // Prepare an insert statement
        $sql = "INSERT INTO anbieter (Name, PLZ, Ort, Strasse, Ansprechsperson, Telefon, Email, Passwort, Verified) VALUES (:name, :plz, :ort, :strasse, :ansprechp, :telefon, :emaila, :pswa,'".$verified."')";

        // $sql = "INSERT INTO benutzer (Vorname, Nachname, Gebdat, Email, Passwort) VALUES (:vorname, :nachname, :gebdat, :email, :psw)";

        if($stmt = $pdo->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":name", $param_name, PDO::PARAM_STR);
            $stmt->bindParam(":plz", $param_plz, PDO::PARAM_STR);
            $stmt->bindParam(":ort", $param_ort, PDO::PARAM_STR);
            $stmt->bindParam(":strasse", $param_strasse, PDO::PARAM_STR);
            $stmt->bindParam(":ansprechp", $param_ansprechp, PDO::PARAM_STR);
            $stmt->bindParam(":telefon", $param_telefon, PDO::PARAM_STR);
            $stmt->bindParam(":emaila", $param_emaila, PDO::PARAM_STR);
            $stmt->bindParam(":pswa", $param_pswa, PDO::PARAM_STR);
           // stmt->bindParam(":verified", $param_verified, PDO::PARAM_STR);

            // Set parameters
            $param_name = $name;
            $param_plz = $plz;
            $param_ort = $ort;
            $param_strasse = $strasse;
            $param_ansprechp = $ansprechp;
            $param_telefon = $telefon;
            $param_email = $emaila;
           // $param_psw = psw_hash($psw, PASSWORD_DEFAULT); // Creates a password hash
            $pswa= password_hash($pswa, PASSWORD_DEFAULT); // Creates a password hash
            $param_pswa = $pswa;
            $param_verified = $verified;

            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // Redirect to login page
            header("location: login.php");
            } else{
                echo "Etwas ist schief gelaufen. Bitte probieren Sie es später noch einmal.";
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

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
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
                                                <h2>Registrieren</h2>
                                                <p>Bitte füllen Sie diese Felder aus, um sich zu registrieren.</p>
                                                <div class="container">
                                                    <ul class="nav nav-tabs">
                                                        <li class="active"><a data-toggle="tab" href="#benutzer">Benutzer</a></li>
                                                        <!--   <li><a data-toggle="tab" href="#benutzer">Benutzer</a></li> -->
                                                        <li><a data-toggle="tab" href="#anbieter">Anbieter</a></li>
                                                    </ul>

                                                    <div class="tab-content">
                                                        <div id="benutzer" class="tab-pane fade in active">
                                                            <!-- <div id="benutzer" class="tab-pane fade">-->
                                                            <h3>Benutzer</h3>

                                                            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                                                                <div class="form-group <?php echo (!empty($email_err)) ? 'has-error' : ''; ?>">
                                                                    <label>Email</label>
                                                                    <input type="text" name="email" class="form-control" value="<?php echo $email; ?>">
                                                                    <span class="help-block"><?php echo $email_err; ?></span>
                                                                </div>
                                                                <div class="form-group <?php echo (!empty($vorname_err)) ? 'has-error' : ''; ?>">
                                                                    <label>Vorname</label>
                                                                    <input type="text" name="vorname" class="form-control" value="<?php echo $vorname; ?>">
                                                                    <span class="help-block"><?php echo $vorname_err; ?></span>
                                                                </div>
                                                                <div class="form-group <?php echo (!empty($nachname_err)) ? 'has-error' : ''; ?>">
                                                                    <label>Nachname</label>
                                                                    <input type="text" name="nachname" class="form-control" value="<?php echo $nachname; ?>">
                                                                    <span class="help-block"><?php echo $nachname_err; ?></span>
                                                                </div>
                                                                <div class="form-group <?php echo (!empty($gebdat_err)) ? 'has-error' : ''; ?>">
                                                                    <label>Geburtsdatum</label>
                                                                    <input type="date" name="gebdat" class="form-control" value="<?php echo $gebdat; ?>">
                                                                    <span class="help-block"><?php echo $gebdat_err; ?></span>
                                                                </div>
                                                                <div class="form-group <?php echo (!empty($psw_err)) ? 'has-error' : ''; ?>">
                                                                    <label>Passwort</label>
                                                                    <input type="password" name="psw" class="form-control" value="<?php echo $psw; ?>">
                                                                    <span class="help-block"><?php echo $psw_err; ?></span>
                                                                </div>
                                                                <div class="form-group <?php echo (!empty($confirm_psw_err)) ? 'has-error' : ''; ?>">
                                                                    <label>Passwort bestätigen</label>
                                                                    <input type="password" name="confirm_psw" class="form-control" value="<?php echo $confirm_psw; ?>">
                                                                    <span class="help-block"><?php echo $confirm_psw_err; ?></span>
                                                                </div>
                                                                <div class="form-group <?php echo (!empty($bgid_err)) ? 'has-error' : ''; ?>">
                                                                    <input type="hidden" name="bgid" class="form-control" value="<?php echo $bgid; ?>">
                                                                </div>
                                                                <div class="form-group">
                                                                    <input type="submit" name="submit1" class="btn btn-primary" value="Registrieren">
                                                                    <input type="reset" class="btn btn-Schon registriertefault" value="Felder leeren">
                                                                </div>
                                                                <p>Schon registriert? <a href="login.php">Melden Sie sich hier an</a>.</p>

                                                            </form>
                                                        </div>
                                                        <div id="anbieter" class="tab-pane fade">
                                                            <h3>Anbieter</h3>

                                                            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                                                                <div class="form-group <?php echo (!empty($name_err)) ? 'has-error' : ''; ?>">
                                                                    <label>Name</label>
                                                                    <input type="text" name="name" class="form-control" value="<?php echo $name; ?>">
                                                                    <span class="help-block"><?php echo $name_err; ?></span>
                                                                </div>
                                                                <div class="form-group <?php echo (!empty($plz_err)) ? 'has-error' : ''; ?>">
                                                                    <label>PLZ</label>
                                                                    <input type="text" name="plz" class="form-control" value="<?php echo $plz; ?>">
                                                                    <span class="help-block"><?php echo $plz_err; ?></span>
                                                                </div>
                                                                <div class="form-group <?php echo (!empty($ort_err)) ? 'has-error' : ''; ?>">
                                                                    <label>Ort</label>
                                                                    <input type="text" name="ort" class="form-control" value="<?php echo $ort; ?>">
                                                                    <span class="help-block"><?php echo $ort_err; ?></span>
                                                                </div>
                                                                <div class="form-group <?php echo (!empty($strasse_err)) ? 'has-error' : ''; ?>">
                                                                    <label>Straße und Hausnummer</label>
                                                                    <input type="text" name="strasse" class="form-control" value="<?php echo $strasse; ?>">
                                                                    <span class="help-block"><?php echo $strasse_err; ?></span>
                                                                </div>
                                                                <div class="form-group <?php echo (!empty($ansprechp_err)) ? 'has-error' : ''; ?>">
                                                                    <label>Ansprechsperson</label>
                                                                    <input type="text" name="ansprechp" class="form-control" value="<?php echo $ansprechp; ?>">
                                                                    <span class="help-block"><?php echo $ansprechp_err; ?></span>
                                                                </div>
                                                                <div class="form-group <?php echo (!empty($telefon_err)) ? 'has-error' : ''; ?>">
                                                                    <label>Telefon</label>
                                                                    <input type="text" name="telefon" class="form-control" value="<?php echo $telefon; ?>">
                                                                    <span class="help-block"><?php echo $telefon_err; ?></span>
                                                                </div>
                                                                <div class="form-group <?php echo (!empty($emaila_err)) ? 'has-error' : ''; ?>">
                                                                    <label>Email</label>
                                                                    <input type="text" name="emaila" class="form-control" value="<?php echo $emaila; ?>">
                                                                    <span class="help-block"><?php echo $emaila_err; ?></span>
                                                                </div>
                                                                <div class="form-group <?php echo (!empty($pswa_err)) ? 'has-error' : ''; ?>">
                                                                    <label>Passwort</label>
                                                                    <input type="password" name="pswa" class="form-control" value="<?php echo $pswa; ?>">
                                                                    <span class="help-block"><?php echo $pswa_err; ?></span>
                                                                </div>
                                                                <div class="form-group <?php echo (!empty($confirm_pswa_err)) ? 'has-error' : ''; ?>">
                                                                    <label>Passwort bestätigen</label>
                                                                    <input type="password" name="confirm_pswa" class="form-control" value="<?php echo $confirm_pswa; ?>">
                                                                    <span class="help-block"><?php echo $confirm_pswa_err; ?></span>
                                                                </div>
                                                                <div class="form-group <?php echo (!empty($verified_err)) ? 'has-error' : ''; ?>">
                                                                    <input type="checkbox" id="verified" name="verified" value="<?php echo $verified; ?>" unchecked="unchecked" disabled="disabled">
                                                                    <label for="vehicle1"> Verified</label><br>
                                                                    <p>Bitte beachten Sie, dass die Verifizierung nur von einem Administrator durchgeführen werden kann.</p>
                                                                </div>
                                                                <div class="form-group">
                                                                    <input type="submit" name="submit2" class="btn btn-primary" value="Registrieren">
                                                                    <input type="reset" class="btn btn-Schon registriertefault" value="Felder leeren">
                                                                </div>
                                                                <p>Schon registriert? <a href="login.php">Melden Sie sich hier an</a>.</p>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div> <!-- ende wrapper-->
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

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

    <script>
        $(document).ready(function() {
            $(".nav-tabs a").click(function() {
                $(this).tab('show');
            });
        });
    </script>

</body>

</html>
