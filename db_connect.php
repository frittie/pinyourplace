<?php	
define("DB_HOST", "pinyourplace-202424.mysql.binero.se"); 
define("DB_USER", "202424_jj68643");
define("DB_PASS", "Fritte92");
define("DB_NAME", "202424-pinyourplace");

/*define("DB_HOST", "localhost"); 
define("DB_USER", "root");
define("DB_PASS", "");
define("DB_NAME", "googlemaps");*/

$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME) //Koppling till databasen
or die("Could not connect to MySQL server.");

$dbc->set_charset("utf8"); //Berättar för databasen vilket språk vi använder

?>