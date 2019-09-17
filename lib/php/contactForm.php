<?php
if(isset($_POST['email'])) {
    // required data to be outputted
    $emailTo = "";
    $subject = "Dev site request: " . $_POST['domain'];
    $email = $_POST['email'];
    $domain = $_POST['domain'];
    $ticket = $_POST['ticket'];
    $request = $_POST['request']; 
    $copyFrom = $_POST['subDomainFrom'];
    $copyTo = $_POST['subDomainTo'];
    $subDomain = $_POST['subDomain'];
    $message = "Include any other relevant information: " . $_POST['message']; 

    function died($error) {
        // error code
        echo "We are very sorry, but there were error(s) found with the form you submitted. <br />";
        echo "These errors appear below.<br /><br />";
        echo $error."<br /><br />";
        echo "Please go back and fix these errors.<br /><br />";
        die();
    }

    // validation check, does data exists
    if(!isset($_POST['email']) ||
        !isset($_POST['domain']) ||
        !isset($_POST['ticket']) ||
        !isset($_POST['request'])) {
        died('We are sorry, but there appears to be a problem with the form you submitted.');       
    }
    
    $error_message = "";
    $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';

  if(!preg_match($email_exp,$email)) {
    $error_message .= 'The Email Address you entered does not appear to be valid.<br />';
  } 
    $string_exp = "/^[A-Za-z .'-]+$/";
  
  if(!preg_match($string_exp,$domain)) {
    $error_message .= 'The domain you entered does not appear to be valid.<br />';
  }

  if(!preg_match($string_exp,$request)) {
    $error_message .= 'Appears you have not made a request type selection.<br />';
  }
 
  if(strlen($error_message) > 0) {
    died($error_message);
  }
     
    function clean_string($string) {
      $bad = array("content-type","bcc:","to:","cc:","href");
      return str_replace($bad,"",$string);
    }

    $email_message = "Dev site request details below.\n\n";

    if($request == 'fresh install') {
        // email message with required data
        $email_message .= "Please create a ".clean_string($request)." to *".clean_string($subDomain)."*.\n\n";
        if(empty($_POST['message'])){
        } else {
            $email_message .= clean_string($message)."\n\n";
        }
        $email_message .= "Domain: ".clean_string($domain)."\n";
        $email_message .= "Original Ticket ID: ".clean_string($ticket)."\n"; 
    } else {
        // this works when copy of is selected and copy from and copy to data is entered
        $email_message .= "Please create a ".clean_string($request)." *".clean_string($copyFrom)."* to *".clean_string($copyTo)."*.\n\n";
        if(empty($_POST['message'])){
        } else {
            $email_message .= clean_string($message)."\n\n";
        }
        $email_message .= "Domain: ".clean_string($domain)."\n";
        $email_message .= "Original Ticket ID: ".clean_string($ticket)."\n"; 
    }

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
