<?php
/* Database credentials. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
/*define('DB_SERVER', 'sql349.your-server.de');
define('DB_USERNAME', 'digbizm_1');
define('DB_PASSWORD', '2021##Fireme');
define('DB_NAME', 'festlpage');*/

define('DB_SERVER', 'projects.hakmistelbach.ac.at');
define('DB_USERNAME', 'c31festlplaner');
define('DB_PASSWORD', 'Festlplaner2020');
define('DB_NAME', 'c31festlplaner');
/* Attempt to connect to MySQL database */
try{
    //$pdo = new PDO("mysql:host=sql349.your-server.de;dbname=festlpage" . DB_SERVER . ";dbname=" . DB_NAME, DB_USERNAME, DB_PASSWORD);
    $pdo = new PDO("mysql:host=projects.hakmistelbach.ac.at;dbname=c31festlplaner" . DB_SERVER . ";dbname=" . DB_NAME, DB_USERNAME, DB_PASSWORD);
    // Set the PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e){
    die("ERROR: Could not connect. " . $e->getMessage());
}
?>
