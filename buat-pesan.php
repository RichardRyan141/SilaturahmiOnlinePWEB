<?php 

include("config.php"); 

$sql = "SELECT id, nama FROM pejabat";
$result = mysqli_query($db, $sql);

// Build options for the select element
$options = "";
while ($row = mysqli_fetch_assoc($result)) {
  $options .= "<option value='" . $row["id"] . "'>" . $row["nama"] . "</option>";
}

session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buat Pesan</title>
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
		<h1>Buat pesan untuk pejabat</h1>
	</header>
	<main>
		<form method="post" action="tambah-pesan.php">
            <fieldset>
                <p>
                    <label for="jenis_pesan">Jenis Pesan: </label>
                    <select name="jenis_pesan">
                        <option>Pesan</option>
                        <option>Ucapan Hari Raya</option>
                        <option>Saran</option>
                    </select>
                </p>
                <p>
                    <label for="nama">Nama:</label>
                    <input type="text" name="nama" id="nama" required><br>
                </p>
                <p>
                    <label for="email">Email:</label>
                    <input type="text" name="email" id="email" required><br>
                </p>
                <p>
                    <label for="pejabat">Tujuan:</label>
                    <select name="pejabat_id" id="pejabat_id" required>
                        <?php echo $options; ?>
                    </select>
                </p>
                <p>
                    <label for="pesan">Pesan:</label>
                    <textarea name="pesan" id="pesan"></textarea>
                </p>
                <p>
                    <input type="submit" value="Buat" name="buat" />
                </p>
            </fieldset>
		</form>
	</main>

</body>
</html>