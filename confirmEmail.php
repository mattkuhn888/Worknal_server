<?php

echo "Worknal - Thank you for confirming your email.";

       //echo $_GET["email"];


      // Check for required parameters
        if (isset($_GET["email"])) {

            //echo "is set";
        
            // Put parameters into local variables
            $email = $_GET["email"];

            //// Look up $email in DB

            //// If Not Found, create it:

            //////////////////////////////////////////////////////////////////

            $dbh = ""; 
            include($DOCUMENT_ROOT . '../bulletinobfus/connectselectDB.php');

            $sql = "SELECT * FROM Users WHERE " . "Email = '{$email}'";

            $res = mysql_query($sql,$dbh) or die('createUser Error: ' . mysql_error());

            $numrowsret = mysql_num_rows($res);

            $personID = "";
            $report = "";
            if($numrowsret == 0) {

	       //$report = "User not found";

               ////////////////////////////////////////////////////
               ///////////////// So create the user ///////////////

               $sqltwo = "INSERT INTO Users (Email) VALUES ('$email')";

               if (!mysql_query($sqltwo,$dbh))
               {
                  die('createUser insert error: ' . mysql_error());
               }

               $uid = mysql_insert_id(); 

               $personID = $uid;

            } else {

               $row = mysql_fetch_assoc($res);

               $report = "User found";

               $personID = $row['personID'];

               mysql_free_result($res);
            }

            mysql_close($dbh);

            //echo $report;


        } else {
             //echo "is not set";
        }

        echo "<br>";
        echo "<br>";
        echo "Return to the app and log in.";
 
?>

