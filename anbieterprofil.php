<?php

// Initialize the session
session_start();

/*$username = "root";
$password = "";
$dsn = "mysql:host=localhost;dbname=festlplaner;charset=utf8";*/

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

$anbierterid= $_SESSION["id"];

$sql= "SELECT * FROM anbieter WHERE AID='".$anbierterid."'";
$result = $db->query($sql);
$i=0;
$arrverifiziert = array();
$arranbietername =array();
$arransprechsperson=array();
$arrtelefon=array();
$arremail=array();
$arrplz = array();
$arrort = array();
while($row = $result->fetch()){
    $arrverifiziert[$i]= $row['Verified'];
    $arranbietername[$i]=$row['Name'];
    $arransprechsperson[$i]= $row['Ansprechsperson'];
    $arrtelefon[$i]= $row['Telefon'];
    $arremail[$i]= $row['Email'];
    $arrplz[$i]= $row['PLZ'];
    $arrstrasse[$i]= $row['Strasse'];
    $arrort[$i]= $row['Ort'];

    $i++;
}

$sql2= "SELECT * FROM festl WHERE AID='".$anbierterid."'";
$result2 = $db->query($sql2);
$b=0;
$festl=array();
while($row2 = $result2->fetch()){
    $arrfid[$b]=$row2['FID'];
    $b++;
}
$festlcount= count($arrfid);

//$anzahl = count($arrfid);
//echo $anzahl;

/*$sql= "SELECT * FROM festl WHERE AID='".$anbierterid."'";
$result = $db->query($sql);

$festln = $result->fetchAll();*/

/*$sql1= "SELECT * FROM anbieter WHERE AID='".$anbieterid."'";
$result1 = $db->query($sql1);
$o=0;
$arrname=array();
$arransprechsperson=array();
$arrtelefon=array();
$arremail=array();
$arrplz = array();
$arrort = array();
$arrstrasse = array();
while($row1 = $result1->fetch()){
    $arrname[$o]= $row1['Name'];
    $arransprechsperson[$o]= $row1['Ansprechsperson'];
    $arrtelefon[$o]= $row1['Telefon'];
    $arremail[$o]= $row1['Email'];
    $arrplz[$o]= $row1['PLZ'];
    $arrstrasse[$o]= $row1['Strasse'];
    $arrort[$o]= $row1['Ort'];

    $o++;
}*/
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
                                                <!--<h1>Hi, <b><?php echo htmlspecialchars($arranbietername[0]); ?></b>. Willkommen auf Ihrem Profil.</h1>-->
                                                <?php if(($arrverifiziert[0]==0))
                                                { ?>
                                                <div class="alert alert-danger" role="alert">
                                                    <div id="popup" class="popup" onclick="myFunction()">Sie sind noch nicht verifiziert! Klicken Sie hier.
                                                    <span class="popuptext" id="myPopup">Bitte beachten Sie, dass der Verifizierungsprozess bis zu einem Tag dauern kann. Wir bitten um Verständnis.</span>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                <!--<button type="submit" name="verifizieren" btn-verifizieren>Verifizierung anfordern</button>-->


                                                    <div class="col-md-2">
                                                    <img src="assets/images/logowbg.jpg">
                                                    </div>

                                                    <div class="col-md-7">
                                                        <table>
                                                        <tr>
                                                            <th scope="row">Name</th>
                                                            <td><?php echo $arranbietername[0] ?></td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row">Postleitzahl und Ort</th>
                                                            <td><?php echo $arrplz[0]; echo " "; echo $arrort[0]; ?></td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row">Straße und Hausnummer</th>
                                                            <td><?php echo $arrstrasse[0] ?></td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row">Ansprechperson</th>
                                                            <td><?php echo $arransprechsperson[0] ?></td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row">Email</th>
                                                            <td><?php echo $arremail[0] ?></td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row">Telefon</th>
                                                            <td><?php echo $arrtelefon[0] ?></td>
                                                        </tr>

                                                    </table>


                                                    </div>
                                                     <div class="col-md-3">

                                                        <!-- <div class="primary-button">
                                                <a href="verifizierenmail.php" class="btn">Verifizierung anfordern</a>
                                                </div>-->
                                                         <div class="wrapper-button">
                                                        <div class="link_wrapper">
                                                            <a href="verifizierenmail.php" id="buttonw-v">Verifizierung anfordern</a>
                                                            <div class="icon-button-v">
                                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 268.832 268.832">
                                                                    <path d="M265.17 125.577l-80-80c-4.88-4.88-12.796-4.88-17.677 0-4.882 4.882-4.882 12.796 0 17.678l58.66 58.66H12.5c-6.903 0-12.5 5.598-12.5 12.5 0 6.903 5.597 12.5 12.5 12.5h213.654l-58.66 58.662c-4.88 4.882-4.88 12.796 0 17.678 2.44 2.44 5.64 3.66 8.84 3.66s6.398-1.22 8.84-3.66l79.997-80c4.883-4.882 4.883-12.796 0-17.678z"/>
                                                                </svg>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <br>
                                                         <div class="wrapper-button">
                                                        <div class="link_wrapper">
                                                            <a href="reset-password-user.php" id="buttonw">Passwort zurücksetzen</a>
                                                            <div class="icon-button">
                                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 268.832 268.832">
                                                                    <path d="M265.17 125.577l-80-80c-4.88-4.88-12.796-4.88-17.677 0-4.882 4.882-4.882 12.796 0 17.678l58.66 58.66H12.5c-6.903 0-12.5 5.598-12.5 12.5 0 6.903 5.597 12.5 12.5 12.5h213.654l-58.66 58.662c-4.88 4.882-4.88 12.796 0 17.678 2.44 2.44 5.64 3.66 8.84 3.66s6.398-1.22 8.84-3.66l79.997-80c4.883-4.882 4.883-12.796 0-17.678z"/>
                                                                </svg>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <br>
                                                    <div class="wrapper-button">
                                                        <div class="link_wrapper">
                                                            <a href="logout.php" id="buttonw">Logout</a>
                                                            <div class="icon-button">
                                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 268.832 268.832">
                                                                    <path d="M265.17 125.577l-80-80c-4.88-4.88-12.796-4.88-17.677 0-4.882 4.882-4.882 12.796 0 17.678l58.66 58.66H12.5c-6.903 0-12.5 5.598-12.5 12.5 0 6.903 5.597 12.5 12.5 12.5h213.654l-58.66 58.662c-4.88 4.882-4.88 12.796 0 17.678 2.44 2.44 5.64 3.66 8.84 3.66s6.398-1.22 8.84-3.66l79.997-80c4.883-4.882 4.883-12.796 0-17.678z"/>
                                                                </svg>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    </div>

                                                </div>


                                                <?php
                                                }
                                                else
                                                {
                                                ?>

                                            </div>
                                            <div class="row">
                                                <div class="col-md-2">
                                                <img src="assets/images/logowbg.jpg">
                                                </div>

                                                <div class="col-md-7">
                                                    <table>
                                                        <tr>
                                                            <th scope="row">Name</th>
                                                            <td><?php echo $arranbietername[0] ?></td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row">Postleitzahl und Ort</th>
                                                            <td><?php echo $arrplz[0]; echo " "; echo $arrort[0]; ?></td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row">Straße und Hausnummer</th>
                                                            <td><?php echo $arrstrasse[0] ?></td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row">Ansprechperson</th>
                                                            <td><?php echo $arransprechsperson[0] ?></td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row">Email</th>
                                                            <td><?php echo $arremail[0] ?></td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row">Telefon</th>
                                                            <td><?php echo $arrtelefon[0] ?></td>
                                                        </tr>

                                                    </table>


                                                </div>
                                                <div class="col-md-3">
                                                    <div class="wrapper-button">
                                                        <div class="link_wrapper">
                                                            <a href="festlanlegen.php" id="buttonw">Veranstaltung anlegen</a>
                                                            <div class="icon-button">
                                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 268.832 268.832">
                                                                    <path d="M265.17 125.577l-80-80c-4.88-4.88-12.796-4.88-17.677 0-4.882 4.882-4.882 12.796 0 17.678l58.66 58.66H12.5c-6.903 0-12.5 5.598-12.5 12.5 0 6.903 5.597 12.5 12.5 12.5h213.654l-58.66 58.662c-4.88 4.882-4.88 12.796 0 17.678 2.44 2.44 5.64 3.66 8.84 3.66s6.398-1.22 8.84- 3.66l79.997-80c4.883-4.882 4.883-12.796 0-17.678z"/>
                                                                </svg>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <br>
                                                    <div class="wrapper-button">
                                                        <div class="link_wrapper">
                                                            <a href="verwaltunganbieter.php" id="buttonw">Veranstaltung verwalten</a>
                                                            <div class="icon-button">
                                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 268.832 268.832">
                                                                    <path d="M265.17 125.577l-80-80c-4.88-4.88-12.796-4.88-17.677 0-4.882 4.882-4.882 12.796 0 17.678l58.66 58.66H12.5c-6.903 0-12.5 5.598-12.5 12.5 0 6.903 5.597 12.5 12.5 12.5h213.654l-58.66 58.662c-4.88 4.882-4.88 12.796 0 17.678 2.44 2.44 5.64 3.66 8.84 3.66s6.398-1.22 8.84- 3.66l79.997-80c4.883-4.882 4.883-12.796 0-17.678z"/>
                                                                </svg>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <br>
                                                    <div class="wrapper-button">
                                                        <div class="link_wrapper">
                                                            <a href="reset-password-user.php" id="buttonw">Passwort zurücksetzen</a>
                                                            <div class="icon-button">
                                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 268.832 268.832">
                                                                    <path d="M265.17 125.577l-80-80c-4.88-4.88-12.796-4.88-17.677 0-4.882 4.882-4.882 12.796 0 17.678l58.66 58.66H12.5c-6.903 0-12.5 5.598-12.5 12.5 0 6.903 5.597 12.5 12.5 12.5h213.654l-58.66 58.662c-4.88 4.882-4.88 12.796 0 17.678 2.44 2.44 5.64 3.66 8.84 3.66s6.398-1.22 8.84-3.66l79.997-80c4.883-4.882 4.883-12.796 0-17.678z"/>
                                                                </svg>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <br>
                                                    <div class="wrapper-button">
                                                        <div class="link_wrapper">
                                                            <a href="logout.php" id="buttonw">Logout</a>
                                                            <div class="icon-button">
                                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 268.832 268.832">
                                                                    <path d="M265.17 125.577l-80-80c-4.88-4.88-12.796-4.88-17.677 0-4.882 4.882-4.882 12.796 0 17.678l58.66 58.66H12.5c-6.903 0-12.5 5.598-12.5 12.5 0 6.903 5.597 12.5 12.5 12.5h213.654l-58.66 58.662c-4.88 4.882-4.88 12.796 0 17.678 2.44 2.44 5.64 3.66 8.84 3.66s6.398-1.22 8.84-3.66l79.997-80c4.883-4.882 4.883-12.796 0-17.678z"/>
                                                                </svg>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <br>
                                            <h3>Ihre veröffentlichten Veranstalgunen: <b><?php echo $festlcount ?></b></h3>
                                               <!-- <br>
                                                <div class="primary-button">
                                                <a href="festlanlegen.php">Veranstaltung anlegen</a>
                                                </div>
                                                <br>
                                                <div class="primary-button">
                                                <a href="verwaltunganbieter.php">Veranstaltung verwalten</a>
                                                </div>
                                                <br>-->
                                                <?php } ?>

                                               <!-- <br>
                                                <a href="reset-password.php" class="btn btn-warning">Passwort zurücksetzen</a>
                                                <a href="logout.php" class="btn btn-danger">Logout</a>-->


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
     <style>
         @import url('https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,700');
        body {
    padding:$base-spacing-unit;
	font-family:'Source Sans Pro', sans-serif;
	margin:0;

}
              /*button*/


.link_wrapper{
  position: relative;
}

a#buttonw{
  display: block;
  width: 250px;
  height: 50px;
  line-height: 50px;
  font-weight: bold;
  text-decoration: none;
  background: #333;
  text-align: center;
  color: #fff;
  text-transform: uppercase;
  letter-spacing: 1px;
  border: 3px solid #333;
  transition: all .35s;
}

.icon-button{
  width: 50px;
  height: 50px;
  border: 3px solid transparent;
  position: absolute;
  transform: rotate(45deg);
  right: 0;
  top: 0;
  z-index: -1;
  transition: all .35s;
}

.icon-button svg{
  width: 30px;
  position: absolute;
  top: calc(50% - 15px);
  left: calc(50% - 15px);
  transform: rotate(-45deg);
  fill: #292929;
  transition: all .35s;
}

a#buttonw:hover{
  width: 200px;
  border: 3px solid #FF7E7E;
  background: transparent;
  color: #292929;
}

a#buttonw:hover + .icon-button{
  border: 3px solid #FF7E7E;
  right: -25%;
}

         /*special button*/
         a#buttonw-v{
  display: block;
  width: 250px;
  height: 50px;
  line-height: 50px;
  font-weight: bold;
  text-decoration: none;
  background: #FF7E7E;
  text-align: center;
  color: #fff;
  text-transform: uppercase;
  letter-spacing: 1px;
  border: 3px solid #FF7E7E;
  transition: all .35s;
}

.icon-button-v{
  width: 50px;
  height: 50px;
  border: 3px solid transparent;
  position: absolute;
  transform: rotate(45deg);
  right: 0;
  top: 0;
  z-index: -1;
  transition: all .35s;
}

.icon-button-v svg{
  width: 30px;
  position: absolute;
  top: calc(50% - 15px);
  left: calc(50% - 15px);
  transform: rotate(-45deg);
  fill: #FF7E7E;
  transition: all .35s;
}

a#buttonw-v:hover{
  width: 200px;
  border: 3px solid #292929;
  background: transparent;
  color: #FF7E7E;
}

a#buttonw-v:hover + .icon-button-v{
  border: 3px solid #292929;
  right: -25%;
}
    </style>

</html>
