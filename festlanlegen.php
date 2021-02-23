<?php
session_start();

if (isset($_SESSION['loggedin'])) {

}
else
{
    header("Location: login.php");
    die();
}

    require_once __DIR__.'/config/database.php';
    $bezeichnung = $plz = $ort = $strasse = $hausnr = $beschreibung = $datum = $eintritt = $einlass = $beginn = $ende="";
    $bezeichnung_err = $plz_err = $ort_err = $strasse_err = $hausnr_err = $beschreibung_err = $datum_err = $eintritt_err = $einlass_err = $beginn_err = $ende_err =$aid_err="";
    $foto = $webad ="";
    $foto_err =$webad_err="";
    //echo $_SESSION["id"];
    $aid =$_SESSION["id"];

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){

    if(empty(trim($_POST["bezeichnung"]))){
        $bezeichnung_err = "Bitte geben Sie eine Bezeichnung ein.";
    }
    else{
        $bezeichnung = trim($_POST["bezeichnung"]);
    }

    if(empty(trim($_POST["plz"]))){
        $plz_err = "Bitte geben Sie eine Postleitzahl ein.";
    }
    else{
        $plz = trim($_POST["plz"]);
    }

    if(empty(trim($_POST["ort"]))){
        $ort_err = "Bitte geben Sie Ihren Ort ein.";
    }
    else{
        $ort = trim($_POST["ort"]);
    }

    if(empty(trim($_POST["strasse"]))){
        $strasse_err = "Bitte geben Sie Ihre Straße ein.";
    }
    else{
        $strasse = trim($_POST["strasse"]);
    }

    if(empty(trim($_POST["hausnr"]))){
        $hausnr_err = "Bitte geben Sie die Hausnummer des Veranstaltungsortes ein.";
    }
    else{
        $hausnr = trim($_POST["hausnr"]);
    }

    if(empty(trim($_POST["beschreibung"]))){
        $beschreibung_err = "Bitte geben Sie eine Beschreibung ein.";
    }
    else{
        $beschreibung = trim($_POST["beschreibung"]);
    }

    if(empty(trim($_POST["datum"]))){
        $datum_err = "Bitte geben Sie ein Datum ein.";
    }
    else{
        $datum = trim($_POST["datum"]);
    }

    if(empty(trim($_POST["eintritt"]))){
        $eintritt= "0.00";
    }
    else{
        $eintritt = trim($_POST["eintritt"]);
    }

    if(empty(trim($_POST["einlass"]))){
        $einlass_err = "Bitte geben Sie die Uhrzeit ein zu der Personen eingelassen werden.";
    }
    else{
        $einlass = trim($_POST["einlass"]);
    }

    if(empty(trim($_POST["beginn"]))){
        $beginn_err = "Bitte geben Sie die Uhrzeit ein zu der die Veranstaltung beginnt.";
    }
    else{
        $beginn = trim($_POST["beginn"]);
    }
    if(empty(trim($_POST["ende"]))){
        $ende_err = "Bitte geben Sie die Uhrzeit ein zu der die Veranstaltung endet.";
    }
    else{
        $ende = trim($_POST["ende"]);
    }

    $aid = trim($_POST["aid"]);

    if(empty(trim($_POST["webad"]))){
        $webad = "";
    }
    else{
        $webad = trim($_POST["webad"]);
    }

    //$foto=$_POST['bild'];
    $foto = addslashes(file_get_contents($_FILES['bild']['tmp_name']));


    // Check input errors before inserting in database
    if(empty($bezeichnung_err) && empty($plz_err) && empty($ort_err) && empty($strasse_err) && empty($beschreibung_err) && empty($datum_err) && empty($eintritt_err) && empty($einlass_err) && empty($beginn_err)){

        // Prepare an insert statement
        $sql = "INSERT INTO festl (Bezeichnung, PLZ, Ort, Strasse, Hausnummer, Beschreibung, Datum, Eintritt, EinlassAb, Beginn, Ende, AID, Webadresse, Titelbild) VALUES (:bezeichnung, :plz, :ort, :strasse, :hausnr, :beschreibung, :datum, :eintritt, :einlass, :beginn, :ende, :aid, :webad,'$foto')";

        // $sql = "INSERT INTO benutzer (Vorname, Nachname, Gebdat, Email, Passwort) VALUES (:vorname, :nachname, :gebdat, :email, :psw)";

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
            $stmt->bindParam(":aid", $param_aid, PDO::PARAM_STR);
            $stmt->bindParam(":webad", $param_webad, PDO::PARAM_STR);
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
            $param_aid = $aid;
            $param_webad = $webad;
            //$param_foto = $foto;

            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // Redirect to login page
            header("location: anbieterprofil.php");
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
<link rel="icon" type="image/x-icon" href="assets/images/favicon.ico">
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
                                            <h2>Veranstaltung hinzufügen</h2>
                                            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
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
                                                <div class="form-group <?php echo (!empty($beschreibung_err)) ? 'has-error' : ''; ?>">
                                                    <label>Anmerkung</label>
                                                    <textarea id="beschreibung" name="beschreibung" rows="10" cols="50" class="form-control" value="<?php echo $beschreibung; ?>"></textarea>
                                                    <span class="help-block"><?php echo $beschreibung_err; ?></span>
                                                </div>
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
                                                <div class="form-group <?php echo (!empty($webad_err)) ? 'has-error' : ''; ?>">
                                                    <label>Webaddresse</label>
                                                    <input type="text" name="webad" class="form-control" step="2" value="<?php echo $webad; ?>">
                                                    <span class="help-block"><?php echo $webad_err; ?></span>
                                                </div>
                                                <div class="form-group <?php echo (!empty($foro_err)) ? 'has-error' : '';?>">
                                                    <input type="file" name="bild" class="form-control">
                                                </div>

                                                <div class="form-group <?php echo (!empty($aid_err)) ? 'has-error' : ''; ?>">
                                                    <input type="hidden" name="aid" class="form-control" value="<?php echo $aid; ?>">
                                                </div>
                                                <div class="form-group">
                                                    <input type="submit"class="btn btn-primary" value="Speichern">
                                                    <a class="btn btn-link" href="anbieterprofil.php">Abbrechen</a>
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
