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
<TITLE>Comment on Bulletin</TITLE>
</HEAD>

<BODY bgcolor="#42B0FF">
<BR>

<H1>
<font color="#FFFFFF">Comment on Bulletin</font>
</H1>
<BR>
<font color="#000000">Your bulletin comment has been posted.</font> 
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

$theTableName = "CommentsForCompany" . $_GET['companyID'] . "Bulletin" . $_GET['bulletinID'];


// check if comments table exists for this bulletin and company id pair

if(mysql_num_rows(mysql_query("SHOW TABLES LIKE '".$theTableName."'"))==1) { 
    //echo "Debug: " . $theTableName . " exists";
} else {
    //echo "Debug: " . $theTableName . " does not exist... creating:";

    $sqlpre = "CREATE TABLE $theTableName (lineID int NOT NULL AUTO_INCREMENT,
                       PRIMARY KEY(lineID),
                       EntryDate DATETIME DEFAULT NULL,
                       FromPerson varchar(80),
                       Comments varchar(140),
                       CommentsLong varchar(280))";

     if (!mysql_query($sqlpre,$dbh))
     {
          die('createBulletinCommentsTable create table error: ' . mysql_error());
     }

     mysql_free_result($sqlpre);
     //mysql_close($dbh);
}


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