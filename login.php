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
    <div class="form-group">
        <label for='username'>Username</label>
        <input type='text' id='username' name='username' class="form-control">
    </div>
    <div class="form-group">
        <label for='password'>Password</label>
        <input type='password' id='password' name='password' class="form-control">
    </div>
    <button class="btn">Login</button>
</form>

<?php require 'includes/footer.php'; ?>

