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

class SendConfirmationEmail {

    private $db;

    // Constructor
    function __construct() {

    }

    // Destructor
    function __destruct() {

    }

    function sendConfirmationEmail() {
    
        // Check for required parameters
        if (isset($_POST["email"])) {
        
            // Put parameters into local variables
            $email = $_POST["email"];


            //////////////////////////////////////////////////////////////////
            $theArray = array();

            $to = $email;
            $subject = "Confirm your Worknal sign-up email";
            $message = "Click here to confirm your Worknal sign-up email: http://www.marsguild.com/confirmEmail.php?email=" . $email . "";
            $headers = "";

            if (mail($to, $subject, $message, $headers, "-f noreply@marsguild.com")) {
		echo "";
            } else {
                //echo "send mail failed";
                sendResponse(403, 'Send mail failed');
                return false;
            } 

            //////////////////////////////////////////////////////////////////

            // Return stuff, encoded with JSON

             $theKey = "Empty";
             $theArray[$theKey] = array("email" => $email,
                                               );

            sendResponse(200, json_encode($theArray));

            return true;
        }
        sendResponse(400, 'Invalid request');
        return false;
    
    }

}

$api = new SendConfirmationEmail;
$api->sendConfirmationEmail();

?>