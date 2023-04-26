<?php 
include("config.php"); 

$pesan_id = $_GET['id'];
$sql = "SELECT * FROM pesan WHERE id = '$pesan_id'";
$result = mysqli_query($db, $sql);
$message = mysqli_fetch_assoc($result);

$recipient_id = $message['id_pejabat'];
$recipient_query = "SELECT nama FROM Pejabat WHERE id = $recipient_id";
$recipient_result = mysqli_query($db, $recipient_query);
$recipient_name = mysqli_fetch_assoc($recipient_result)['nama'];

session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Balas Pesan</title>
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
		<h1>Balas Pesan</h1>
	</header>
    <main>
        <h2>Pesan:</h2>
        <div class='message'>
            <p>From: <?php echo $message['nama']; ?> (<?php echo $message['email']; ?>)</p>
            <p>To: <?php echo $recipient_name; ?></p>
            <p><?php echo $message['pesan']; ?></p>
        </div>
        <h2>Reply:</h2>
        <form method="post" action="tambah-balasan.php">
            <input type="hidden" name="pesan_id" value="<?php echo $message['id']; ?>">
            <input type="hidden" name="pejabat_id" value="<?php echo $recipient_id; ?>">
            <textarea name="balasan" id="balasan"></textarea>
            <input type="submit" name="balas" value="Kirim">
        </form>
    </main>
</body>
</html>