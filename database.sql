CREATE DATABASE IF NOT EXISTS pancasila_aksi CHARACTER SET utf8mb4;
USE pancasila_aksi;
DROP TABLE IF EXISTS laporan; DROP TABLE IF EXISTS users;
CREATE TABLE users(
 id INT AUTO_INCREMENT PRIMARY KEY, nama VARCHAR(100) NOT NULL,
 username VARCHAR(50) NOT NULL UNIQUE, password VARCHAR(255) NOT NULL,
 role ENUM('siswa','guru') NOT NULL, kelas VARCHAR(30) NULL,
 created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP);
CREATE TABLE laporan(
 id INT AUTO_INCREMENT PRIMARY KEY, user_id INT NOT NULL, tanggal DATE NOT NULL,
 kegiatan TEXT NOT NULL, sila TINYINT NOT NULL, pengalaman TEXT, perasaan TEXT, foto VARCHAR(255) NULL,
 created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
 FOREIGN KEY(user_id) REFERENCES users(id) ON DELETE CASCADE);
-- password awal (teks biasa) otomatis di-hash saat login pertama
INSERT INTO users(nama,username,password,role,kelas) VALUES
('Ibu Rina, S.Pd','guru','guru123','guru',NULL),
('Intan Purnama Sari','intan','siswa123','siswa','X IPA 1'),
('Budi Santoso','budi','siswa123','siswa','X IPA 1'),
('Siti Aisyah','siti','siswa123','siswa','X IPA 1');
INSERT INTO laporan(user_id,tanggal,kegiatan,sila,pengalaman,perasaan) VALUES
(2,CURDATE(),'Membantu teman membersihkan kelas setelah kegiatan belajar',3,'Saya merasa senang karena bisa bekerja sama dengan teman-teman.','Saya belajar bahwa gotong royong membuat pekerjaan yang berat menjadi lebih ringan.'),
(2,CURDATE()-INTERVAL 1 DAY,'Membuang sampah pada tempatnya',3,'Lingkungan sekolah jadi lebih bersih.','Bangga bisa memberi contoh.'),
(2,CURDATE()-INTERVAL 2 DAY,'Menghormati teman yang berbeda agama',1,'Saling menghargai saat jam ibadah.','Tenang dan damai.'),
(2,CURDATE()-INTERVAL 3 DAY,'Musyawarah dalam kelompok',4,'Semua anggota bisa bicara.','Lega karena keputusan adil.'),
(2,CURDATE()-INTERVAL 4 DAY,'Membantu orang tua di rumah',5,'Ibu terlihat senang.','Hangat di hati.'),
(3,CURDATE()-INTERVAL 3 DAY,'Menolong teman yang kesulitan',2,'Teman berterima kasih.','Senang bisa berguna.');
