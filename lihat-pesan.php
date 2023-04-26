<?php 
include("config.php"); 

$sql = "SELECT * FROM pesan";
$result = mysqli_query($db, $sql);
$messages = array();
if (mysqli_num_rows($result) > 0) {
	while ($row = mysqli_fetch_assoc($result)) {
		// Retrieve replies for each message
		$sql_replies = "SELECT * FROM reply WHERE id_pesan = {$row['id']}";
		$result_replies = mysqli_query($db, $sql_replies);
		$replies = array();
		if (mysqli_num_rows($result_replies) > 0) {
			while ($row_reply = mysqli_fetch_assoc($result_replies)) {
				$replies[] = $row_reply;
			}
		}

		$row['reply'] = $replies;
		$messages[] = $row;
	}
}

session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lihat Pesan</title>
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
		<h1>Daftar Pesan</h1>
	</header>
    <main>
        <?php
            // Display messages and their replies
            foreach ($messages as $message) {
                $recipient_id = $message['id_pejabat'];
                $recipient_query = "SELECT nama FROM Pejabat WHERE id = $recipient_id";
                $recipient_result = mysqli_query($db, $recipient_query);
                $recipient_name = mysqli_fetch_assoc($recipient_result)['nama'];

                echo "<div class='message'>";
                echo "<p>From: {$message['nama']} ({$message['email']})</p>";
                echo "<p>To: {$recipient_name}</p>";
                echo "<p>{$message['pesan']}</p>";
                echo "<p>Balasan:</p>";
                echo "<ul>";
                foreach ($message['reply'] as $reply) {
                    echo "<li>{$reply['balasan']}</li>";
                }
                echo "</ul>";
                echo "</div>";
            }
        ?>
	</main>
</body>
</html>