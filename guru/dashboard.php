<?php require '../includes/fungsi.php'; wajib('guru');
$ts = q("SELECT COUNT(*) c FROM users WHERE role='siswa'")[0]['c'];
$sm = q("SELECT COUNT(DISTINCT user_id) c FROM laporan WHERE tanggal=CURDATE()")[0]['c'];
$bm = $ts - $sm; $pct = $ts ? round($sm*100/$ts) : 0;
$per = array_column(q("SELECT sila, COUNT(*) c FROM laporan GROUP BY sila"), 'c', 'sila');
$tot = array_sum($per) ?: 1;
$pd = q("SELECT u.nama, MAX(l.tanggal) terakhir FROM users u LEFT JOIN laporan l ON l.user_id=u.id WHERE u.role='siswa' GROUP BY u.id HAVING terakhir IS NULL OR terakhir < CURDATE() - INTERVAL 1 DAY LIMIT 5");
awal('Dashboard Guru','beranda'); ?>
<h2>Dashboard Guru</h2><p>Pantau perkembangan penerapan nilai Pancasila oleh siswa.</p>
<div class="grid g3"><div class="card stat"><small>Total Siswa</small><b><?=$ts?></b></div>
<div class="card stat"><small>Sudah Melapor Hari Ini</small><b><?=$sm?> (<?=$pct?>%)</b></div>
<div class="card stat"><small>Belum Melapor</small><b><?=$bm?> (<?=100-$pct?>%)</b></div></div>
<div class="grid g2"><div class="card"><h3>Rekap per Sila</h3><div class="bars">
<?php foreach($SILA as $n=>$s){ $p = round(($per[$n] ?? 0)*100/$tot); echo '<div>'.$p.'%<span style="height:'.max(4,$p*2.4).'px;background:'.$s[1].'"></span>Sila '.$n.'</div>'; } ?></div></div>
<div class="card"><h3>Persentase Laporan</h3><div class="donut" style="background:conic-gradient(#2e9b57 0 <?=$pct?>%,#dbe4f5 0)"><b><?=$pct?>%</b></div><p style="text-align:center">🟢 Sudah melapor · ⚪ Belum</p></div></div>
<div class="grid g2"><div class="card"><h3>Siswa yang Perlu Pendampingan</h3><table><tr><th>Nama</th><th>Catatan</th></tr>
<?php foreach($pd as $s) echo '<tr><td>'.e($s['nama']).'</td><td>'.($s['terakhir'] ? 'Terakhir melapor '.tgl($s['terakhir']) : 'Belum pernah melapor').'</td></tr>';
if(!$pd) echo '<tr><td colspan="2">Semua siswa aktif 🎉</td></tr>'; ?></table></div>
<div class="card"><h3>Pesan Hari Ini</h3><p>"Pancasila bukan hanya dihafalkan, tetapi diamalkan dalam tindakan nyata."</p></div></div>
<?php akhir();
