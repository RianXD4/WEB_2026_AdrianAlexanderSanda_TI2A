<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$sudahLogin = isset($_SESSION['user_id']);

$__jobsheetRoot = dirname(__DIR__);
$__scriptDir = dirname($_SERVER['SCRIPT_FILENAME']);
$__rel = ltrim(str_replace('\\', '/', substr($__scriptDir, strlen($__jobsheetRoot))), '/');
$base = $__rel === '' ? '' : str_repeat('../', substr_count($__rel, '/') + 1);
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIMPUS-mini</title>
    <link rel="stylesheet" href="<?php echo $base; ?>assets/css/style.css?v=4">
</head>

<body>
    <header>
        <h1>SIMPUS-mini</h1>
        <nav>
            <ul>
                <li><a href="<?php echo $base; ?>index.php">Beranda</a></li>
                <?php if ($sudahLogin): ?>
                    <li><a href="<?php echo $base; ?>buku/list.php">Daftar Buku</a></li>
                    <li><a href="<?php echo $base; ?>buku/tambah.php">Tambah Buku</a></li>
                    <li><a href="<?php echo $base; ?>anggota/list.php">Daftar Anggota</a></li>
                    <li><a href="<?php echo $base; ?>anggota/tambah.php">Tambah Anggota</a></li>
                <?php endif; ?>
            </ul>
        </nav>
        <div class="auth-status">
            <?php if ($sudahLogin): ?>
                <span><?php echo $_SESSION['nama']; ?></span>
                <a href="<?php echo $base; ?>auth/logout.php">Logout</a>
            <?php else: ?>
                <a href="<?php echo $base; ?>auth/login.php">Login</a>
            <?php endif; ?>
        </div>
    </header>
    <main>