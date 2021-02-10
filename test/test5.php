<?php
$username = "root";
$password = "";
$dsn = "mysql:host=localhost;dbname=festlplaner;charset=utf8";

$db = new PDO($dsn,$username,$password);

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

?>

<!DOCTYPE html>
<html lang="en">
<body>
<div class="container">

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

    </style>

    </body>
</html>
