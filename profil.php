<?php require 'includes/fungsi.php'; wajib(); $u = $_SESSION['u']; $m = '';
if($_SERVER['REQUEST_METHOD']=='POST'){
  $r = q("SELECT password FROM users WHERE id=?", [$u['id']])[0];
  if(!password_verify($_POST['lama'], $r['password'])) $m = '<div class="msg err">Password lama salah.</div>';
  elseif(strlen($_POST['baru']) < 6) $m = '<div class="msg err">Password baru minimal 6 karakter.</div>';
  else { q("UPDATE users SET password=? WHERE id=?", [password_hash($_POST['baru'], PASSWORD_DEFAULT), $u['id']]); $m = '<div class="msg ok">Password berhasil diubah.</div>'; }
}
awal('Profil','profil'); ?>
<h2>Profil</h2><?=$m?>
<div class="card"><p><b>Nama:</b> <?=e($u['nama'])?><br><b>Username:</b> <?=e($u['username'])?><br><b>Peran:</b> <?=e($u['role'])?><br><b>Kelas:</b> <?=e($u['kelas'] ?: '-')?></p></div>
<form method="post" class="card"><h3>Ganti Password</h3><label>Password lama</label><input type="password" name="lama" required><label>Password baru</label><input type="password" name="baru" required><p><button class="btn">Simpan</button></p></form>
<?php akhir();
