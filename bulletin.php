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

<script type="text/javascript">

function getBirthdayMonth(sel) {
   var combval = document.getElementById("comboBirthdayMonth").value;
   document.forms[0].inpBirthdayMonth.value = combval;
}

</script>
</HEAD>

<BODY bgcolor="#42B0FF">
<BR>
<H1>
<font color="#FFFFFF">Post to bulletin</font>
</H1>
<BR>

<form name="input" action="processBulletin.php" method="get">
<BR>
<BR>
Description:
<br>
<input type="text" name="description" size="88">
<br>
<br>
Long Description:
<br>
<TEXTAREA name="longdescription" ROWS=10 COLS=63></TEXTAREA>
<BR>
<BR>
From:
<br>
<input type="text" name="from" size="60" value="<?php echo $_GET['from'];?>" />
<br>
<br>
<input type="hidden" name="companyID" value="<?php echo $_GET['id'];?>" />
<!-- <input type="hidden" name="inpBirthdayMonth" value="5"> -->
<input type="submit" value="Submit">
</form>

<BR>
<BR>

</BODY>
<HTML>