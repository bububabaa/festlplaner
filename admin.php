<?php
// Initialize the session
session_start();

/*$username = "digbizm_1";
$password = "2021##Fireme";
$dsn = "mysql:host=sql349.your-server.de;dbname=festlpage;charset=utf8";*/

$username = "c31festlplaner";
$password = "Festlplaner2020";
$dsn = "mysql:host=projects.hakmistelbach.ac.at;dbname=c31festlplaner;charset=utf8";

$db = new PDO($dsn,$username,$password);

// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
$benutzerid=$_SESSION["bid"];
//echo $benutzerid;

$sql= "SELECT * FROM benutzer WHERE BID='".$benutzerid."'";
$result = $db->query($sql);
$i=0;
$arrbenutzervorname =array();
$arrbenutzernachname =array();
while($row = $result->fetch()){
    $arrbenutzervorname[$i]=$row['Vorname'];
    $arrbenutzernachname[$i]=$row['Nachname'];

    $i++;
}
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

    <title>Adminbereich</title>

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
                                               <!-- <h1>Hi, <b><?php echo htmlspecialchars($_SESSION["usernamebenutzer"]); ?></b>. Sie befinden sich im Adminbereich.</h1>-->
                                                 <h1>Hi, <b><?php echo $arrbenutzervorname[0];echo " "; echo $arrbenutzernachname[0]; ?></b>. Willkommen auf Ihrem Profil.</h1>
                                            </div>

                                            <div class="primary-button">
                                                <a href="anbieterverwalten.php">Anbieter verwalten</a>
                                            </div>
                                            <div class="primary-button">
                                                <a href="benutzerverwalten.php">Benutzer verwalten</a>
                                            </div>

                                            <br><br>

                                            <p>
                                                <a href="reset-password-user.php" class="btn btn-warning">Passwort zurücksetzen</a>
                                                <a href="logout.php" class="btn btn-danger">Logout</a>
                                            </p>
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

</html>
