<?php 

// Starts or resumes a session in the browser
session_start();

include 'includes/url.php';

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    if($_POST['username'] == 'mike' && $_POST['password'] == 'secret') {
        session_regenerate_id(true);
        $_SESSION['is_logged_in'] = true;
        redirect('/mikedoesphp/index.php');
    } else {
        $error = 'Invalid login';
    }
}

include 'includes/header.php';

?>

<h2>Login</h2>
<?php if(!empty($error)): ?>
    <?= $error ?>
<?php endif; ?>
<form method='post'>
    <label for='username'>Username</label>
    <input type='text' id='username' name='username'>

    <label for='password'>Password</label>
    <input type='password' id='password' name='password'>

    <button>Login</button>
</form>

<?php require 'includes/footer.php'; ?>

