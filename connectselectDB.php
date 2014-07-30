<?php $dbh = mysql_connect("localhost", "marsguil_sysop", "circleofwizards");
if (!$dbh)
{
  die('connectselectDB Could not connect: ' . mysql_error());
}
//This stops SQL Injection in POST vars
foreach ($_POST as $key => $value) {
    $_POST[$key] = mysql_real_escape_string($value);
}
//This stops SQL Injection in GET vars
foreach ($_GET as $key => $value) {
    $_GET[$key] = mysql_real_escape_string($value);
}
mysql_select_db ("marsguil_bulletins", $dbh);
?>
