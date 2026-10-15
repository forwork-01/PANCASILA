<?php require '../includes/fungsi.php'; wajib('siswa'); $id = $_SESSION['u']['id'];
$bln = $_GET['bulan'] ?? date('Y-m');
$rows = q("SELECT * FROM laporan WHERE user_id=? AND DATE_FORMAT(tanggal,'%Y-%m')=? ORDER BY tanggal DESC, id DESC", [$id, $bln]);
awal('Riwayat Laporan','riwayat'); ?>
<h2>Riwayat Laporan Saya</h2>
<?php if(isset($_GET['sukses'])) echo '<div class="msg ok">Laporan berhasil dikirim. Terima kasih!</div>'; ?>
<form class="card" style="display:flex;gap:10px;align-items:center">Bulan: <input type="month" name="bulan" value="<?=e($bln)?>" style="width:auto"><button class="btn">Tampilkan</button></form>
<div class="card"><table><tr><th>Tanggal</th><th>Kegiatan</th><th>Sila</th><th>Status</th><th></th></tr>
<?php foreach($rows as $l) echo '<tr><td>'.tgl($l['tanggal']).'</td><td>'.e($l['kegiatan']).'</td><td>Sila '.$l['sila'].'</td><td><span class="badge">Terkirim</span></td><td><a href="../detail.php?id='.$l['id'].'">Detail</a></td></tr>';
if(!$rows) echo '<tr><td colspan="5">Belum ada laporan pada bulan ini.</td></tr>'; ?></table></div>
<?php akhir();
