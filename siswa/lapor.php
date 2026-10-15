<?php require '../includes/fungsi.php'; wajib('siswa'); $u = $_SESSION['u']; $err = '';
$SILA = [
  1 => ['Ketuhanan Yang Maha Esa', '#6c63ff'],
  2 => ['Kemanusiaan yang Adil dan Beradab', '#f59e0b'],
  3 => ['Persatuan Indonesia', '#10b981'],
  4 => ['Kerakyatan yang Dipimpin oleh Hikmat Kebijaksanaan dalam Permusyawaratan/Perwakilan', '#3b82f6'],
  5 => ['Keadilan Sosial bagi Seluruh Rakyat Indonesia', '#ef4444'],
];
if($_SERVER['REQUEST_METHOD']=='POST'){
  $foto = null;
  if(!empty($_FILES['foto']['name'])){
    $ext = strtolower(pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION));
    if(!in_array($ext, ['jpg','jpeg','png'])) $err = 'Foto harus berformat JPG/PNG.';
    elseif($_FILES['foto']['size'] > 2*1024*1024) $err = 'Ukuran foto maksimal 2 MB.';
    else { $foto = uniqid('f_').'.'.$ext; move_uploaded_file($_FILES['foto']['tmp_name'], '../uploads/'.$foto); }
  }
  if(!$err){
    q("INSERT INTO laporan(user_id,tanggal,kegiatan,sila,pengalaman,perasaan,foto) VALUES(?,?,?,?,?,?,?)",
      [$u['id'], date('Y-m-d'), trim($_POST['kegiatan']), (int)$_POST['sila'], trim($_POST['pengalaman']), trim($_POST['perasaan']), $foto]);
    header('Location: riwayat.php?sukses=1'); exit; }
}
awal('Lapor Kegiatan','lapor'); ?>
<h2>Lapor Kegiatan Harian</h2><p>Yuk, ceritakan kegiatan baik yang sudah kamu lakukan hari ini!</p>
<?php if($err) echo '<div class="msg err">'.$err.'</div>'; ?>
<form method="post" enctype="multipart/form-data" class="card">
<label>Tanggal</label><input type="text" value="<?=tgl(date('Y-m-d'))?>" disabled>
<label>Kegiatan yang kamu lakukan</label><textarea name="kegiatan" placeholder="Contoh: Membantu teman yang kesulitan belajar" required></textarea>
<label>Pilih Sila Pancasila yang sesuai</label><div class="grid g5">
<?php foreach($SILA as $n=>$s) echo '<label class="sila" style="margin:0"><input type="radio" name="sila" value="'.$n.'" required><span style="--c:'.$s[1].'"><i>'.$n.'</i>Sila '.$n.'<small>'.$s[0].'</small></span></label>'; ?></div>
<label>Ceritakan pengalamanmu</label><textarea name="pengalaman" placeholder="Tulis pengalamanmu di sini..."></textarea>
<label>Apa yang kamu rasakan setelah melakukannya?</label><textarea name="perasaan" placeholder="Tuliskan perasaanmu di sini..."></textarea>
<label>Bukti kegiatan (opsional)</label><input type="file" name="foto" accept=".jpg,.jpeg,.png"><small>JPG/PNG, maks 2 MB</small>
<p><button class="btn">Kirim Laporan</button></p></form>
<?php akhir();
?>