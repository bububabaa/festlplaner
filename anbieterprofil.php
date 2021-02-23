<?php

// Initialize the session
session_start();

/*$username = "root";
$password = "";
$dsn = "mysql:host=localhost;dbname=festlplaner;charset=utf8";*/

$username = "digbizm_1";
$password = "2021##Fireme";
$dsn = "mysql:host=sql349.your-server.de;dbname=festlpage;charset=utf8";


$db = new PDO($dsn,$username,$password);

// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}

$anbierterid= $_SESSION["id"];

$sql= "SELECT * FROM anbieter WHERE AID='".$anbierterid."'";
$result = $db->query($sql);
$i=0;
$arrverifiziert = array();
$arranbietername =array();
while($row = $result->fetch()){
    $arrverifiziert[$i]= $row['Verified'];
    $arranbietername[$i]=$row['Name'];

    $i++;
}
//$anzahl = count($arrfid);
//echo $anzahl;

$sql= "SELECT * FROM festl WHERE AID='".$anbierterid."'";
$result = $db->query($sql);

$festln = $result->fetchAll();


/*if(isset($_POST['submit']))
{
    require_once 'vendor/autoload.php';

// Create the Transport
$transport = (new Swift_SmtpTransport('smtp.gmail.com', 587, 'tls'))
  ->setUsername('username')
  ->setPassword('password')
;

// Create the Mailer using your created Transport
$mailer = new Swift_Mailer($transport);

// Create a message
$message = (new Swift_Message('Verifizierungsantrag'))
  ->setFrom(['email' => 'Name'])
  ->setTo(['receiver@domain.org', 'other@domain.org' => 'A name'])
  ->setBody('Here is the message itself')
  ;

// Send the message
$result = $mailer->send($message);
}*/

/*
if(isset($_POST['verifizieren']))
{
    require_once 'vendor/autoload.php';

    $transport = (new Swift_SmtpTransport('smtp.gmail.com', 465, 'ssl'))
    ->setUsername('festlplaner@gmail.com')
    ->setPassword('unqovrmbgtxmczvx')
    ;

    $mailer = new Swift_Mailer($transport);

    $message = (new Swift_Message('Verifikation'))
    ->setFrom(['festlplaner@gmail.com' => 'Festlplaner Anfrage'])
    ->setTo(['bopejik361@poetred.com' => ''])
    ->setBody('Der User ... beantragt die Verifikation des Accounts')
    ;

    $result = $mailer->send($message);

    if($result){
        echo "Mail wurde versendet";
        die();
    }
    echo "Mail wurde NICHT versendet";
}
*/
?>

<!DOCTYPE html>
<html lang="en">
<link rel="icon" type="image/x-icon" href="assets/images/favicon.ico">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700" rel="stylesheet">

    <title>Willkommen</title>

    <!-- Bootstrap core CSS -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">

    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="assets/css/fontawesome.css">
    <link rel="stylesheet" href="assets/css/templatemo-style.css">
    <link rel="stylesheet" href="assets/css/owl.css">


    <!-- <meta charset="UTF-8">
    <title>Welcome</title>-->
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        body{ font: 14px sans-serif; text-align: center; }
    </style>-->
</head>

<body>
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
                                            <div class="page-header">
                                                <!--<h1>Hi, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>. Willkommen auf Ihrem Profil.</h1>-->
                                                <h1>Hi, <b><?php echo htmlspecialchars($arranbietername[0]); ?></b>. Willkommen auf Ihrem Profil.</h1>
                                                <?php if(($arrverifiziert[0]==0))
                                                { ?>
                                                <div class="alert alert-danger" role="alert">
                                                    <div id="popup" class="popup" onclick="myFunction()">Sie sind noch nicht verifiziert! Klicken Sie hier.
                                                    <span class="popuptext" id="myPopup">Bitte beachten Sie, dass der Verifizierungsprozess bis zu einem Tag dauern kann. Wir bitten um Verständnis.</span>
                                                    </div>
                                                </div>

                                                <!--<button type="submit" name="verifizieren" btn-verifizieren>Verifizierung anfordern</button>-->
                                                <div class="primary-button">
                                                <a href="verifizierenmail.php" class="btn">Verifizierung anfordern</a>
                                                </div>
                                                <br>

                                                <?php
                                                }
                                                else
                                                {
                                                ?>
                                                <!--<div id="popup" class="popup" onclick="myFunction()"><img alt="Information" src="assets/images/information.png">
                                                    <span class="popuptext" id="myPopup">Bitte beachten Sie, dass der Verifizierungsprozess bis zu einem Tag dauern kann. Wir bitten um Verständnis.</span>
                                                    <button type="submit" btn-verifizieren>Verifizierung anfordern</button>
                                                </div>-->
                                            </div>
                                                <br>
                                                <div class="primary-button">
                                                <a href="festlanlegen.php">Veranstaltung anlegen</a>
                                                </div>
                                                <br>
                                                <div class="primary-button">
                                                <a href="verwaltunganbieter.php">Veranstaltung verwalten</a>
                                                </div>
                                                <br>
                                                <?php } ?>

                                                <br>
                                                <a href="reset-password.php" class="btn btn-warning">Passwort zurücksetzen</a>
                                                <a href="logout.php" class="btn btn-danger">Logout</a>


                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>

        <?php
error_reporting(-1);
ini_set('display_errors','On');
require __DIR__.'/templates/templateSidebar.php'?>

    </div>
     <?php
error_reporting(-1);
ini_set('display_errors','On');
    require __DIR__.'/templates/templateScripts.php'?>
</body>

<script>
    // When the user clicks on <div>, open the popup
    function myFunction() {
        var popup = document.getElementById("myPopup");
        popup.classList.toggle("show");
    }
</script>

<style>

    #popup img{
        width: 50px;
        height: 50px;
    }

    /* Popup container */
    .popup {
        position: relative;
        display: inline-block;
        cursor: pointer;
    }

    /* The actual popup (appears on top) */
    .popup .popuptext {
        visibility: hidden;
        width: 170px;
        background-color: #555;
        color: #fff;
        text-align: center;
        border-radius: 6px;
        padding: 8px 0;
        position: absolute;
        z-index: 1;
        bottom: 125%;
        left: 50%;
        margin-left: -80px;
    }

    /* Popup arrow */
    .popup .popuptext::after {
        content: "";
        position: absolute;
        top: 100%;
        left: 50%;
        margin-left: -5px;
        border-width: 5px;
        border-style: solid;
        border-color: #555 transparent transparent transparent;
    }

    /* Toggle this class when clicking on the popup container (hide and show the popup) */
    .popup .show {
        visibility: visible;
        -webkit-animation: fadeIn 1s;
        animation: fadeIn 1s
    }

    /* Add animation (fade in the popup) */
    @-webkit-keyframes fadeIn {
        from {
            opacity: 0;
        }

        to {
            opacity: 1;
        }
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
        }

        to {
            opacity: 1;
        }
    }
</style>

</html>
