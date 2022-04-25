<?php 

require 'includes/init.php';

if($_SERVER['REQUEST_METHOD'] == 'POST') {

    $conn = require 'includes/db.php';

    if( User::authenticate($conn, $_POST['username'], $_POST['password'])) {
        Auth::login();
        Url::redirect('/mikedoesphp/index.php');
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

