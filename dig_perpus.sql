-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 30, 2024 at 04:46 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dig_perpus`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_anggota`
--

CREATE TABLE `tb_anggota` (
  `id_anggota` varchar(10) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `jenis_anggota` enum('Dosen','Mahasiswa') NOT NULL,
  `password` varchar(20) NOT NULL,
  `level` char(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tb_anggota`
--

INSERT INTO `tb_anggota` (`id_anggota`, `nama`, `jenis_anggota`, `password`, `level`) VALUES
('123', 'erwin', 'Mahasiswa', 'erwin', '');

-- --------------------------------------------------------

--
-- Table structure for table `tb_buku`
--

CREATE TABLE `tb_buku` (
  `id_buku` varchar(10) NOT NULL,
  `judul_buku` varchar(200) NOT NULL,
  `penerbit` varchar(20) NOT NULL,
  `tgl` date NOT NULL,
  `file_buku` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tb_buku`
--

INSERT INTO `tb_buku` (`id_buku`, `judul_buku`, `penerbit`, `tgl`, `file_buku`) VALUES
('B002', 'Asuhan Keperawatan Pada Tn. M Dengan Resiko Perlakuan Kekerasan Di Ruang Nyiur Rskd Dadi Makassar Sulawesi Selatan Tanggal 14 S/D 16 Juni 2023', 'SIGIT K.P. WIRASAKTI', '2024-05-17', 'C017201037_skripsi.pdf'),
('B003', 'ASUHAN KEPERAWATAN KELUARGA PADA KLIEN NY. H DENGAN MASALAH PRURITUS DI PUSKESMAS KASSI KASSI KECAMATAN RAPPOCINI KOTA MAKASSAR SULAWESI SELATAN TANGGAL 17 S/D 19 April 2023', 'WENS YANAKAIMU', '2024-05-17', 'WENS-YANAKAIMU.pdf'),
('B004', 'Asuhan Keperawatan Kepada Tn.M.I. Dengan Demam Berdarah Dengue Di Ruang Perawatan Interna Rsud Kota Makassar', 'HENDRIKUS Y KOGOYA', '2024-05-17', 'KTI-Hendrikus-Kogoya.pdf'),
('B005', 'ASUHAN KEPERAWATAN PADA Tn. A DENGAN GANGGUAN HALUSINASI PENDENGARAN DI RUANG NYIUR RUMAH SAKIT KHUSUS DAERAH DADI PROVINSI SULAWESI SELATAN PADA TANGGAL 13 S/D 17 JUNI 2023', 'MAHOR YOD', '2024-05-17', 'KTI-YOD_KTI.pdf'),
('B006', 'ASUHAN KEPERAWATAN MEDIKAL BEDAH PADA NY. M DENGAN SINUSITIS MAKSILARIS KANAN DI RUMAH SAKIT UMUM DAERAH KOTA MAKASSAR TANGGAL 15 S/D 20 MEI 2023', 'SIAHAI KAMUR', '2024-05-17', 'KTI__SIHAI__KAMUR.pdf'),
('B007', 'ASUHAN KEPERAWATAN PADA An. M.A DENGAN KASUS DEMAM BERDARAH DI RUANG PERAWATAN INAP RSUD KOTA MAKASSAR', 'FILEMON YUWARYEMENUK', '2024-05-17', 'KTI_FILEMON-YUWARYEMNK-2023.pdf'),
('B008', 'HUBUNGAN ANTARA TINGKAT STRES DENGAN KEJADIAN NYERI KEPALA PRIMER PADA MAHASISWA S1 FISIOTERAPI FAKULTAS KEPERAWATAN UNIVERSITAS HASANUDDIN ', 'MELIANI', '2024-05-17', 'MEILANI SKRIPSI.pdf'),
('B009', 'ASUHAN KEPERAWATAN PADA KLIEN TN. H DENGAN MASALAH HIPERTENSI DI KELURAHAN RAPPOKALLING,    KECAMATAN TALLO, KOTA MAKASSAR, SULAWESI SELATAN  TANGGAL 08 S/D 13 MEI 2023 ', 'PASKALIS A WARAS', '2024-05-17', 'paskalis.pdf'),
('B010', 'ASUHAN KEPERAWATAN PADA NY.K DENGAN  G1 P0 A1 HAMIL 25 MINGGU  DI RUMAH SAKIT UMUM DI KOTA MAKASSAR ', 'KLETUS DIKAT', '2024-05-17', 'ETUS KTI REVISI 2.pdf'),
('B011', 'ASUHAN KEPERAWATAN PADA TN. N DENGAN MASALAH UTAMA HARGA DIRI RENDAH RSUD DADI PROVINSI SULAWESI SELATAN MAKASSAR ', 'NIKO ASIAM', '2024-05-17', 'KTI REVISI NIKO ASIAM.pdf'),
('B012', 'ASUHAN KEPERAWATAN PADA  An. R DENGAN DIAGNOSA VULNUS LACERATUM DI RSUD DAYA KOTA MAKASSAR ', 'ENOS KAISMA', '2024-05-17', 'KTI_(_ENOS_KAISMA)  FIX SEKALIA.pdf'),
('B013', 'ASUHAN KEPERAWATAN PADA KELUARGA Tn.J DENGAN KASUS HIPERTENSI  DI PUSKESMAS RAPOKALLING KOTA MAKASSAR', 'SABINUS DEMENAKAT', '2024-05-17', 'SABNUS KTIfix19.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `tb_pengguna`
--

CREATE TABLE `tb_pengguna` (
  `id_pengguna` int(11) NOT NULL,
  `nama_pengguna` varchar(20) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(15) NOT NULL,
  `level` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tb_pengguna`
--

INSERT INTO `tb_pengguna` (`id_pengguna`, `nama_pengguna`, `username`, `password`, `level`) VALUES
(1, 'erwin', 'erwin', 'erwin', 'Administrator'),
(2, 'Andi Nur Awang', 'awang', 'awang', 'Administrator');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_pengguna`
--
ALTER TABLE `tb_pengguna`
  ADD PRIMARY KEY (`id_pengguna`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_pengguna`
--
ALTER TABLE `tb_pengguna`
  MODIFY `id_pengguna` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
