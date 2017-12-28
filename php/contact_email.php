<?php

//the email address that will be in the From field of the email
$from = 'contact@marysjoint.com';

// the email address that will receive the email with the output of the form. 
$sendTo = 'contact@marysjoint.com';

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

error_reporting(E_ALL & ~E_NOTICE);

try
{
    if(count($_POST) == 0) throw new \Exception("Form is empty");
    
    $emailText = "You have a new message from your website contact form\n";
    
    foreach($_POST as $key => $value)
    {
        //if the field exists in the $fields array, include that field in the email
        if(isset($fields[$key]))
        {
            $emailText .= "$fields[$key]: $value\n";
        }
    }
    
    //All the necessary headers for the email
    $headers = array('Content-type: text/plain; charset="UTF-8";',
        'From: ' . $from,
        'Reply-To: ' . $from, 
        'Return-Path: ' . $from,
    );
    
    //Send the email!
    mail($sendTo, $subject, $emailText, implode("\n", $headers));
    
    $responseArray = array('type' => 'success', 'message' => $okMessage);
}

catch(\Exception $e)
{
    $responseArray = array('type' => 'danger', 'message' => $errorMessage);
}

// if requested by AJAX request return JSON response
if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') 
{
    $encoded = json_encode($responseArray);

    header('Content-Type: application/json');

    echo $encoded;
}
// else just display the message
else 
{
    
    echo $responseArray['message'];
    
}

?>