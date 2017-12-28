<?php

/*
THIS FILE USES PHPMAILER INSTEAD OF THE PHP MAIL() FUNCTION
*/

require 'PHPMailer-master/PHPMailerAutoload.php';

$fromEmail = 'contact@marysjoint.com';
$fromName = 'Demo contact form';

// an email address that will receive the email with the output of the form
$sendToEmail = 'contact@marysjoint.com';
$sendToName = 'Demo contact form';

// the subject of the email
$subject = 'New message from contact form';

// an array of form control names and their English counterparts. If we have input called name <input name="name">, we can call it in our email e.g. Customer Name like this: 'name' => 'Customer Name
//form field names and their translations
//array variable name => text to appear in email
$fields = array('name' => 'Name', 'email' => 'Email', 'subject' => 'Subject', 'message' => 'Message');

// <!--the message text displayed on the web page when the message is successfully sent-->
$okMessage = 'Contact form submitted successfully. We will contact you soon!';

// <!--the text of the message displayed in case of an error-->
$errorMessage = 'There was an error while submitting the contact form. Please try again';


// <!--We will wrap the whole code block in the try/catch block which will catch all the possible errors. -->

// <!--if the POST array where the form values are stored is not empty, continue. Otherwise, if (count($_POST) == 0), throw an  error message-->
// <!--Then, we start building the email message content in $emailText variable.-->
// <!--We iterate through the $_POST ( the array containing all the values sent through the POST request).-->
// <!--If we find out that the key of the item from $_POST array also exists in our $fields array, we include it to the text of the message in $emailText. -->
// <!--We send the email via PHP internal mail() function. We add some important headers to the email using the $headers array (encoding, from header, reply to, etc.)-->
// <!--We create $responseArray variable to be sent as a JSON response back to our index.html. The $responseArray will be handled by our JavaScript function and displayed as a Bootstrap alert box.-->
// <!--If the request came via AJAX (you check this in PHP using the condition if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')) , we send the JSON response. If not, we simply display the message (this should be a rare case - e.g. for users with disabled JavaSript)-->

/*
*  LET'S DO THE SENDING
*/

// if you are not debugging and don't need error reporting, turn this off by error_reporting(0);
error_reporting(E_ALL & ~E_NOTICE);

try
{
    
    if(count($_POST) == 0) throw new \Exception('Form is empty');
    
    $emailTextHtml = "<h1>You have a new message from your contact form</h1><hr>";
    $emailTextHtml .= "<table>";

    foreach ($_POST as $key => $value) {
        // If the field exists in the $fields array, include it in the email
        if (isset($fields[$key])) {
            $emailTextHtml .= "<tr><th>$fields[$key]</th><td>$value</td></tr>";
        }
    }
    $emailTextHtml .= "</table><hr>";
    
    $mail = new PHPMailer;

    $mail->setFrom($fromEmail, $fromName);
    $mail->addAddress($sendToEmail, $sendToName); // you can add more addresses by simply adding another line with $mail->addAddress();
    $mail->addReplyTo($from);
    
    $mail->isHTML(true);

    $mail->Subject = $subject;
    $mail->msgHTML($emailTextHtml); // this will also create a plain-text version of the HTML email, very handy
    
    
    if(!$mail->send()) {
        throw new \Exception('I could not send the email.' . $mail->ErrorInfo);
    }
    
    $responseArray = array('type' => 'success', 'message' => $okMessage);
}
catch (\Exception $e)
{
    // $responseArray = array('type' => 'danger', 'message' => $errorMessage);
    $responseArray = array('type' => 'danger', 'message' => $e->getMessage());
}


// if requested by AJAX request return JSON response
if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
    $encoded = json_encode($responseArray);
    
    header('Content-Type: application/json');
    
    echo $encoded;
}
// else just display the message
else {
    echo $responseArray['message'];
}