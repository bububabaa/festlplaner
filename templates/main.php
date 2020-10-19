<?php
error_reporting(-1);
ini_set('display_errors','On');

/*
require_once 'config/database.php';
$db = new PDO($dsn, $username, $password);

$sql = "SELECT id, titel, beschreibung, preis, anzahl, produktbild FROM products";
$result = $db->query($sql);*/
?>

<!doctype html>
<html lang="de">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="assets/css/bootstrap.css">

    <title>Shop</title>
  </head>
  <body>
    <div class="container">
      <?php include __DIR__.'/header.php'?>

        <section class="container">
            <div class="row">
                <?php
                    while($row = $result->fetch())
                    include 'card.php';
                ?>
            </div>
        </section>
    </div>

    <!-- Optional JavaScript -->
    <script src="assets/js/bootstrap.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
  </body>
</html>
