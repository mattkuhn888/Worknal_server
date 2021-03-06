<?php

function getStatusCodeMessage($status)
{
    // these could be stored in a .ini file and loaded
    // via parse_ini_file()... however, this will suffice
    // for an example
    $codes = Array(
        100 => 'Continue',
        101 => 'Switching Protocols',
        200 => 'OK',
        201 => 'Created',
        202 => 'Accepted',
        203 => 'Non-Authoritative Information',
        204 => 'No Content',
        205 => 'Reset Content',
        206 => 'Partial Content',
        300 => 'Multiple Choices',
        301 => 'Moved Permanently',
        302 => 'Found',
        303 => 'See Other',
        304 => 'Not Modified',
        305 => 'Use Proxy',
        306 => '(Unused)',
        307 => 'Temporary Redirect',
        400 => 'Bad Request',
        401 => 'Unauthorized',
        402 => 'Payment Required',
        403 => 'Forbidden',
        404 => 'Not Found',
        405 => 'Method Not Allowed',
        406 => 'Not Acceptable',
        407 => 'Proxy Authentication Required',
        408 => 'Request Timeout',
        409 => 'Conflict',
        410 => 'Gone',
        411 => 'Length Required',
        412 => 'Precondition Failed',
        413 => 'Request Entity Too Large',
        414 => 'Request-URI Too Long',
        415 => 'Unsupported Media Type',
        416 => 'Requested Range Not Satisfiable',
        417 => 'Expectation Failed',
        500 => 'Internal Server Error',
        501 => 'Not Implemented',
        502 => 'Bad Gateway',
        503 => 'Service Unavailable',
        504 => 'Gateway Timeout',
        505 => 'HTTP Version Not Supported'
    );

    return (isset($codes[$status])) ? $codes[$status] : '';
}

function sendResponse($status = 200, $body = '', $content_type = 'text/html')
{
    $status_header = 'HTTP/1.1 ' . $status . ' ' . getStatusCodeMessage($status);
    header($status_header);
    header('Content-type: ' . $content_type);
    echo $body;
}

class CreateCompany {

    private $db;

    // Constructor
    function __construct() {
        
        
    }

    // Destructor
    function __destruct() {
        
    }

    function createCompany() {
    
        // Check for required parameters
        if (isset($_POST["company_domain"])) {
        
            // Put parameters into local variables
            $companydomain = $_POST["company_domain"];

            //// Look up $company_domain in DB

            //// If Not Found, create it:

            //////////////////////////////////////////////////////////////////

            $dbh = ""; 
            include($DOCUMENT_ROOT . '../../bulletinobfus/connectselectDB.php');

            $sql = "SELECT * FROM Companies WHERE " . "CompanyDomainName = '{$companydomain}'";

            $res = mysql_query($sql,$dbh) or die('createCompany Error: ' . mysql_error());

            $numrowsret = mysql_num_rows($res);

            $companyID = "";
            $report = "";
            if($numrowsret == 0) {

	       $report = "Company not found";

               ////////////////////////////////////////////////////
               ///////////////// So create the company ////////////

               $sqltwo = "INSERT INTO Companies (CompanyDomainName) VALUES ('$companydomain')";

               if (!mysql_query($sqltwo,$dbh))
               {
                  die('createCompany insert error: ' . mysql_error());
               }

               $uid = mysql_insert_id(); 

               $companyID = $uid;

               ////////// Now create this company's bulletin table:

               $thetablename = "BulletinsForCompany" . $uid;

               $sqlthree = "CREATE TABLE $thetablename (lineID int NOT NULL AUTO_INCREMENT,
                       PRIMARY KEY(lineID),
                       EntryDate DATETIME DEFAULT NULL,
                       FromPerson varchar(80),
                       Comments varchar(140),
                       CommentsLong varchar(280))";

               if (!mysql_query($sqlthree,$dbh))
               {
                    die('createCompany create user table error: ' . mysql_error());
               }
        
               ////////////////////////////////////////////////////

            } else {

               $row = mysql_fetch_assoc($res);

               $report = "Company found";

               $companyID = $row['companyID'];

               mysql_free_result($res);
            }

            mysql_close($dbh);

            //////////////////////////////////////////////////////////////////
     
            // Return stuff, encoded with JSON
            $result = array(
                "email" => $email,
                "sql" => $sql,
                "report" => $report,
                "companyID" => $companyID,
                "sqltwo" => $sqltwo,
                "thetablename" => $thetablename,
                "sqlthree" => $sqlthree,
            );

            sendResponse(200, json_encode($result));
            return true;
        }
        sendResponse(400, 'Invalid request');
        return false;
    
    }

}

$api2 = new CreateCompany;
$api2->createCompany();


?>