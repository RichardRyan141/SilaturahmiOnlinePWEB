<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <nav>
        <?php if($_SESSION['login_user'] != ""): ?>
            <span class="user">Welcome, <?php echo $_SESSION['login_user']; ?></span>
        <?php endif; ?>
        <ul>
            <li><a href="buat-pesan.php">Buat Pesan</a></li>
            <li><a href="lihat-pesan.php">Lihat Pesan</a></li>
            <?php if(isset($_SESSION['login_user']) && !empty($_SESSION['login_user'])): ?>
            <li><a href="logout.php">Logout</a></li>
            <?php else: ?>
            <li><a href="login.php">Login</a></li>
            <?php endif; ?>
        </ul>
    </nav>
    <header>
		<h1>Halaman Login</h1>
	</header>
	<main>
		<form method="post" action="authenticate.php">
            <fieldset>
                <p>
                    <label for="username">Username:</label>
                    <input type="text" name="username" id="username" required><br>
                </p>
                <p>
                    <label for="password">Password:</label>
                    <input type="password" name="password" id="password" required><br>
                </p>
                <p>
                    <input type="submit" value="Login" name="login" />
                </p>
            </fieldset>
		</form>
	</main>
</body>
</html>
