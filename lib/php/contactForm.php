<?php
if(isset($_POST['email'])) {
    $emailTo = "";
    $subject = "Dev Site: " . $_POST['domain'];
 
    function died($error) {
        // error code
        echo "We are very sorry, but there were error(s) found with the form you submitted. ";
        echo "These errors appear below.<br /><br />";
        echo $error."<br /><br />";
        echo "Please go back and fix these errors.<br /><br />";
        die();
    }
 
    // validation check, does data exists
    if(!isset($_POST['email']) ||
        !isset($_POST['domain']) ||
        !isset($_POST['ticket']) ||
        !isset($_POST['request']) ||
        !isset($_POST['message'])) {
        died('We are sorry, but there appears to be a problem with the form you submitted.');       
    }
    
    // required data to be outputted
    $email = $_POST['email'];
    $domain = $_POST['domain'];
    $ticket = $_POST['ticket'];
    $request = $_POST['request']; 
    $message = $_POST['message']; 
 
    $error_message = "";
    $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';
 
  if(!preg_match($email_exp,$email)) {
    $error_message .= 'The Email Address you entered does not appear to be valid.<br />';
  }
 
    $string_exp = "/^[A-Za-z .'-]+$/";
 
  if(!preg_match($string_exp,$domain)) {
    $error_message .= 'The First Name you entered does not appear to be valid.<br />';
  }
 
  if(!preg_match($string_exp,$ticket)) {
    $error_message .= 'The Last Name you entered does not appear to be valid.<br />';
  }

  if(!preg_match($string_exp,$request)) {
    $error_message .= 'The Last Name you entered does not appear to be valid.<br />';
  }
 
  if(strlen($message) < 2) {
    $error_message .= 'The Comments you entered do not appear to be valid.<br />';
  }
 
  if(strlen($error_message) > 0) {
    died($error_message);
  }
 
    $email_message = "Dev site request details below.\n\n";
     
    function clean_string($string) {
      $bad = array("content-type","bcc:","to:","cc:","href");
      return str_replace($bad,"",$string);
    }
 
    // email message with required data
    $email_message .= "Domain: ".clean_string($domain)."\n";
    $email_message .= "Original Ticket ID: ".clean_string($ticket)."\n";
    $email_message .= "Request Type: ".clean_string($request)."\n";
    $email_message .= "Include any other relevant information: ".clean_string($message)."\n";

// create email headers
$headers = 'From: '.$email."\r\n".
'Reply-To: '.$email."\r\n" .
'X-Mailer: PHP/' . phpversion();
@mail($emailTo, $subject, $email_message, $headers);  
?>
 
<!-- success message -->
 The dev site request form has been successfully submitted. 

<?php
}
?>
