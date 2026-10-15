<?php require 'includes/fungsi.php';

// Jika sudah login, langsung arahkan ke dashboard
if(!empty($_SESSION['u'])){
  header('Location: '.BASE.($_SESSION['u']['role']=='guru' ? 'guru/dashboard.php' : 'siswa/beranda.php')); exit;
}

$err = '';
$role = $_POST['role'] ?? 'siswa';
$username = trim($_POST['username'] ?? '');

if($_SERVER['REQUEST_METHOD']=='POST'){
  $p = $_POST['password'] ?? '';
  $u = q("SELECT * FROM users WHERE username=? AND role=?", [$username, $role]);
  if($u){
    $u = $u[0];
    $ok = password_verify($p, $u['password']);
    // Password awal berupa teks biasa -> otomatis di-hash saat login pertama
    if(!$ok && hash_equals($u['password'], $p)){
      $ok = true;
      q("UPDATE users SET password=? WHERE id=?", [password_hash($p, PASSWORD_DEFAULT), $u['id']]);
    }
    if($ok){
      unset($u['password']);
      $_SESSION['u'] = $u;
      header('Location: '.BASE.($u['role']=='guru' ? 'guru/dashboard.php' : 'siswa/beranda.php')); exit;
    }
  }
  $err = 'Username, password, atau peran salah.';
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login - Pancasila dalam Aksi</title>
    <link rel="stylesheet" href="<?=BASE?>assets/style.css">
</head>
<body class="login">

<div class="login-box">

    <div class="login-head">
        <img src="<?=BASE?>assets/logo-pancasila.png" alt="Garuda Pancasila" class="login-logo">
        <h1>Pancasila dalam Aksi</h1>
        <p>Jurnal Harian Nilai-Nilai Pancasila</p>
    </div>

    <form method="post" class="card login-card" autocomplete="off">
        <h2>Login</h2>

        <?php if($err): ?>
            <div class="msg err"><?=e($err)?></div>
        <?php endif; ?>

        <label for="username">Username</label>
        <input type="text" id="username" name="username" value="<?=e($username)?>"
               placeholder="Masukkan username" required autofocus>

        <label for="password">Password</label>
        <div class="pw">
            <input type="password" id="password" name="password"
                   placeholder="Masukkan password" required>
            <button type="button" class="pw-toggle" onclick="togglePw()" aria-label="Tampilkan password">👁</button>
        </div>

        <label>Pilih Peran</label>
        <div class="peran">
            <label>
                <input type="radio" name="role" value="siswa" <?=$role=='siswa'?'checked':''?>>
                <span>👦 Siswa</span>
            </label>
            <label>
                <input type="radio" name="role" value="guru" <?=$role=='guru'?'checked':''?>>
                <span>👩‍🏫 Guru</span>
            </label>
        </div>

        <button class="btn login-btn">Masuk</button>

        <p class="login-note">Belum punya akun? Hubungi guru di sekolahmu.</p>
    </form>

    <p class="login-back"><a href="<?=BASE?>">← Kembali ke beranda</a></p>
</div>

<script>
function togglePw(){
  var i = document.getElementById('password');
  i.type = i.type === 'password' ? 'text' : 'password';
}
</script>
</body>
</html>