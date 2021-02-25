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

//benutzer
$sql1= "SELECT * FROM benutzer WHERE BGID=1";
$result1 = $db->query($sql1);
$a=0;
$arrbid =array();
while($row1 = $result1->fetch()){
    $arrbid[$a]=$row1['BID'];

    $a++;
}

$benutzercount=count($arrbid);

//admin
$sql2= "SELECT * FROM benutzer WHERE BGID=2";
$result2 = $db->query($sql2);
$b=0;
$arradid =array();
while($row2 = $result2->fetch()){
    $arradid[$b]=$row2['BID'];

    $b++;
}
$admincount=count($arradid);

//verifizierte anbieter
$sql3= "SELECT * FROM anbieter WHERE Verified=1";
$result3 = $db->query($sql3);
$c=0;
$arrvaid =array();
while($row3 = $result3->fetch()){
    $arrvaid[$c]=$row3['AID'];

    $c++;
}
$vanbietercount=count($arrvaid);

//nicht verifizierte anbieter
$sql4= "SELECT * FROM anbieter WHERE Verified=0";
$result4 = $db->query($sql4);
$d=0;
$arrnvaid =array();
while($row4 = $result4->fetch()){
    $arrnvaid[$d]=$row4['AID'];

    $d++;
}
$nvanbietercount=count($arrnvaid);

//veranstaltungen
$sql5= "SELECT * FROM festl";
$result5 = $db->query($sql5);
$f=0;
$arrfestl =array();
while($row5 = $result5->fetch()){
    $arrfestl[$f]=$row5['FID'];

    $f++;
}
$festlcount=count($arrfestl);

//daten
$sql6= "SELECT * FROM benutzer WHERE BID='".$benutzerid."'";
$result6 = $db->query($sql6);
$g=0;
$arrvorname=array();
$arrnachname=array();
$arrgebdat=array();
$arremail=array();

while($row6 = $result6->fetch()){
    $arrvorname[$g]= $row6['Vorname'];
    $arrnachname[$g]= $row6['Nachname'];
    $arrgebdat[$g]= $row6['Gebdat'];
    $arremail[$g]= $row6['Email'];


    $g++;
}
$date = DateTime::createFromFormat('Y-m-d', $arrgebdat[0]);
$converted_date = $date->format('d.m.Y');
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
                                           <!-- <div class="page-header">
                                               <!-- <h1>Hi, <b><?php echo htmlspecialchars($_SESSION["usernamebenutzer"]); ?></b>. Sie befinden sich im Adminbereich.</h1>-->
                                                <!-- <h1>Hi, <b><?php echo $arrbenutzervorname[0];echo " "; echo $arrbenutzernachname[0]; ?></b>. Willkommen auf Ihrem Profil.</h1>
                                                <br>
                                            </div>-->
                                            <div class="row">
                                                <div class="col-md-2">
                                                <img src="assets/images/logowbg.jpg">
                                                </div>

                                                <div class="col-md-7">
                                                  <table>
                                                    <tr>
                                                        <th scope="row">Vorname</th>
                                                        <td><?php echo $arrvorname[0] ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">Nachname</th>
                                                        <td><?php echo $arrnachname[0]; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">Geburtsdatum</th>
                                                        <td><?php echo $converted_date ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">Email</th>
                                                        <td><?php echo $arremail[0] ?></td>

                                                    </tr>

                                                    </table>


                                                    </div>
                                                <div class="col-md-3">
                                            <!-- <div class="primary-button">
                                                <a href="anbieterverwalten.php">Anbieter verwalten</a>
                                            </div>
                                                    <br>
                                            <p>

                                                <a href="benutzerverwalten.php" class="btn btn-secondary">Benutzer verwalten</a>
                                            </p>-->
                                                     <div class="wrapper-button">
                                                        <div class="link_wrapper">
                                                            <a href="anbieterverwalten.php" id="buttonw">Anbieter verwalten</a>
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
                                                            <a href="benutzerverwalten.php" id="buttonw">Benutzer verwalten</a>
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



                                           <!-- <p>
                                                <a href="reset-password-user.php" class="btn btn-warning">Passwort zurücksetzen</a>
                                            </p>
                                            <p>
                                                <a href="logout.php" class="btn btn-danger">Logout</a>
                                            </p>-->
                                                </div>

                                            </div>
                                            <br>
                                            <div class="table">
                                                        <div class="table-header">
                                                            <div class="header__item">Benutzer</div>
                                                            <div class="header__item">verifizierte Anbieter</div>
                                                            <div class="header__item">nicht verifizierte Anbieter</div>
                                                            <div class="header__item">Veranstaltungen</div>
                                                            <div class="header__item">Admins</div>
                                                        </div>
                                                        <div class="table-content">
                                                            <div class="table-row">
                                                                <div class="table-data"><?php echo $benutzercount; ?></div>
                                                                <div class="table-data"><?php echo $vanbietercount; ?></div>
                                                                <div class="table-data"><?php echo $nvanbietercount; ?></div>
                                                                <div class="table-data"><?php echo $festlcount; ?></div>
                                                                <div class="table-data"><?php echo $admincount; ?></div>
                                                            </div>

		                                              </div>
	                                               </div>
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

      <style>
  @import url('https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,700');

$base-spacing-unit: 24px;
$half-spacing-unit: $base-spacing-unit / 2;

$color-alpha: #1772FF;
$color-form-highlight: #EEEEEE;;

*, *:before, *:after {
	box-sizing:border-box;
}

body {
    padding:$base-spacing-unit;
	font-family:'Source Sans Pro', sans-serif;
	margin:0;

}

h1,h2,h3,h4,h5,h6 {
	margin:0;
}

.container {
	max-width: 1000px;
	margin-right:auto;
	margin-left:auto;
	display:flex;
    /*justify-content:center;
	align-items:center;*/
	min-height:100vh;
}

.table {
	width:100%;
	border:1px solid $color-form-highlight;
}

.table-header {
	display:flex;
	width:100%;
	background:#000;
	padding:($half-spacing-unit * 1.5) 0;
    padding-top: 15px;
    padding-bottom: 15px;
    font-weight: bold;
    align-items: center;


}

.table-row {
	display:flex;
	width:100%;
	padding:($half-spacing-unit * 1.5) 0;

	&:nth-of-type(odd) {
		background:$color-form-highlight;
	}
}

.table-data, .header__item {
	flex: 1 1 20%;
	text-align:center;
}

        .table-data {
            background-color: #262626;
            padding: 20px;
            color: #C7C7C7;
            font-weight: bold;
        }

.header__item {
	text-transform:uppercase;
    color: #C7C7C7;
	text-decoration: none;
	position:relative;
	display:inline-block;
	padding-left:$base-spacing-unit;
	padding-right:$base-spacing-unit;


	&::after {
		content:'';
		position:absolute;
		right:-($half-spacing-unit * 1.5);
		color:white;
		font-size:$half-spacing-unit;
		top: 50%;
		transform: translateY(-50%);
	}
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

    </style>
</body>

</html>
