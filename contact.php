<?php 

require 'includes/init.php';

$email = '';
$subject = '';
$message = '';


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
}

require 'includes/header.php';

?>

<h2>Contact</h2>

<?php if(! empty($errors)): ?>
    <?php foreach ($errors as $error): ?>
        <li><?= $error ?></li>
    <?php endforeach; ?>
<?php endif; ?>

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

<?php

require 'includes/footer.php';

?>