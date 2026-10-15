
<?php require 'includes/fungsi.php'; ?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pancasila dalam Aksi</title>
    <link rel="stylesheet" href="<?=BASE?>assets/style.css">
</head>

<body class="landing">

<header class="top">
    <div class="brand">
        <img src="<?=BASE?>assets/logo-ubh.jpg"
             alt="Logo Universitas Bung Hatta"
             class="logo-ubh">

        <div class="brand-text">
            <strong>Universitas Bung Hatta</strong>
            <span>Pancasila dalam Aksi</span>
        </div>
    </div>

    <a class="btn" href="<?=BASE?>login.php">
        Mulai Sekarang
    </a>
</header>

<section class="hero">
    <div class="hero-content">
        <h1>Pancasila<br>dalam Aksi</h1>

        <h3>
            Satu Hari, Satu Kebaikan,
            Lima Nilai Pancasila.
        </h3>

        <p>
            Catat kegiatan baikmu setiap hari dan tunjukkan
            bagaimana kamu menerapkan nilai-nilai Pancasila
            dalam kehidupan sehari-hari.
        </p>

        <a class="btn" href="<?=BASE?>login.php">
            Mulai Lapor Sekarang →
        </a>
    </div>

    <div class="hero-visual">
        <img src="<?=BASE?>assets/logo-pancasila.png"
         alt="Garuda Pancasila"
         class="logo-pancasila">
    </div>
</section>

<main class="main-content">

    <div class="section-title">
        <h2>Lima Sila, Banyak Aksi Nyata</h2>
        <p>
            Kenali simbol Pancasila dan terapkan nilainya
            melalui tindakan sehari-hari.
        </p>
    </div>

    <div class="grid g5">

        <?php foreach ($SILA as $n => $s): ?>

        <div class="card sila sila-<?=$n?>">

            <img
                src="<?=BASE?>assets/sila/sila-<?=$n?>.png"
                alt="Simbol sila <?=$n?>"
                class="simbol-sila"
            >

            <h3>Sila <?=$n?></h3>

            <p><?=$s[0]?></p>

        </div>

        <?php endforeach; ?>

    </div>

</main>

</body>
</html>
