<?php
session_start();
require __DIR__ . '/../config/koneksi.php';
define('BASE', '/pancasila_aksi/');   // sesuaikan dengan nama folder di htdocs

function data_sila(){
  return [
   1=>['Ketuhanan Yang Maha Esa','#e53935'],
   2=>['Kemanusiaan yang Adil dan Beradab','#f5a623'],
   3=>['Persatuan Indonesia','#2e9b57'],
   4=>['Kerakyatan yang Dipimpin oleh Hikmat Kebijaksanaan dalam Permusyawaratan/Perwakilan','#8e5bc7'],
   5=>['Keadilan Sosial bagi Seluruh Rakyat Indonesia','#3f5bd8']];
}
$SILA = data_sila();
function e($s){ return htmlspecialchars($s ?? '', ENT_QUOTES, 'UTF-8'); }

// Query prepared statement: SELECT -> array, INSERT/UPDATE/DELETE -> true
function q($sql, $p = []){
  global $db; $s = mysqli_prepare($db, $sql);
  if($p) mysqli_stmt_bind_param($s, str_repeat('s', count($p)), ...$p);
  mysqli_stmt_execute($s); $r = mysqli_stmt_get_result($s);
  return $r === false ? true : mysqli_fetch_all($r, MYSQLI_ASSOC);
}

function tgl($d){
  $b=['','Jan','Feb','Mar','Apr','Mei','Jun','Jul','Agu','Sep','Okt','Nov','Des']; $t=strtotime($d);
  return date('j',$t).' '.$b[(int)date('n',$t)].' '.date('Y',$t);
}

function wajib($role = null){
  if(empty($_SESSION['u']) || ($role && $_SESSION['u']['role'] !== $role)){
    header('Location: '.BASE.'login.php'); exit;
  }
}

// Gambar simbol sila (assets/sila/sila-1.png ... sila-5.png)
function sila_img($n, $kelas = 'simbol-sila'){
  return '<img src="'.BASE.'assets/sila/sila-'.(int)$n.'.png" alt="Sila '.(int)$n.'" class="'.$kelas.'">';
}

// Awal halaman dalam (header + menu samping)
function awal($judul, $aktif){
  $u = $_SESSION['u'];
  $m = $u['role']=='siswa'
   ? ['beranda'=>['🏠','Beranda','siswa/beranda.php'],
      'lapor'=>['📝','Lapor Kegiatan','siswa/lapor.php'],
      'riwayat'=>['📚','Riwayat Laporan','siswa/riwayat.php'],
      'refleksi'=>['💡','Refleksi','siswa/refleksi.php'],
      'profil'=>['👤','Profil','profil.php']]
   : ['beranda'=>['🏠','Beranda','guru/dashboard.php'],
      'rekap'=>['📊','Rekap Laporan','guru/rekap.php'],
      'siswa'=>['🎓','Portofolio Siswa','guru/siswa.php'],
      'profil'=>['👤','Profil','profil.php']];
  $inisial = strtoupper(mb_substr($u['nama'], 0, 1));
  $peran   = $u['role']=='guru' ? 'Guru' : 'Siswa'.($u['kelas'] ? ' · '.$u['kelas'] : '');

  echo '<!DOCTYPE html><html lang="id"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1"><title>'.e($judul).' - Pancasila dalam Aksi</title><link rel="stylesheet" href="'.BASE.'assets/style.css"></head><body>';

  // Header
  echo '<header class="top"><a class="brand" href="'.BASE.'">'
     . '<img src="'.BASE.'assets/logo-ubh.jpg" class="logo-ubh" alt="Universitas Bung Hatta">'
     . '<span class="divider"></span>'
     . '<img src="'.BASE.'assets/logo-pancasila.png" class="logo-mini" alt="Garuda Pancasila">'
     . '<strong class="app-name">Pancasila dalam Aksi</strong></a>'
     . '<div class="who"><span class="avatar">'.e($inisial).'</span>'
     . '<span class="who-teks"><b>'.e($u['nama']).'</b><small>'.e($peran).'</small></span>'
     . '<a class="keluar" href="'.BASE.'logout.php">Keluar</a></div></header>';

  // Menu samping
  echo '<div class="wrap"><nav class="side">';
  foreach($m as $k=>$v){
    echo '<a class="'.($k==$aktif?'on':'').'" href="'.BASE.$v[2].'"><span class="mi">'.$v[0].'</span>'.$v[1].'</a>';
  }
  echo '</nav><main>';
}

function akhir(){ echo '</main></div></body></html>'; }