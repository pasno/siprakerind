-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 01 Jan 2019 pada 18.09
-- Versi Server: 5.6.20
-- PHP Version: 5.5.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `db_prakerin`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `du_di`
--

CREATE TABLE IF NOT EXISTS `du_di` (
  `id_du_di` varchar(20) NOT NULL DEFAULT '',
  `nama_du_di` varchar(30) NOT NULL,
  `bidang_usaha` varchar(50) NOT NULL,
  `nama_pimpinan` varchar(25) NOT NULL,
  `nama_pembimbing` varchar(25) NOT NULL,
  `alamat` varchar(80) NOT NULL,
  `foto` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `du_di`
--

INSERT INTO `du_di` (`id_du_di`, `nama_du_di`, `bidang_usaha`, `nama_pimpinan`, `nama_pembimbing`, `alamat`, `foto`) VALUES
('Abadi_001', 'ABADI JAYA COMPUTER', 'Service, Marketing', 'Fulan', 'Fulan', 'Jl. Kusuma Bangsa 116', '../../gambar/foto/Abadi_001.'),
('astra_001', 'ASTRA JAYA', 'Service, Marketing', 'Fulan', 'Fulan', 'Tambak Wedi, Surabya', '../../gambar/foto/astra_001.'),
('Aulia_001', 'AULIA COMPUTER', 'Service, Marketing', 'Fulan', 'Fulan', 'Perum Griya Abadi Bangkalan', '../../gambar/foto/Aulia_001.'),
('demo_001', 'DEMO MOTOR SURABAYA', 'Service, Marketing', 'Fulan', 'Fulan', 'Surabaya', '../../gambar/foto/demo_001.'),
('dr_motor_001', 'DR MOTOR', 'Service', 'Fulan', 'Fulan', 'Jl. Jarak no. 75, Surabaya', '../../gambar/foto/dr_motor_001.'),
('hikari_001', 'HIKARI', 'Design, Advertising', 'Fulan', 'Fulan', 'Jl. KH. Moh. Toha, Bangkalan', '../../gambar/foto/hikari_001.'),
('loka_001', 'LOKA JAYA MOTOR', 'Service', 'Fulan', 'Fulan', 'Bancaran-Bangkalan', '../../gambar/foto/loka_001.'),
('suzukimotortelang', 'Suzuki Motor Telang', 'Service Motor', 'Pas', '', 'Jl. Telang, Kamal', ''),
('telcomtecsurabaya', 'Telcomtec Surabaya', 'IT, Service', 'Anton', '', 'Ngangel, Surabaya', ''),
('wahyu_001', 'WAHYU MOTOR', 'Service', 'Fulan', 'Fulan', 'Tanah Merah, Bangkalan', '../../gambar/foto/wahyu_001.'),
('win_001', 'WIN COMPUTER', 'Service, Marketing', 'Fulan', 'Fulan', 'Jl. Kusuma Bangsa 116-118, Surabaya', '../../gambar/foto/win_001.');

-- --------------------------------------------------------

--
-- Struktur dari tabel `guru`
--

CREATE TABLE IF NOT EXISTS `guru` (
  `id_guru` varchar(20) NOT NULL DEFAULT '',
  `nama_guru` varchar(45) NOT NULL,
  `tempat_lahir` varchar(30) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `jk_guru` enum('Laki-Laki','Perempuan') NOT NULL,
  `alamat_guru` varchar(50) NOT NULL,
  `status_jabatan` varchar(25) NOT NULL,
  `foto` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `guru`
--

INSERT INTO `guru` (`id_guru`, `nama_guru`, `tempat_lahir`, `tanggal_lahir`, `jk_guru`, `alamat_guru`, `status_jabatan`, `foto`) VALUES
('guru01', 'Syamsul Maarif, S.Pd.I', 'Bangkalan', '1982-12-12', 'Laki-Laki', 'Kemayoran', 'Teknik Komputer Jaringan', '../../gambar/foto/guru05.jpg'),
('guru02', 'Siti Lia Sismawati, A.Md.', 'Bojonegoro', '1982-12-12', 'Perempuan', 'Graha Permai', 'Teknik Komputer Jaringan', '../../gambar/foto/guru05.jpg'),
('guru03', 'Suhermanto, S.Kom', 'Sampang', '1982-12-12', 'Laki-Laki', 'Junok', 'Teknik Komputer Jaringan', '../../gambar/foto/guru05.jpg'),
('guru04', 'Risdiana, S.Pd.', 'Bangkalan', '1982-12-12', 'Perempuan', 'Kemayoran', 'Teknik Komputer Jaringan', '../../gambar/foto/guru05.jpg'),
('guru05', 'Aditya Mandala P., S.Pd.', 'Bangkalan', '1982-12-12', 'Laki-Laki', 'Graha', 'Teknik Komputer Jaringan', '../../gambar/foto/guru05.jpg'),
('guru06', 'Astrid Wulandari, S.Pd.', 'Bangkalan', '1992-12-12', 'Perempuan', 'Kemayoran', 'Teknik Komputer Jaringan', '../../gambar/foto/guru05.jpg'),
('guru07', 'Ulil Albab, S.Pd.', 'Bangkalan', '1996-12-12', 'Laki-Laki', 'Graha Permai', 'Teknik Komputer Jaringan', '../../gambar/foto/guru05.jpg'),
('guru08', 'Djamaluddin ,S.Pd.', 'Bojonegoro', '1992-01-12', 'Laki-Laki', 'Bojonegoro', 'Teknik Kendaraan Ringan', ''),
('guru09', 'Imam Qozali Pratama ,S.Pd.', 'Bojonegoro', '1992-01-12', 'Laki-Laki', 'Bojonegoro', 'Teknik Kendaraan Ringan', ''),
('guru10', 'Ach Zakaria ,S.Pd.', 'Bojonegoro', '1992-01-12', 'Laki-Laki', 'Bojonegoro', 'Teknik Kendaraan Ringan', ''),
('guru11', 'Agus Sumarwoto ,S.Pd.', 'Bojonegoro', '1992-01-12', 'Laki-Laki', 'Bojonegoro', 'Teknik  Kendaraan Ringan', ''),
('guru12', 'Fathur Rosi ,S.Pd.', 'Bojonegoro', '1992-01-12', 'Laki-Laki', 'Bojonegoro', 'Teknik Kendaraan Ringan', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `guru_pembimbing`
--

CREATE TABLE IF NOT EXISTS `guru_pembimbing` (
`id` int(11) NOT NULL,
  `id_siswa` varchar(20) NOT NULL,
  `id_guru` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `nilai`
--

CREATE TABLE IF NOT EXISTS `nilai` (
`id_nilai` int(11) NOT NULL,
  `id_du_di` varchar(20) NOT NULL,
  `id_siswa` varchar(20) NOT NULL,
  `nilai_kinerja` enum('Amat Baik (AB)','Baik (B)','Kurang (K)') NOT NULL,
  `nilai_sikap` enum('Amat Baik (AB)','Baik (B)','Kurang (K)') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `program_keahlian`
--

CREATE TABLE IF NOT EXISTS `program_keahlian` (
`id` int(11) NOT NULL,
  `nama` varchar(50) DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data untuk tabel `program_keahlian`
--

INSERT INTO `program_keahlian` (`id`, `nama`) VALUES
(1, 'Teknik Komputer Jaringan'),
(2, 'Teknik Kendaraan Ringan');

-- --------------------------------------------------------

--
-- Struktur dari tabel `siswa`
--

CREATE TABLE IF NOT EXISTS `siswa` (
  `id_siswa` varchar(20) NOT NULL DEFAULT '',
  `nama_siswa` varchar(45) NOT NULL,
  `tempat_lahir` varchar(30) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `jk` enum('Laki-Laki','Perempuan') NOT NULL,
  `Alamat` varchar(50) NOT NULL,
  `program_keahlian` varchar(50) DEFAULT NULL,
  `nama_ortu` varchar(30) NOT NULL,
  `status_pondok` enum('ya','tidak') NOT NULL,
  `foto` varchar(50) DEFAULT NULL,
  `tahun_pelajaran` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `siswa`
--

INSERT INTO `siswa` (`id_siswa`, `nama_siswa`, `tempat_lahir`, `tanggal_lahir`, `jk`, `Alamat`, `program_keahlian`, `nama_ortu`, `status_pondok`, `foto`, `tahun_pelajaran`) VALUES
('tkj001', 'Sohib', 'Bangkalan', '2001-12-12', 'Laki-Laki', 'Jl. Telang', 'Teknik Komputer Jaringan', 'Wasri', 'ya', '../../gambar/foto/tkj001.', '2017/2018 (Gelombang 1)'),
('tkj002', 'Andrianti', 'Sampang', '2000-12-12', 'Perempuan', 'Kedewan, Bojonegoro', 'Teknik Komputer Jaringan', 'Radhan', 'tidak', '../../gambar/foto/tkj002.', '2017/2018 (Gelombang 1)'),
('tkr001', 'Hendro', 'Surabaya', '2001-12-12', 'Laki-Laki', 'Sepuluh, Bangkalan', 'Teknik Kendaraan Ringan', 'Sukimin1', 'tidak', '../../gambar/foto/tkr001.', '2016/2017 (Gelombang 1)');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tabel_absen`
--

CREATE TABLE IF NOT EXISTS `tabel_absen` (
`id` int(11) NOT NULL,
  `id_du_di` varchar(20) NOT NULL,
  `id_siswa` varchar(20) NOT NULL,
  `tanggal` date NOT NULL,
  `keterangan` enum('Masuk','Sakit','Izin','Absen') NOT NULL,
  `jam_masuk` time NOT NULL,
  `jam_keluar` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tabel_aspek_monitoring`
--

CREATE TABLE IF NOT EXISTS `tabel_aspek_monitoring` (
  `id` int(11) NOT NULL,
  `uraian` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tabel_aspek_monitoring`
--

INSERT INTO `tabel_aspek_monitoring` (`id`, `uraian`) VALUES
(1, 'Peserta didik dan pembimbing insdustri menyepakati program PKL'),
(2, 'Materi PKL yang diikuti peserta didik sesuai dengan hasil pemetaan kompetensi dan program PKL'),
(3, 'Peserta didik mengisi jurnal PKL secara lengkap'),
(4, 'Peserta didik mendokumentasikan proses/prosedur/data sebagai bagian dari dokumen portofolio sesuai dengan jurnal kegiatan'),
(5, 'Pembelajaran PKL di institusi/industri menambah wawasan dan pengalaman nyata peserta didik dalam dunia kerja'),
(6, 'Pembelajaran PKL di institusi/industri menambah keterampilan peserta didik sesuai program keahlian'),
(7, 'Pembelajaran PKL di institusi/industri menambah pengetahuan peserta didik sesuai program keahlian'),
(8, 'Pembelajaran PKL di institusi/industri menambah nilai-nilai disiplin, kerja keras dan tanggung jawab'),
(9, 'Pembimbing selama pembelajaran PKL di institusi/industri berperan dengan baik'),
(10, 'Selama pembelajaran di institusi/industri peserta didik mengalami hambatan-hambatan yang sangat berarti');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tabel_jurnal`
--

CREATE TABLE IF NOT EXISTS `tabel_jurnal` (
`id_jurnal` int(11) NOT NULL,
  `id` int(11) NOT NULL,
  `jenis_kegiatan` varchar(50) NOT NULL,
  `uraian_kegiatan` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tabel_monitoring`
--

CREATE TABLE IF NOT EXISTS `tabel_monitoring` (
`id_monitoring` int(11) NOT NULL,
  `id_du_di` varchar(20) NOT NULL,
  `id_siswa` varchar(20) NOT NULL,
  `id` int(11) NOT NULL,
  `urutan_ke` enum('I','II') NOT NULL,
  `aspek_1` enum('Ya','Tidak') NOT NULL,
  `aspek_2` enum('Ya','Tidak') NOT NULL,
  `aspek_3` enum('Ya','Tidak') NOT NULL,
  `aspek_4` enum('Ya','Tidak') NOT NULL,
  `aspek_5` enum('Ya','Tidak') NOT NULL,
  `aspek_6` enum('Ya','Tidak') NOT NULL,
  `aspek_7` enum('Ya','Tidak') NOT NULL,
  `aspek_8` enum('Ya','Tidak') NOT NULL,
  `aspek_9` enum('Ya','Tidak') NOT NULL,
  `aspek_10` enum('Ya','Tidak') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id_user` varchar(20) NOT NULL DEFAULT '',
  `password` varchar(50) NOT NULL,
  `level` enum('Admin','Siswa','Guru','DUDI') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id_user`, `password`, `level`) VALUES
('Abadi_001', 'Abadi_001', 'DUDI'),
('admin01', 'admin', 'Admin'),
('astra_001', 'astra_001', 'DUDI'),
('Aulia_001', 'Aulia_001', 'DUDI'),
('demo_001', 'demo_001', 'DUDI'),
('dr_motor_001', 'dr_motor_001', 'DUDI'),
('guru01', 'guru01', 'Guru'),
('guru02', 'guru02', 'Guru'),
('guru03', 'guru03', 'Guru'),
('guru04', 'guru04', 'Guru'),
('guru05', 'guru05', 'Guru'),
('guru06', 'guru06', 'Guru'),
('guru07', 'guru07', 'Guru'),
('guru08', 'guru08', 'Guru'),
('guru09', 'guru09', 'Guru'),
('guru10', 'guru10', 'Guru'),
('guru11', 'guru11', 'Guru'),
('guru12', 'guru12', 'Guru'),
('hikari_001', 'hikari_001', 'DUDI'),
('k90980989', 'k90980989', 'Siswa'),
('loka_001', 'loka_001', 'DUDI'),
('suzukimotortelang', 'suzukimotortelang', 'DUDI'),
('telcomtecsurabaya', 'telcomtecsurabaya', 'DUDI'),
('tkj001', 'tkj001', 'Siswa'),
('tkj002', 'tkj002', 'Siswa'),
('tkr001', 'tkr001', 'Siswa'),
('tkr006', 'tkr006', 'Siswa'),
('wahyu_001', 'wahyu_001', 'DUDI'),
('win_001', 'win_001', 'DUDI');

-- --------------------------------------------------------

--
-- Struktur dari tabel `usulan_dudi`
--

CREATE TABLE IF NOT EXISTS `usulan_dudi` (
`id_usulan` int(11) NOT NULL,
  `id_siswa` varchar(20) NOT NULL,
  `id_du_di` varchar(20) NOT NULL,
  `status` enum('acc','belum acc') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `du_di`
--
ALTER TABLE `du_di`
 ADD PRIMARY KEY (`id_du_di`);

--
-- Indexes for table `guru`
--
ALTER TABLE `guru`
 ADD PRIMARY KEY (`id_guru`);

--
-- Indexes for table `guru_pembimbing`
--
ALTER TABLE `guru_pembimbing`
 ADD PRIMARY KEY (`id`), ADD KEY `id_siswa` (`id_siswa`,`id_guru`), ADD KEY `id_guru` (`id_guru`);

--
-- Indexes for table `nilai`
--
ALTER TABLE `nilai`
 ADD PRIMARY KEY (`id_nilai`), ADD KEY `id_du_di` (`id_du_di`,`id_siswa`), ADD KEY `id_siswa` (`id_siswa`);

--
-- Indexes for table `program_keahlian`
--
ALTER TABLE `program_keahlian`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `siswa`
--
ALTER TABLE `siswa`
 ADD PRIMARY KEY (`id_siswa`);

--
-- Indexes for table `tabel_absen`
--
ALTER TABLE `tabel_absen`
 ADD PRIMARY KEY (`id`), ADD KEY `id_du_di` (`id_du_di`), ADD KEY `id_siswa` (`id_siswa`);

--
-- Indexes for table `tabel_aspek_monitoring`
--
ALTER TABLE `tabel_aspek_monitoring`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tabel_jurnal`
--
ALTER TABLE `tabel_jurnal`
 ADD PRIMARY KEY (`id_jurnal`), ADD KEY `id` (`id`);

--
-- Indexes for table `tabel_monitoring`
--
ALTER TABLE `tabel_monitoring`
 ADD PRIMARY KEY (`id_monitoring`), ADD KEY `id_du_di` (`id_du_di`,`id_siswa`,`id`), ADD KEY `id_siswa` (`id_siswa`), ADD KEY `id` (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
 ADD PRIMARY KEY (`id_user`);

--
-- Indexes for table `usulan_dudi`
--
ALTER TABLE `usulan_dudi`
 ADD PRIMARY KEY (`id_usulan`), ADD KEY `id_siswa` (`id_siswa`,`id_du_di`), ADD KEY `id_du_di` (`id_du_di`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `guru_pembimbing`
--
ALTER TABLE `guru_pembimbing`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `nilai`
--
ALTER TABLE `nilai`
MODIFY `id_nilai` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `program_keahlian`
--
ALTER TABLE `program_keahlian`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tabel_absen`
--
ALTER TABLE `tabel_absen`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tabel_jurnal`
--
ALTER TABLE `tabel_jurnal`
MODIFY `id_jurnal` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tabel_monitoring`
--
ALTER TABLE `tabel_monitoring`
MODIFY `id_monitoring` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `usulan_dudi`
--
ALTER TABLE `usulan_dudi`
MODIFY `id_usulan` int(11) NOT NULL AUTO_INCREMENT;
--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `guru_pembimbing`
--
ALTER TABLE `guru_pembimbing`
ADD CONSTRAINT `guru_pembimbing_ibfk_1` FOREIGN KEY (`id_siswa`) REFERENCES `siswa` (`id_siswa`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `guru_pembimbing_ibfk_2` FOREIGN KEY (`id_guru`) REFERENCES `guru` (`id_guru`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `nilai`
--
ALTER TABLE `nilai`
ADD CONSTRAINT `nilai_ibfk_1` FOREIGN KEY (`id_du_di`) REFERENCES `du_di` (`id_du_di`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `nilai_ibfk_2` FOREIGN KEY (`id_siswa`) REFERENCES `siswa` (`id_siswa`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tabel_absen`
--
ALTER TABLE `tabel_absen`
ADD CONSTRAINT `tabel_absen_ibfk_1` FOREIGN KEY (`id_du_di`) REFERENCES `du_di` (`id_du_di`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `tabel_absen_ibfk_2` FOREIGN KEY (`id_siswa`) REFERENCES `siswa` (`id_siswa`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tabel_jurnal`
--
ALTER TABLE `tabel_jurnal`
ADD CONSTRAINT `tabel_jurnal_ibfk_1` FOREIGN KEY (`id`) REFERENCES `tabel_absen` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tabel_monitoring`
--
ALTER TABLE `tabel_monitoring`
ADD CONSTRAINT `tabel_monitoring_ibfk_1` FOREIGN KEY (`id_du_di`) REFERENCES `du_di` (`id_du_di`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `tabel_monitoring_ibfk_2` FOREIGN KEY (`id_siswa`) REFERENCES `siswa` (`id_siswa`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `tabel_monitoring_ibfk_3` FOREIGN KEY (`id`) REFERENCES `guru_pembimbing` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `usulan_dudi`
--
ALTER TABLE `usulan_dudi`
ADD CONSTRAINT `usulan_dudi_ibfk_1` FOREIGN KEY (`id_siswa`) REFERENCES `siswa` (`id_siswa`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `usulan_dudi_ibfk_2` FOREIGN KEY (`id_du_di`) REFERENCES `du_di` (`id_du_di`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
