<html>
<head>
<title>Create Bulletin Users Table</title>
</head>
<body>
<?php $dbh = ""; include($DOCUMENT_ROOT . '../../bulletinobfus/connectselectDB.php');

$sql = "CREATE TABLE Users (

personID int NOT NULL AUTO_INCREMENT,
PRIMARY KEY(personID),

DateCreated DATETIME DEFAULT NULL,
LastUpdated TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,

FirstName varchar(64),
LastName varchar(64),
PhoneNumber varchar(24),
Email varchar(64),
SecPassword varchar(256),
VerifiedEmail int,
LastLogin DATETIME,
NumLoginsTotal int,
FailedLoginAttempts int,
WaitClock DATETIME,
ForgotPassword int,
ForgotPasswordCode int,
CodeExpireClock DATETIME

)";

if (!mysql_query($sql,$dbh)) {
    die('Error: ' . mysql_error());
}

mysql_close($dbh);

echo "<br><br><p>Bulletin Users Table created</p></br></br>";

?>
</body>
</html>