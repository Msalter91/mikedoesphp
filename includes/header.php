<!DOCTYPE html>
<html>
<head>
    <title>My blog</title>
    <meta charset="utf-8">
</head>
<body>

    <header>
        <h1>My blog</h1>
    </header>
    <nav>
        <ul>
            <?php if (Auth::isLoggedIn()): ?>
                <li>
                    <a href="/mikedoesphp/">Home</a>
                </li>
                <li>
                    <a href="/mikedoesphp/admin/index.php">Administration</a>
                </li>
                <li>
                    <a href="/mikedoesphp/logout.php">Logout</a>
                </li>
            <?php else: ?> 
                <li>
                    <a href="/mikedoesphp/login.php">Login</a>
                </li>
            <?php endif; ?>
        </ul>
    </nav>
    <main>