<?php
// Include config file
require_once __DIR__.'/config/database.php';

// Define variables and initialize with empty values
$email = $vorname = $nachname = $gebdat = $psw = $confirm_psw = "";
$bgid="1";
$email_err = $vorname_err = $nachname_err = $gebdat_err = $bgid_err = $psw_err = $confirm_psw_err = "";

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
?>

<!DOCTYPE html>
<html lang="de">
<style>
    * {
        box-sizing: border-box;
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
</style>

<head>
    <meta charset="UTF-8">
    <title>Sign Up</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        body{ font: 14px sans-serif; }
        .wrapper{ width: 350px; padding: 20px; }
    </style>
</head>
<body>
    <div class="wrapper">
        <h2>Registrieren</h2>
        <p>Bitte füllen Sie diese Felder aus, um sich zu registrieren.</p>
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
            <div  class="form-group <?php echo (!empty($bgid_err)) ? 'has-error' : ''; ?>">
                <input type="hidden" name="bgid" class="form-control" value="<?php echo $bgid; ?>">
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Registrieren">
                <input type="reset" class="btn btn-Schon registriertefault" value="Felder leeren">
            </div>
            <p>Schon registriert? <a href="login.php">Melden Sie sich hier an</a>.</p>
        </form>
    </div>
</body>
</html>
