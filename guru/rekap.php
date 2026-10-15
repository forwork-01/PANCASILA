<?php require '../includes/fungsi.php'; wajib('guru');
$cari = $_GET['cari'] ?? ''; $sila = $_GET['sila'] ?? ''; $bln = $_GET['bulan'] ?? '';
$sql = "SELECT l.*, u.nama, u.kelas FROM laporan l JOIN users u ON u.id=l.user_id WHERE u.nama LIKE ?"; $p = ["%$cari%"];
if($sila){ $sql .= " AND l.sila=?"; $p[] = $sila; }
if($bln){ $sql .= " AND DATE_FORMAT(l.tanggal,'%Y-%m')=?"; $p[] = $bln; }
$rows = q($sql." ORDER BY l.tanggal DESC, l.id DESC", $p);
awal('Rekap Laporan','rekap'); ?>
<h2>Rekap Laporan Siswa</h2>
<form class="card" style="display:flex;gap:10px;flex-wrap:wrap"><input type="text" name="cari" placeholder="Cari nama siswa" value="<?=e($cari)?>" style="width:220px">
<select name="sila" style="width:150px"><option value="">Semua Sila</option><?php for($i=1;$i<=5;$i++) echo '<option value="'.$i.'"'.($sila==$i?' selected':'').'>Sila '.$i.'</option>'; ?></select>
<input type="month" name="bulan" value="<?=e($bln)?>" style="width:170px"><button class="btn">Filter</button></form>
<div class="card"><table><tr><th>Tanggal</th><th>Siswa</th><th>Kegiatan</th><th>Sila</th><th></th></tr>
<?php foreach($rows as $l) echo '<tr><td>'.tgl($l['tanggal']).'</td><td>'.e($l['nama']).'<br><small>'.e($l['kelas']).'</small></td><td>'.e($l['kegiatan']).'</td><td>Sila '.$l['sila'].'</td><td><a href="../detail.php?id='.$l['id'].'">Detail</a></td></tr>';
if(!$rows) echo '<tr><td colspan="5">Tidak ada data.</td></tr>'; ?></table></div>
<?php akhir();
