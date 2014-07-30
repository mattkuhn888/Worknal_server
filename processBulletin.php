<?php 

//This stops SQL Injection in POST vars
//foreach ($_POST as $key => $value) {
//    $_POST[$key] = mysql_real_escape_string($value);
//}
//This stops SQL Injection in GET vars
//foreach ($_GET as $key => $value) {
//    $_GET[$key] = mysql_real_escape_string($value);
//}

?>
<HTML>
<HEAD>
<TITLE>Bulletin</TITLE>
</HEAD>

<BODY bgcolor="#42B0FF">
<BR>

<H1>
<font color="#FFFFFF">Bulletin</font>
</H1>
<BR>
<font color="#000000">Your bulletin entry has been added.</font> 
<BR>
<BR>
<font color="#505050">Thank you.</font> 
<BR>
<BR>
<BR>
<BR>
<BR>


<?php 

$tUnixTime = time();
$myTimestamp = gmdate("Y-m-d H:i:s", $tUnixTime);


// $theNumberRating = $_GET['inpBirthdayMonth'];
$theFrom = $_GET['from'];
$theDescription = $_GET['description'];
$theLongDescription = $_GET['longdescription'];

include($DOCUMENT_ROOT . '../bulletinobfus/connectselectDB.php');

$theTableName = "BulletinsForCompany" . $_GET['companyID'];

$sql = "INSERT INTO $theTableName 
 (
EntryDate,
FromPerson,
Comments,
CommentsLong
)
VALUES
(
'$myTimestamp',
'$theFrom',
'$theDescription',
'$theLongDescription'
)";

  $res = mysql_query($sql,$dbh) or die('processBulletin insert error: ' . mysql_error());

  mysql_close($dbh);

?>

</BODY>
<HTML>
