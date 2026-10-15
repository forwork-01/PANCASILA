<?php
// Pengaturan koneksi XAMPP default: user root, tanpa password
$db = mysqli_connect('localhost', 'root', '', 'pancasila_aksi')
  or die('Koneksi database gagal: ' . mysqli_connect_error());
mysqli_set_charset($db, 'utf8mb4');
