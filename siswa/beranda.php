<?php ini_set('display_errors', 1); error_reporting(E_ALL); 
require '../includes/fungsi.php'; wajib('siswa');
$u  = $_SESSION['u']; $id = $u['id'];
$urut = [1=>'Pertama', 2=>'Kedua', 3=>'Ketiga', 4=>'Keempat', 5=>'Kelima'];
$SILA = [
    1 => ['Ketuhanan Yang Maha Esa', '#3a86ff'],
    2 => ['Kemanusiaan Yang Adil dan Beradab', '#ffb703'],
    3 => ['Persatuan Indonesia', '#7ac74f'],
    4 => ['Kerakyatan Yang Dipimpin oleh Hikmat Kebijaksanaan', '#ff7b54'],
    5 => ['Keadilan Sosial bagi Seluruh Rakyat Indonesia', '#8d6efc'],
];

// Statistik
$total = q("SELECT COUNT(*) c FROM laporan WHERE user_id=?", [$id])[0]['c'];
$per   = array_column(q("SELECT sila, COUNT(*) c FROM laporan WHERE user_id=? GROUP BY sila", [$id]), 'c', 'sila');
$topSila = $per ? array_search(max($per), $per) : null;

// Streak harian
$streak = 0; $cek = date('Y-m-d');
$tgls = array_column(q("SELECT DISTINCT tanggal FROM laporan WHERE user_id=? ORDER BY tanggal DESC", [$id]), 'tanggal');
if($tgls && $tgls[0] != $cek) $cek = date('Y-m-d', strtotime('-1 day'));
foreach($tgls as $t){ if($t == $cek){ $streak++; $cek = date('Y-m-d', strtotime($cek.' -1 day')); } else break; }

$sudah = q("SELECT id FROM laporan WHERE user_id=? AND tanggal=? LIMIT 1", [$id, date('Y-m-d')]);
$last  = q("SELECT * FROM laporan WHERE user_id=? ORDER BY tanggal DESC, id DESC LIMIT 5", [$id]);
$nama  = explode(' ', trim($u['nama']))[0];
$maks  = $per ? max($per) : 1;

awal('Beranda','beranda'); ?>

<!-- Banner sapaan -->
<section class="sapa">
    <div>
        <h2>Halo, <?=e($nama)?> 👋</h2>
        <p>Kebaikan kecil hari ini, dampak besar untuk masa depan.</p>
        <?php if($sudah): ?>
            <span class="status ok-s">✅ Kamu sudah melapor hari ini</span>
        <?php else: ?>
            <span class="status warn-s">⏳ Kamu belum melapor hari ini</span>
        <?php endif; ?>
        <p><a class="btn" href="lapor.php">+ Buat Laporan Baru</a></p>
    </div>
    <img src="<?=BASE?>assets/logo-pancasila.png" alt="Garuda Pancasila" class="sapa-logo">
</section>

<!-- Kartu statistik -->
<div class="grid g3">
    <div class="card stat-box">
        <span class="stat-ico" style="background:#e3edff">📝</span>
        <div><small>Total Laporan</small><b><?=$total?> laporan</b></div>
    </div>
    <div class="card stat-box">
        <?php if($topSila): ?>
            <img src="<?=BASE?>assets/sila/sila-<?=$topSila?>.png" alt="" class="stat-img">
            <div><small>Sila Terbanyak</small><b>Sila <?=$topSila?> (<?=$per[$topSila]?> kali)</b></div>
        <?php else: ?>
            <span class="stat-ico" style="background:#f1f3f8">⭐</span>
            <div><small>Sila Terbanyak</small><b>-</b></div>
        <?php endif; ?>
    </div>
    <div class="card stat-box">
        <span class="stat-ico" style="background:#fff1de">🔥</span>
        <div><small>Streak Harian</small><b><?=$streak?> hari</b></div>
    </div>
</div>

<!-- Rekap per sila -->
<div class="card">
    <h3>Rekap Sila Saya</h3>
    <div class="grid g5 rekap">
        <?php foreach($SILA as $n=>$s): $c = $per[$n] ?? 0; ?>
        <div class="rekap-item">
            <img src="<?=BASE?>assets/sila/sila-<?=$n?>.png" alt="Sila <?=$n?>">
            <strong>Sila <?=$urut[$n]?></strong>
            <span class="bar"><i style="width:<?=round($c*100/$maks)?>%;background:<?=$s[1]?>"></i></span>
            <small><?=$c?> kali</small>
        </div>
        <?php endforeach; ?>
    </div>
</div>

<!-- Laporan terbaru -->
<div class="card">
    <div class="card-head">
        <h3>Laporan Terbaru</h3>
        <a href="riwayat.php">Lihat semua →</a>
    </div>
    <div class="tbl-wrap">
    <table>
        <tr><th>Tanggal</th><th>Kegiatan</th><th>Sila</th><th>Status</th><th></th></tr>
        <?php foreach($last as $l): ?>
        <tr>
            <td><?=tgl($l['tanggal'])?></td>
            <td><?=e($l['kegiatan'])?></td>
            <td><span class="pill" style="--c:<?=$SILA[$l['sila']][1]?>">Sila <?=$l['sila']?></span></td>
            <td><span class="badge">Terkirim</span></td>
            <td><a href="../detail.php?id=<?=$l['id']?>">Detail</a></td>
        </tr>
        <?php endforeach; ?>
        <?php if(!$last): ?>
        <tr><td colspan="5" style="text-align:center;padding:24px;color:var(--mut)">
            Belum ada laporan. Yuk mulai dengan satu kebaikan hari ini! 🌱</td></tr>
        <?php endif; ?>
    </table>
    </div>
</div>

<?php akhir();