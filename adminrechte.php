<?php
require_once __DIR__.'/config/database.php';
session_start();

/*$username = "root";
$password = "";
$dsn = "mysql:host=localhost;dbname=festlplaner;charset=utf8";
$db = new PDO($dsn,$username,$password);*/

$username = "digbizm_1";
$password = "2021##Fireme";
$dsn = "mysql:host=sql349.your-server.de;dbname=festlpage;charset=utf8";


$db = new PDO($dsn,$username,$password);


if (isset($_GET['value'])) {

    $zid = $_GET['value'];
    $_SESSION["zid"]=$zid;
    //$verified=1;
    echo $zid;

}

if (isset($_SESSION['loggedin'])) {
    $zid_=$_SESSION["zid"];
}
else
{
    header("Location: login.php");
    die();
}
echo $zid_;
$sql1= "SELECT * FROM benutzer WHERE BID='".$zid_."'";
$result1 = $db->query($sql1);
$i=0;
$arradmin=array();
$vorname=array();
$nachname=array();
$email=array();
while($row1 = $result1->fetch()){
    $arradmin[$i]= $row1['BGID'];
    $vorname[$i]= $row1['Vorname'];
    $nachname[$i]= $row1['Nachname'];
    $email[$i]= $row1['Email'];
    $i++;
}

if(isset($_POST['submit']))
{
if(($arradmin[0])==1)
{
        $bgid=2;
        $stmt=$db->prepare("UPDATE benutzer SET BGID=:bgid WHERE BID=:zid");
        $stmt->bindParam(":bgid",$bgid,PDO::PARAM_INT);
        $stmt->bindParam(":zid",$zid_,PDO::PARAM_INT);
        $stmt->execute();

       //header("Location: test6.php");
}
else
{
        $verified=1;
        $stmt=$db->prepare("UPDATE benutzer SET BGID=:bgid WHERE BID=:zid");
        $stmt->bindParam(":bgid",$verified,PDO::PARAM_INT);
        $stmt->bindParam(":zid",$zid_,PDO::PARAM_INT);
        $stmt->execute();

       // header("Location: test6.php");
}
    header("Location: benutzerverwalten.php");
}
?>
<!DOCTYPE html>
<html lang="de">
    <link rel="icon" type="image/x-icon" href="assets/images/favicon.ico">
<head>
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700" rel="stylesheet">
    <!-- Bootstrap core CSS -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="assets/css/fontawesome.css">
    <!--<link rel="stylesheet" href="assets/css/templatemo-style.css">-->
    <link rel="stylesheet" href="assets/css/owl.css">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Festlplaner</title>
    <!--<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">-->
    <!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<style type="text/css">
@import url(fontawesome.css);
@import url("https://fonts.googleapis.com/css?family=Roboto+Slab:400,700");


    body {
        color: #566787;
		background: #f5f5f5;
       font-family: "Roboto Slab", serif;

	}
	.table-wrapper {
        background: #fff;
        padding: 20px 25px;
        margin: 30px 0;
		border-radius: 3px;
        box-shadow: 0 1px 1px rgba(0,0,0,.05);
    }
	.table-title {
		padding-bottom: 15px;
        background: #292929;
		color: #fff;
		padding: 16px 30px;
		margin: -20px -25px 10px;
		border-radius: 3px 3px 0 0;
    }
    .table-title h2 {
		margin: 5px 0 0;
		font-size: 24px;
	}
	.table-title .btn-group {
		float: right;
	}
	.table-title .btn {
		color: #fff;
		float: right;
		font-size: 13px;
		border: none;
		min-width: 50px;
		border-radius: 2px;
		border: none;
		outline: none !important;
		margin-left: 10px;
	}
	.table-title .btn i {
		float: left;
		font-size: 21px;
		margin-right: 5px;
	}
	.table-title .btn span {
		float: left;
		margin-top: 2px;
	}
    table.table tr th, table.table tr td {
        border-color: #e9e9e9;
		padding: 12px 15px;
		vertical-align: middle;
    }
	table.table tr th:first-child {
		width: 60px;
	}
	table.table tr th:last-child {
		width: 100px;
	}
    table.table-striped tbody tr:nth-of-type(odd) {
    	background-color: #fcfcfc;
	}
	table.table-striped.table-hover tbody tr:hover {
		background: #f5f5f5;
	}
    table.table th i {
        font-size: 13px;
        margin: 0 5px;
        cursor: pointer;
    }
    table.table td:last-child i {
		opacity: 0.9;
		font-size: 22px;
        margin: 0 5px;
    }
	table.table td a {
		font-weight: bold;
		color: #292929;
		display: inline-block;
		text-decoration: none;
		outline: none !important;
	}
	table.table td a:hover {
		color: #2196F3;
	}
	table.table td a.edit {
        color: #FFC107;
    }
    table.table td a.delete {
        color: #F44336;
    }
    table.table td i {
        font-size: 19px;
    }
	table.table .avatar {
		border-radius: 50%;
		vertical-align: middle;
		margin-right: 10px;
	}
    .pagination {
        float: right;
        margin: 0 0 5px;
    }
    .pagination li a {
        border: none;
        font-size: 13px;
        min-width: 30px;
        min-height: 30px;
        color: #999;
        margin: 0 2px;
        line-height: 30px;
        border-radius: 2px !important;
        text-align: center;
        padding: 0 6px;
    }
    .pagination li a:hover {
        color: #666;
    }
    .pagination li.active a, .pagination li.active a.page-link {
        background: #03A9F4;
    }
    .pagination li.active a:hover {
        background: #0397d6;
    }
	.pagination li.disabled i {
        color: #ccc;
    }
    .pagination li i {
        font-size: 16px;
        padding-top: 6px
    }
    .hint-text {
        float: left;
        margin-top: 10px;
        font-size: 13px;
    }
	/* Custom checkbox */
	.custom-checkbox {
		position: relative;
	}
	.custom-checkbox input[type="checkbox"] {
		opacity: 0;
		position: absolute;
		margin: 5px 0 0 3px;
		z-index: 9;
	}
	.custom-checkbox label:before{
		width: 18px;
		height: 18px;
	}
	.custom-checkbox label:before {
		content: '';
		margin-right: 10px;
		display: inline-block;
		vertical-align: text-top;
		background: white;
		border: 1px solid #bbb;
		border-radius: 2px;
		box-sizing: border-box;
		z-index: 2;
	}
	.custom-checkbox input[type="checkbox"]:checked + label:after {
		content: '';
		position: absolute;
		left: 6px;
		top: 3px;
		width: 6px;
		height: 11px;
		border: solid #000;
		border-width: 0 3px 3px 0;
		transform: inherit;
		z-index: 3;
		transform: rotateZ(45deg);
	}
	.custom-checkbox input[type="checkbox"]:checked + label:before {
		border-color: #03A9F4;
		background: #03A9F4;
	}
	.custom-checkbox input[type="checkbox"]:checked + label:after {
		border-color: #fff;
	}
	.custom-checkbox input[type="checkbox"]:disabled + label:before {
		color: #b8b8b8;
		cursor: auto;
		box-shadow: none;
		background: #ddd;
	}
	/* Modal styles */
	.modal .modal-dialog {
		max-width: 800px;
	}
	.modal .modal-header, .modal .modal-body, .modal .modal-footer {
		padding: 20px 30px;
	}
	.modal .modal-content {
		border-radius: 3px;
	}
	.modal .modal-footer {
		background: #ecf0f1;
		border-radius: 0 0 3px 3px;
	}
    .modal .modal-title {
        display: inline-block;
    }
	.modal .form-control {
		border-radius: 2px;
		box-shadow: none;
		border-color: #dddddd;
	}
	.modal textarea.form-control {
		resize: vertical;
	}
	.modal .btn {
		border-radius: 2px;
		min-width: 100px;
	}
	.modal form label {
		font-weight: normal;
	}
    img{
        width: 20px;
        height: 20px;
    }
</style>
<script type="text/javascript">
$(document).ready(function(){
	// Activate tooltip
	//$('[data-toggle="tooltip"]').tooltip();

});

</script>
</head>
<body>
<?php if(($arradmin[0])==1)
{?>
   <!-- Wrapper -->
    <div id="wrapper">

        <!-- Main -->
        <div id="main">
            <div class="inner">
                <div class="modal-dialog">
                    <div class="modal-content">
				<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
					<div class="modal-header">
						<h4 class="modal-title">Vergabe der Adminrechte</h4>
                        <a href="test6.php" class="btn"><img src="assets/images/baseline_close_black_18dp.png"></a>
					</div>
					<div class="modal-body">
						<p>Sind Sie sicher, dass Sie <?php echo $vorname[0]; echo " "; echo $nachname[0]; echo " ("; echo $email[0]; echo ") " ?>Adminrechte geben wollen?</p>
					</div>
					<div class="modal-footer">
                        <a href="test6.php" class="btn">Abbrechen</a>
                        <input type="submit" name="submit" class="btn btn-danger" value="Ja">
					</div>
				</form>
			</div>
                </div>
            </div>
        </div>
    </div>
    <?php
}
else
{?>
    <!-- Wrapper -->
    <div id="wrapper">

        <!-- Main -->
        <div id="main">
            <div class="inner">
                <div class="modal-dialog">
                    <div class="modal-content">
				<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
					<div class="modal-header">
						<h4 class="modal-title">Entzug der Adminrechte</h4>
                        <a href="test6.php" class="btn"><img src="assets/images/baseline_close_black_18dp.png"></a>
					</div>
					<div class="modal-body">
						<p>Sind Sie sicher, dass Sie <?php echo $vorname[0]; echo " "; echo $nachname[0]; echo " ("; echo $email[0]; echo ") " ?>die Adminrechte entziehen wollen?</p>
					</div>
					<div class="modal-footer">
                        <a href="test6.php" class="btn">Abbrechen</a>
                        <input type="submit" name="submit" class="btn btn-danger" value="Ja">
					</div>
				</form>
			</div>
                </div>
            </div>
        </div>
    </div>
    <?php } ?>
     <script src="assets/jquery/jquery.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>

    <script src="assets/js/browser.min.js"></script>
    <script src="assets/js/breakpoints.min.js"></script>
    <script src="assets/js/transition.js"></script>
    <script src="assets/js/owl-carousel.js"></script>
    <script src="assets/js/custom.js"></script>
</body>
</html>
