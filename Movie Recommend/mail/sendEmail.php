<?php

// Replace this with your own email address
$siteOwnersEmail = 'sharmaanupriya003@gmail.com';

if ($_POST) {
    $name = trim(stripslashes($_POST['Full_Name']));
    $email = trim(stripslashes($_POST['Email']));
    $phoneNumber = trim(stripslashes($_POST['Phone_number']));
    $message = trim(stripslashes($_POST['Message']));

    // Check Name
    if (strlen($name) < 2) {
        $error['name'] = "Please enter your name.";
    }
    // Check Email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error['email'] = "Please enter a valid email address.";
    }
    // Check Message
    if (strlen($message) < 15) {
        $error['message'] = "Please enter your message. It should have at least 15 characters.";
    }

    // Subject
    $subject = "Contact Form Submission";

    // Set Message
    $messageBody = "
    <!DOCTYPE html>
    <html>
    <head>
      <style>
        body {
          font-family: Arial, sans-serif;
          background-color: #f4f4f4;
          margin: 0;
          padding: 0;
        }
        .container {
          max-width: 600px;
          margin: 0 auto;
          padding: 20px;
          background-color: white;
          box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
          border-radius: 10px;
          margin-top: 20px;
        }
        .header {
          text-align: center;
          margin-bottom: 20px;
        }
        .header img {
          max-width: 200px;
          height: auto;
        }
        .content {
          padding: 20px;
          border: 1px solid #ccc;
          background-color: #fff;
          border-radius: 10px;
        }
        .content p {
          margin: 0 0 10px 0;
        }
        .footer {
          text-align: center;
          margin-top: 20px;
          font-size: 12px;
          color: #888;
        }
      </style>
    </head>
    <body>
      <div class='container'>
        <div class='header'>
           <img src='https://anuragyadav.heroitec.cloud/images/heroitec_logo.png' alt='Logo'>
        </div>
        <div class='content'>
          <h2 style='color: #333;'>Contact Form Submission</h2>
          <p><strong>Name:</strong> <span style='color: #555;'>$name</span></p>
          <p><strong>Email:</strong> <span style='color: #555;'>$email</span></p>
          <p><strong>Phone Number:</strong> <span style='color: #555;'>$phoneNumber</span></p>
          <p><strong>Message:</strong><br><span style='color: #555;'>$message</span></p>
          <hr>
          <p style='color: #555;'>This email is received from your website.</p>
        </div>
        <div class='footer'>
          <p>&copy; 2023 Anupriya Sharma | <a href='#' style='color: #888;'>Anupriya Sharma</a></p>
        </div>
      </div>
    </body>
    </html>
    ";

    // Set From: header
    $from =  $name . " <" . $email . ">";

    // Email Headers
    $headers = "From: " . $from . "\r\n";
    $headers .= "Reply-To: " . $email . "\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

    if (!isset($error)) {
        ini_set("sendmail_from", $siteOwnersEmail); 
        $mail = mail($siteOwnersEmail, $subject, $messageBody, $headers);

        if ($mail) {
            echo "OK";
        } else {
            echo "Something went wrong. Please try again.";
        }
    } else {
        $response = (isset($error['name'])) ? $error['name'] . "<br /> \n" : null;
        $response .= (isset($error['email'])) ? $error['email'] . "<br /> \n" : null;
        $response .= (isset($error['message'])) ? $error['message'] . "<br />" : null;

        echo $response;
    }
}

?>
