<?php require '../includes/fungsi.php'; wajib('siswa');
$rows = q("SELECT * FROM laporan WHERE user_id=? AND (perasaan<>'' OR pengalaman<>'') ORDER BY tanggal DESC", [$_SESSION['u']['id']]);
awal('Refleksi','refleksi'); ?>
<h2>Refleksi Saya</h2><p>Kumpulan perasaan dan pelajaran dari kebaikan yang kamu lakukan.</p>
<?php foreach($rows as $l): ?><div class="card" style="border-left:6px solid <?=$SILA[$l['sila']][1]?>"><small><?=tgl($l['tanggal'])?> · Sila <?=$l['sila']?></small>
<p><b><?=e($l['kegiatan'])?></b></p><p>💬 <?=e($l['pengalaman'])?></p><p>💡 <?=e($l['perasaan'])?></p></div><?php endforeach;
if(!$rows) echo '<div class="card">Belum ada refleksi.</div>'; akhir();
