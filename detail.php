<?php require 'includes/fungsi.php'; wajib(); $u = $_SESSION['u'];
$r = q("SELECT l.*, s.nama, s.kelas FROM laporan l JOIN users s ON s.id=l.user_id WHERE l.id=?", [(int)($_GET['id'] ?? 0)]);
if(!$r || ($u['role']=='siswa' && $r[0]['user_id'] != $u['id'])) die('Laporan tidak ditemukan.');
$l = $r[0]; awal('Detail Laporan', $u['role']=='siswa' ? 'riwayat' : 'rekap'); ?>
<a class="noprint" href="javascript:history.back()">← Kembali</a>
<div class="card" style="margin-top:12px"><div style="display:flex;justify-content:space-between"><h2>Detail Laporan Kegiatan</h2><span class="badge">Terkirim</span></div>
<p><b><?=e($l['nama'])?></b><br><small>Kelas <?=e($l['kelas'])?></small></p>
<table><tr><td><b>Tanggal</b><br><?=tgl($l['tanggal'])?></td><td><b>Sila Pancasila</b><br>Sila <?=$l['sila']?> (<?=e($SILA[$l['sila']][0])?>)</td></tr></table>
<label>Kegiatan yang Dilakukan</label><p><?=nl2br(e($l['kegiatan']))?></p>
<label>Pengalaman</label><p><?=nl2br(e($l['pengalaman']))?></p>
<label>Refleksi</label><p><?=nl2br(e($l['perasaan']))?></p>
<?php if($l['foto']) echo '<label>Bukti Kegiatan</label><img src="'.BASE.'uploads/'.e($l['foto']).'" style="max-width:320px;border-radius:8px">'; ?>
<p class="noprint"><button class="btn o" onclick="window.print()">Download PDF (Cetak)</button></p></div>
<?php akhir();
