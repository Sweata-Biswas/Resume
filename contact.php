<?php
if(isset($_POST) && !empty($_POST)){
  

    if(isset($_POST['submit'])) {

        $email_to = "biswassweata22@gmail.com";
        $email_subject = "Contacted from your virtual Resume";
     
        function died($error) {
            // your error code can go here
            echo "We are very sorry, but there were error(s) found with the form you submitted. ";
            echo "These errors appear below.<br /><br />";
            echo $error."<br /><br />";
            echo "Please go back and fix these errors.<br /><br />";
            die();
        }
     
     
        // validation expected data exists
        if(
            !isset($_POST['name']) ||
           !isset($_POST['email']) ||
           !isset($_POST['mobile'])) {
            died('We are sorry, but there appears to be a problem with the form you submitted.');      
        }
     
         
        $message='';
       $lname="";
        $name = $_POST['name']; // required
         $email_from = $_POST['email']; // required
     
        $mobile = $_POST['mobile'];// required
       
      
       
     
        $error_message = "";
        $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';
     
      if(!preg_match($email_exp,$email_from)) {
        $error_message .= 'The Email Address you entered does not appear to be valid.<br />';
      }
     
        $string_exp = "/^[A-Za-z .'-]+$/";
     
      if(!preg_match($string_exp,$name)) {
        $error_message .= 'The First Name you entered does not appear to be valid.<br />';
      }
     
     
      if(strlen($error_message) > 0) {
        died($error_message);
      }
     
        $email_message = "<-----Contacted by my virtual resume--------->\n\n";
        if(isset($_POST['message'])){
          $message = $_POST['message'];// required
          
        } if(isset($_POST['lname'])){
          $lname = $_POST['lname'];// required
        }
         
        function clean_string($string) {
          $bad = array("content-type","bcc:","to:","cc:","href");
          return str_replace($bad,"",$string);
        }
     
         
     
       
        $email_message .= "name: ".clean_string($name)." ".clean_string($lname)."\n";
       $email_message .= "Email: ".clean_string($email_from)."\n";
     
       $email_message .= "Phone number: ".clean_string($mobile)."\n";
       $email_message .= "Message :".clean_string($message) ."\n";
     
    // create email headers
    $headers = 'From: '.$email_from."\r\n".
    'Reply-To: '.$email_from."\r\n" .
    'X-Mailer: PHP/' . phpversion();
    @mail($email_to, $email_subject, $email_message, $headers);  
    ?>
     
    <!-- include your own success html here -->
     
    <script>alert("Thank you for contact with us, We will be in touch with you very soon..!");
    window.history.back();
location.reload(); </script>
     
    <?php
     
    }


}
exit();
?>