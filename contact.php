<?php 

require 'includes/init.php';
require 'config.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/PHPMailer/src/Exception.php';
require 'vendor/PHPMailer/src/PHPMailer.php';
require 'vendor/PHPMailer/src/SMTP.php';

$email = '';
$subject = '';
$message = '';

$sent = false;


if($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $subject = $_POST["subject"];
    $message = $_POST["message"];

    $errors = [];

    if(filter_var($email, FILTER_VALIDATE_EMAIL) === false){
        $errors[] = 'Please enter a valid email';
    }
    if($subject == "") {
        $errors[] = "Please enter a subject";
    }

    if($message == "") {
        $errors[] = "Message cannot be blank";
    }

    if(empty($errors)) {
        $mail = new PHPMailer(true);
        
        try {
            $mail->isSMTP();
            $mail->Host = "smtp.mailtrap.io";
            $mail->SMTPAuth = true;
            $mail->Username = $mailUsername;
            $mail->Password = $mailPassword;
            $mail->SMTPSecure = "tls";
            $mail->Port = 587;
    
            $mail->addAddress("teampawhubsei@gmail.com");
            $mail->addReplyTo($email);
            $mail->Subject = $subject;
            $mail->Body = $message;
            
            $mail->send();
            $sent = true;
        }
        catch (Exception $e) {

        }



    }
}

require 'includes/header.php';

?>

<h2>Contact</h2>

<?php if(! empty($errors)): ?>
    <?php foreach ($errors as $error): ?>
        <li><?= $error ?></li>
    <?php endforeach; ?>
<?php endif; ?>

<?php if($sent): ?>
    <p>Message sent</p>

    <?php else: ?>
<form method="post" id="contact-form">
    <div class="form-group">
        <label for="email" class="form-label">Email</label>
        <input type="email" name="email" id="email" class="form-control" placeholder="example@email.com" value="<?=htmlspecialchars($email) ?>">
    </div>
    <div class="form-group">
        <label for="subject" class="form-label">Subject</label>
        <input name="subject" id="subject" class="form-control" value="<?=htmlspecialchars($subject) ?>">
    </div>
    <div class="form-group">
        <label for="message" class="form-label">Message</label>
        <textarea type="message" name="message" id="message" class="form-control contact-message" ><?= htmlspecialchars($message) ?></textarea>
    </div>
    <button class="btn">Send</button>
</form>

<?php endif; ?>

<?php

require 'includes/footer.php';

?>