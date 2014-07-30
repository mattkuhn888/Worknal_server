<html>
<head>
<title>Create Bulletin Companies Table</title>
</head>
<body>
<?php $dbh = ""; include($DOCUMENT_ROOT . '../../bulletinobfus/connectselectDB.php');

$sql = "CREATE TABLE Companies (

companyID int NOT NULL AUTO_INCREMENT,
PRIMARY KEY(companyID),

DateCreated DATETIME DEFAULT NULL,
LastUpdated TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,

CompanyName varchar(128),
CompanyDomainName varchar(128)

)";

if (!mysql_query($sql,$dbh)) {
    die('Error: ' . mysql_error());
}

mysql_close($dbh);

echo "<br><br><p>Bulletin Companies Table created</p></br></br>";

?>
</body>
</html>