<?php
require_once __DIR__.'/config/database.php';
session_start();

$username = "root";
$password = "";
$dsn = "mysql:host=localhost;dbname=festlplaner;charset=utf8";
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
$sql1= "SELECT * FROM anbieter WHERE AID='".$zid_."'";
$result1 = $db->query($sql1);
$i=0;
$arrverified=array();
while($row1 = $result1->fetch()){
    $arrverified[$i]= $row1['Verified'];
    $i++;
}


if(($arrverified[0])==0)
{
        $verified=1;
        $stmt=$db->prepare("UPDATE anbieter SET Verified=:verified WHERE AID=:zid");
        $stmt->bindParam(":verified",$verified,PDO::PARAM_INT);
        $stmt->bindParam(":zid",$zid_,PDO::PARAM_INT);
        $stmt->execute();

        header("Location: anbieterverwalten.php");
}
else
{
        $verified=0;
        $stmt=$db->prepare("UPDATE anbieter SET Verified=:verified WHERE AID=:zid");
        $stmt->bindParam(":verified",$verified,PDO::PARAM_INT);
        $stmt->bindParam(":zid",$zid_,PDO::PARAM_INT);
        $stmt->execute();

        header("Location: anbieterverwalten.php");
}

?>
