<?php
  /**
   * Requires the "PHP Email Form" library
   * The "PHP Email Form" library is available only in the pro version of the template
   * The library should be uploaded to: vendor/php-email-form/php-email-form.php
   * For more info and help: https://bootstrapmade.com/php-email-form/
   */

  // Replace contact@example.com with your real receiving email address
  $receiving_email_address = 'deepakumar.sharma.cloud@gmail.com';

  if( file_exists($php_email_form = '../assets/vendor/php-email-form/php-email-form.php' )) {
    include( $php_email_form );
  } else {
    die( 'Unable to load the "PHP Email Form" Library!');
  }

  $contact = new PHP_Email_Form;
  $contact->ajax = true;
  
  // Sanitize user inputs to prevent any unwanted characters or code
  $contact->to = $receiving_email_address;
  $contact->from_name = isset($_POST['name']) ? filter_var($_POST['name'], FILTER_SANITIZE_STRING) : '';
  $contact->from_email = isset($_POST['email']) ? filter_var($_POST['email'], FILTER_SANITIZE_EMAIL) : '';
  $contact->subject = isset($_POST['subject']) ? filter_var($_POST['subject'], FILTER_SANITIZE_STRING) : '';

  // Add messages to be sent to the email
  $contact->add_message( $contact->from_name, 'From');
  $contact->add_message( $contact->from_email, 'Email');
  $contact->add_message( isset($_POST['message']) ? $_POST['message'] : '', 'Message', 10);

  // Uncomment the SMTP settings below if you are using SMTP
  /*
  $contact->smtp = array(
    'host' => 'example.com',
    'username' => 'example',
    'password' => 'password',
    'port' => '587'
  );
  */

  // Send the email and return the result
  if ($contact->send()) {
    echo 'OK';
  } else {
    echo 'Error: ' . $contact->error;
  }
?>
