<?php
session_start();
$username = "root";
$password = "";
$dsn = "mysql:host=localhost;dbname=festlplaner;charset=utf8";

$db = new PDO($dsn,$username,$password);

if (isset($_SESSION['loggedin'])) {
    $anbieterid= $_SESSION["id"];
}
else
{
    header("Location: login.php");
    die();
}

$sql1= "SELECT * FROM anbieter WHERE AID='".$anbieterid."'";
$result1 = $db->query($sql1);
$i=0;
$arrname=array();
$arransprechsperson=array();
$arrtelefon=array();
$arremail=array();
$arrplz = array();
$arrort = array();
$arrstrasse = array();
while($row1 = $result1->fetch()){
    $arrname[$i]= $row1['Name'];
    $arransprechsperson[$i]= $row1['Ansprechsperson'];
    $arrtelefon[$i]= $row1['Telefon'];
    $arremail[$i]= $row1['Email'];
    $arrplz[$i]= $row1['PLZ'];
    $arrstrasse[$i]= $row1['Strasse'];
    $arrort[$i]= $row1['Ort'];

    $i++;
}
;

?>
<style>
    table{
        border: 1px solid black;
    }
    th{
        width: auto;
        text-align: left;
        border-right: 1px solid black;
    }
</style>
<!DOCTYPE html>
<html lang="de">
    <body>
<table>
  <tr>
    <th scope="row">Name</th>
    <td><?php echo $arrname[0] ?></td>
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

</body>
</html>
