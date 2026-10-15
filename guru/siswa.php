<?php require '../includes/fungsi.php'; wajib('guru'); $m = '';
if(isset($_GET['hapus'])){ q("DELETE FROM users WHERE id=? AND role='siswa'", [(int)$_GET['hapus']]); header('Location: siswa.php'); exit; }
if($_SERVER['REQUEST_METHOD']=='POST'){
  if(q("SELECT id FROM users WHERE username=?", [$_POST['username']])) $m = '<div class="msg err">Username sudah dipakai.</div>';
  else { q("INSERT INTO users(nama,username,password,role,kelas) VALUES(?,?,?,'siswa',?)", [trim($_POST['nama']), trim($_POST['username']), password_hash($_POST['password'], PASSWORD_DEFAULT), trim($_POST['kelas'])]); $m = '<div class="msg ok">Akun siswa ditambahkan.</div>'; } }
$rows = q("SELECT u.*, COUNT(l.id) total, MAX(l.tanggal) terakhir FROM users u LEFT JOIN laporan l ON l.user_id=u.id WHERE u.role='siswa' GROUP BY u.id ORDER BY u.nama");
awal('Portofolio Siswa','siswa'); ?>
<h2>Portofolio Siswa</h2><?=$m?>
<div class="card"><table><tr><th>Nama</th><th>Kelas</th><th>Total Laporan</th><th>Terakhir</th><th></th></tr>
<?php foreach($rows as $s) echo '<tr><td>'.e($s['nama']).'</td><td>'.e($s['kelas']).'</td><td>'.$s['total'].'</td><td>'.($s['terakhir'] ? tgl($s['terakhir']) : '-').'</td><td><a href="rekap.php?cari='.urlencode($s['nama']).'">Laporan</a> · <a href="?hapus='.$s['id'].'" onclick="return confirm(\'Hapus siswa ini beserta laporannya?\')">Hapus</a></td></tr>'; ?></table></div>
<form method="post" class="card"><h3>Tambah Akun Siswa</h3><div class="grid" style="grid-template-columns:1fr 1fr">
<div><label>Nama lengkap</label><input type="text" name="nama" required><label>Kelas</label><input type="text" name="kelas" placeholder="X IPA 1"></div>
<div><label>Username</label><input type="text" name="username" required><label>Password</label><input type="password" name="password" required></div></div>
<p><button class="btn">Tambah Siswa</button></p></form>
<?php akhir();
