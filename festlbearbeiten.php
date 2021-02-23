<?php

require_once __DIR__.'/config/database.php';
session_start();

if (isset($_GET['aendern'])) {

    $zid = $_GET['aendern'];
    $_SESSION["zid"]=$zid;
   // echo $zid;
    $sql2 = "SELECT * FROM festl WHERE FID=$zid";


    if($stmt = $pdo->prepare($sql2)){
        // Bind variables to the prepared statement as parameters
        $stmt->bindParam(":FID", $param_fid, PDO::PARAM_STR);

        // Set parameters
        $param_fid = $zid;
    }
}

/*$username = "root";
$password = "";
$dsn = "mysql:host=localhost;dbname=festlplaner;charset=utf8";*/

$username = "digbizm_1";
$password = "2021##Fireme";
$dsn = "mysql:host=sql349.your-server.de;dbname=festlpage;charset=utf8";


$db = new PDO($dsn,$username,$password);

if (isset($_SESSION['loggedin'])) {
    $anbieterid= $_SESSION["id"];
    $zid_=$_SESSION["zid"];
}
else
{
    header("Location: login.php");
    die();
}

$sql1= "SELECT * FROM festl WHERE FID='".$zid_."'";
$result1 = $db->query($sql1);
$i=0;
$arrdatum=array();
$arrfid=array();
$arrbezeichnung=array();
$arrplz=array();
$arrort=array();
$arrstrasse=array();
$arrhausnummer=array();
$arrbeschreibung=array();
$arreintritt=array();
$arreinlass=array();
$arrbeginn=array();
$arrende=array();
$arrwebad=array();
$arrfoto=array();
while($row1 = $result1->fetch()){
    $arrdatum[$i]= $row1['Datum'];
    $arrfid[$i]=$row1['FID'];
    $arrbezeichnung[$i]=$row1['Bezeichnung'];
    $arrplz[$i]=$row1['PLZ'];
    $arrort[$i]=$row1['Ort'];
    $arrstrasse[$i]=$row1['Strasse'];
    $arrhausnummer[$i]=$row1['Hausnummer'];
    $arrbeschreibung[$i]=$row1['Beschreibung'];
    $arreintritt[$i]=$row1['Eintritt'];
    $arreinlass[$i]=$row1['EinlassAb'];
    $arrbeginn[$i]=$row1['Beginn'];
    $arrende[$i]=$row1['Ende'];
    $arrwebad[$i]=$row1['Webadresse'];
    $arrfoto[$i]=$row1['Titelbild'];
    $i++;
}

$bezeichnung = $plz = $ort = $strasse = $hausnr = $beschreibung = $datum = $eintritt = $einlass = $beginn = $ende="";
$bezeichnung_err = $plz_err = $ort_err = $strasse_err = $hausnr_err = $beschreibung_err = $datum_err = $eintritt_err = $einlass_err = $beginn_err = $ende_err =$aid_err="";
$foto = $webad ="";
$foto_err =$webad_err="";
//echo '<img src="data:image/jpeg;base64,' . base64_encode($arrfoto[0]) . '">';

if(isset($_POST['aendern-submit']))
{
    if($_SERVER["REQUEST_METHOD"] == "POST")
    {
        //$bezeichnung = trim($_POST["bezeichnung"]);

        if(empty(trim($_POST["bezeichnung"]))){
            $bezeichnung= $arrbezeichnung[0];
        }
        else{
            $bezeichnung = trim($_POST["bezeichnung"]);
        }

        //$plz = trim($_POST["plz"]);

        if(empty(trim($_POST["plz"]))){
            $plz= $arrplz[0];
        }
        else{
            $plz = trim($_POST["plz"]);
        }

        //$ort = trim($_POST["ort"]);

        if(empty(trim($_POST["ort"]))){
            $ort= $arrort[0];
        }
        else{
            $ort = trim($_POST["ort"]);
        }

        //$strasse = trim($_POST["strasse"]);

        if(empty(trim($_POST["strasse"]))){
            $strasse= $arrstrasse[0];
        }
        else{
            $strasse = trim($_POST["strasse"]);
        }

       // $hausnr = trim($_POST["hausnr"]);

        if(empty(trim($_POST["hausnr"]))){
            $hausnr= $arrhausnummer[0];
        }
        else{
            $hausnr = trim($_POST["hausnr"]);
        }

        //$beschreibung = trim($_POST["beschreibung"]);

        if(empty(trim($_POST["beschreibung"]))){
            $beschreibung= $arrbeschreibung[0];
        }
        else{
            $beschreibung = trim($_POST["beschreibung"]);
        }

        //$datum = trim($_POST["datum"]);

        if(empty(trim($_POST["datum"]))){
            $datum= $arrdatum[0];
        }
        else{
            $datum = trim($_POST["datum"]);
        }

        if(empty(trim($_POST["eintritt"]))){
            $eintritt= $arreintritt[0];
        }
        else{
            $eintritt = trim($_POST["eintritt"]);
        }

       // $einlass = trim($_POST["einlass"]);

        if(empty(trim($_POST["einlass"]))){
            $einlass= $arreinlass[0];
        }
        else{
            $einlass = trim($_POST["einlass"]);
        }

        //$beginn = trim($_POST["beginn"]);

        if(empty(trim($_POST["beginn"]))){
            $beginn= $arrbeginn[0];
        }
        else{
            $beginn = trim($_POST["beginn"]);
        }

        //$ende = trim($_POST["ende"]);

        if(empty(trim($_POST["ende"]))){
            $ende= $arrende[0];
        }
        else{
            $ende = trim($_POST["ende"]);
        }

        $aid = $anbieterid;

        if(empty(trim($_POST["webad"]))){
            $webad = $arrwebad[0];
        }
        else{
            $webad = trim($_POST["webad"]);
        }

        if(empty($_FILES['bild']['size'])){
            $foto=$arrfoto[0];
        }
        else{
            $foto = addslashes(file_get_contents($_FILES['bild']['tmp_name']));
        }
       // $foto = addslashes(file_get_contents($_FILES['bild']['tmp_name']));
        $speicherndb = "UPDATE festl SET Titelbild='$foto' Where FID='".$zid_."'";
        $resultspeichern = $db->Exec($speicherndb);


         $sql = "UPDATE festl SET Bezeichnung=:bezeichnung, PLZ=:plz, Ort=:ort, Strasse=:strasse, Hausnummer=:hausnr, Beschreibung=:beschreibung, Datum=:datum, Eintritt=:eintritt, EinlassAb=:einlass, Beginn=:beginn, Ende=:ende, AID=:anbieterid, Webadresse=:webad WHERE FID='".$zid_."'";

        if($stmt = $pdo->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":bezeichnung", $param_bezeichnung, PDO::PARAM_STR);
            $stmt->bindParam(":plz", $param_plz, PDO::PARAM_STR);
            $stmt->bindParam(":ort", $param_ort, PDO::PARAM_STR);
            $stmt->bindParam(":strasse", $param_strasse, PDO::PARAM_STR);
            $stmt->bindParam(":hausnr", $param_hausnr, PDO::PARAM_STR);
            $stmt->bindParam(":beschreibung", $param_beschreibung, PDO::PARAM_STR);
            $stmt->bindParam(":datum", $param_datum, PDO::PARAM_STR);
            $stmt->bindParam(":eintritt", $param_eintritt, PDO::PARAM_STR);
            $stmt->bindParam(":einlass", $param_einlass, PDO::PARAM_STR);
            $stmt->bindParam(":beginn", $param_beginn, PDO::PARAM_STR);
            $stmt->bindParam(":ende", $param_ende, PDO::PARAM_STR);
            $stmt->bindParam(":webad", $param_webad, PDO::PARAM_STR);
            $stmt->bindParam(":anbieterid", $param_anbieterid, PDO::PARAM_STR);
           // $stmt->bindParam(":foto", $foto);
           // $stmt->bindParam(":foto", $param_foto, PDO::PARAM_STR);

            // Set parameters
            $param_bezeichnung = $bezeichnung;
            $param_plz = $plz;
            $param_ort = $ort;
            $param_strasse = $strasse;
            $param_hausnr = $hausnr;
            $param_beschreibung = $beschreibung;
            $param_datum = $datum;
            $param_eintritt = $eintritt;
            $param_einlass = $einlass;
            $param_beginn = $beginn;
            $param_ende = $ende;
            $param_webad = $webad;
            $param_anbieterid = $anbieterid;
            //$param_foto = $foto;

            // Attempt to execute the prepared statement
            if($stmt->execute()){
            header("location: verwaltunganbieter.php");
            } else{
                echo "Etwas ist schief gelaufen. Bitte probieren Sie es später noch einmal.";
            }

            // Close statement
            unset($stmt);
        }
   // }

    // Close connection
    unset($pdo);

}
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

   <!-- Wrapper -->
    <div id="wrapper">

        <!-- Main -->
        <div id="main">
            <div class="inner">
<div class="modal-dialog">
			<div class="modal-content">
				<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
					<div class="modal-header">
						<h4 class="modal-title">Veranstaltung bearbeiten</h4>
                        <a href="verwaltunganbieter.php" class="btn"><img src="assets/images/baseline_close_black_18dp.png"></a>
					</div>

					<div class="modal-body">

                        <div class="row">
                            <div class="col-6">
                                <div class="form-group <?php echo (!empty($bezeichnung_err)) ? 'has-error' : ''; ?>">
                                    <label>Bezeichnung</label>
                                    <input type="text" name="bezeichnung" class="form-control" value="<?php echo $bezeichnung; ?>">
                                    <span class="help-block"><?php echo $bezeichnung_err; ?></span>
                                </div>
                                <div class="form-group <?php echo (!empty($plz_err)) ? 'has-error' : ''; ?>">
                                    <label>Postleitzahl</label>
                                    <input type="text" name="plz" class="form-control" value="<?php echo $plz; ?>">
                                    <span class="help-block"><?php echo $plz_err; ?></span>
                                </div>
                                <div class="form-group <?php echo (!empty($ort_err)) ? 'has-error' : ''; ?>">
                                    <label>Ort</label>
                                    <input type="text" name="ort" class="form-control" value="<?php echo $ort; ?>">
                                    <span class="help-block"><?php echo $ort_err; ?></span>
                                </div>
                                <div class="form-group <?php echo (!empty($strasse_err)) ? 'has-error' : ''; ?>">
                                    <label>Straße</label>
                                    <input type="text" name="strasse" class="form-control" value="<?php echo $strasse; ?>">
                                    <span class="help-block"><?php echo $strasse_err; ?></span>
                                </div>
                                <div class="form-group <?php echo (!empty($hausnr_err)) ? 'has-error' : ''; ?>">
                                    <label>Hausnummer</label>
                                    <input type="text" name="hausnr" class="form-control" value="<?php echo $hausnr; ?>">
                                    <span class="help-block"><?php echo $hausnr_err; ?></span>
                                </div>
                        </div>
                            <div class="col-6">
                                <div class="form-group <?php echo (!empty($datum_err)) ? 'has-error' : ''; ?>">
                                    <label>Datum</label>
                                    <input type="date" name="datum" class="form-control" value="<?php echo $datum; ?>">
                                    <span class="help-block"><?php echo $datum_err; ?></span>
                                </div>
                                <div class="form-group <?php echo (!empty($eintritt_err)) ? 'has-error' : ''; ?>">
                                    <label>Eintrittspreis in Euro</label>
                                    <input type="text" name="eintritt" class="form-control" value="<?php echo $eintritt; ?>">
                                    <span class="help-block"><?php echo $eintritt_err; ?></span>
                                </div>
                                <div class="form-group <?php echo (!empty($einlass_err)) ? 'has-error' : ''; ?>">
                                    <label>Einlass ab</label>
                                    <input type="time" name="einlass" class="form-control" step="2" value="<?php echo $einlass; ?>">
                                    <span class="help-block"><?php echo $einlass_err; ?></span>
                                </div>
                                <div class="form-group <?php echo (!empty($beginn_err)) ? 'has-error' : ''; ?>">
                                    <label>Beginn</label>
                                    <input type="time" name="beginn" class="form-control" step="2" value="<?php echo $beginn; ?>">
                                    <span class="help-block"><?php echo $beginn_err; ?></span>
                                </div>
                                <div class="form-group <?php echo (!empty($ende_err)) ? 'has-error' : ''; ?>">
                                    <label>Ende</label>
                                    <input type="time" name="ende" class="form-control" step="2" value="<?php echo $ende; ?>">
                                    <span class="help-block"><?php echo $ende_err; ?></span>
                                </div>
                            </div>
                            </div>
                                <div class="form-group <?php echo (!empty($beschreibung_err)) ? 'has-error' : ''; ?>">
                                    <label>Anmerkung</label>
                                    <textarea id="beschreibung" name="beschreibung" rows="10" cols="50" class="form-control" value="<?php echo $beschreibung; ?>"></textarea>
                                    <span class="help-block"><?php echo $beschreibung_err; ?></span>
                                </div>
                                <div class="form-group <?php echo (!empty($webad_err)) ? 'has-error' : ''; ?>">
                                    <label>Webaddresse</label>
                                    <input type="text" name="webad" class="form-control" step="2" value="<?php echo $webad; ?>">
                                    <span class="help-block"><?php echo $webad_err; ?></span>
                                </div>
                                <div class="form-group <?php echo (!empty($foro_err)) ? 'has-error' : '';?>">
                                    <label>Titelbild</label>
                                    <input type="file" name="bild" class="form-control">
                                </div>

					</div>
					<div class="modal-footer">
                        <a href="verwaltunganbieter.php" class="btn">Abbrechen</a>
                         <input type="submit" name="aendern-submit" class="btn btn-primary" value="Speichern">
					</div>
				</form>
			</div>
		</div>
                </div>
        </div>

    </div>
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
