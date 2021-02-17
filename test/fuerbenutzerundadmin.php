<?php
session_start();
$username = "root";
$password = "";
$dsn = "mysql:host=localhost;dbname=festlplaner;charset=utf8";

$db = new PDO($dsn,$username,$password);

if (isset($_SESSION['loggedin'])) {
    $benutzerid= $_SESSION["bid"];
}
else
{
    header("Location: login.php");
    die();
}

$sql1= "SELECT * FROM benutzer WHERE BID='".$benutzerid."'";
$result1 = $db->query($sql1);
$i=0;
$arrvorname=array();
$arrnachname=array();
$arrgebdat=array();
$arremail=array();

while($row1 = $result1->fetch()){
    $arrvorname[$i]= $row1['Vorname'];
    $arrnachname[$i]= $row1['Nachname'];
    $arrgebdat[$i]= $row1['Gebdat'];
    $arremail[$i]= $row1['Email'];


    $i++;
}
$date = DateTime::createFromFormat('Y-m-d', $arrgebdat[0]);
$converted_date = $date->format('d.m.Y');

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

</body>
</html>
