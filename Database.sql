-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 21, 2021 at 02:03 AM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cobamemo`
--

-- --------------------------------------------------------

--
-- Table structure for table `detail_cc`
--

CREATE TABLE `detail_cc` (
  `id_detail` int(20) NOT NULL,
  `kode_memo` varchar(255) NOT NULL,
  `id_pegawai` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `detail_cc`
--

INSERT INTO `detail_cc` (`id_detail`, `kode_memo`, `id_pegawai`) VALUES
(26, '8625f51f-c21e-47b7-96da-c525e8c1a1c9', 7),
(27, '206b86fd-d3d2-48ea-a814-70a3e7339731', 9),
(28, '206b86fd-d3d2-48ea-a814-70a3e7339731', 7),
(29, 'bb5183ed-8f24-4a57-aaab-ccd18ea050b6', 12),
(30, 'bb5183ed-8f24-4a57-aaab-ccd18ea050b6', 9),
(31, 'bb5183ed-8f24-4a57-aaab-ccd18ea050b6', 7),
(32, '37ea8861-ba4e-4ece-9ad7-61369650bee5', 7),
(33, '0eb6a1ba-1c80-49c7-a91a-796f961403af', 7),
(34, '188fd667-ea8d-473a-9ace-ae311e93fb7f', 12),
(35, '852fd578-d5d5-4a49-9d48-56ff0a821bff', 11),
(36, '29968fb5-3e81-4acf-8ff2-e7a81797ddd2', 12),
(37, '29968fb5-3e81-4acf-8ff2-e7a81797ddd2', 15),
(38, '619b17dd-9d05-441c-9534-0d06bd6cce06', 7),
(39, '76a87894-f6bb-4b07-bb6e-0e48ffa8f99c', 7),
(40, 'c45b6046-66d4-48c0-850a-b6ef018cce78', 9),
(41, 'c45b6046-66d4-48c0-850a-b6ef018cce78', 7),
(42, 'a7a493bd-a137-4994-bd5b-e04513fc1747', 7),
(43, 'd69b9e98-7f3f-468f-a86a-59ab51cc1b3c', 7),
(44, '9548ce9f-eeb7-45e4-ac54-5c7e9aa35384', 15),
(45, '030d2eea-f11b-48f9-96ed-4cb1e90a6e9c', 9),
(46, '030d2eea-f11b-48f9-96ed-4cb1e90a6e9c', 7),
(47, '5825dfb9-a300-4ed5-b0ae-4af845b2e621', 15);

-- --------------------------------------------------------

--
-- Table structure for table `disposisi`
--

CREATE TABLE `disposisi` (
  `id_disposisi` int(20) NOT NULL,
  `kode_memo` varchar(255) NOT NULL,
  `dari` int(255) NOT NULL,
  `tanggal` varchar(255) NOT NULL,
  `perihal` varchar(50) NOT NULL,
  `sifat` varchar(255) NOT NULL,
  `tujuan` int(20) NOT NULL,
  `dg_hormat` varchar(50) NOT NULL,
  `tgl_disposisi` date NOT NULL,
  `isi_disposisi` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `disposisi`
--

INSERT INTO `disposisi` (`id_disposisi`, `kode_memo`, `dari`, `tanggal`, `perihal`, `sifat`, `tujuan`, `dg_hormat`, `tgl_disposisi`, `isi_disposisi`) VALUES
(3, '01/RSMG/VIII/2020', 11, '2020-08-01', 'TANGGAL BARU', 'Rahasia', 11, 'Tanggapan dan Saran', '2020-08-04', 'kkkkkkkkkk'),
(4, '05/MI- PPI/I/2016', 12, '2020-08-01', 'Pemberitaual Covid', 'Sangat Segera', 11, 'Tanggapan dan Saran', '2020-08-04', 'Hapat Koordinasi dengan Biro Teknnologi Ifomasi'),
(5, '05/MI- PPI/I/2016', 11, '2020-07-31', 'Peta kuman terhadap kepekaan antibiotika di RSMG t', 'Segera', 7, 'Proses Lebih lanjut', '2020-08-04', 'Komite PPI segera diproses'),
(6, '12/MI.RSMG-IF/IV/202', 15, '2020-09-03', 'Update penyesuaian SIMRS', 'Sangat Segera', 11, 'Koordinasi dan Konfirmasi', '2020-09-04', 'Mohon Koordinasi dengan Bagian IT'),
(7, '05/MI- PPI/I/2016', 11, '2020-11-03', 'tes', 'Sangat Segera', 11, 'Tanggapan dan Saran', '2020-11-03', 'nnnnn'),
(8, '19/IMM/XI/2020', 11, '2020-11-19', 'COBA TANGGAL 19', 'Sangat Segera', 15, 'Proses Lebih lanjut', '2020-11-19', 'Harap Segera di Tindak Lanjuti'),
(9, '05/MI- PII/I/2016', 11, '2020-12-07', 's', 'Rahasia', 11, 'Tanggapan dan Saran', '2020-12-07', 'Lanjutkan'),
(10, '90/GRESIK/2020', 11, '2020-12-15', 'UJIAN KP', 'Segera', 11, 'Proses Lebih lanjut', '2020-12-15', 'tes ujin kp');

-- --------------------------------------------------------

--
-- Table structure for table `jabatan`
--

CREATE TABLE `jabatan` (
  `id_jabatan` int(20) NOT NULL,
  `jabatan` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `jabatan`
--

INSERT INTO `jabatan` (`id_jabatan`, `jabatan`) VALUES
(7, 'Komite PPI'),
(9, 'Administrator'),
(11, 'Karu Teknologi Informasi'),
(12, 'Kabag Umum'),
(14, 'Direktur'),
(15, 'Instalasi Farmasi'),
(16, 'Kabag Penunjang Medis');

-- --------------------------------------------------------

--
-- Table structure for table `memo_keluar`
--

CREATE TABLE `memo_keluar` (
  `kode_memo` varchar(255) NOT NULL,
  `no_memo` varchar(255) NOT NULL,
  `id_penerima` int(11) NOT NULL,
  `pengirim` int(11) NOT NULL,
  `id_jabatan` int(20) NOT NULL,
  `tanggal` date NOT NULL,
  `perihal` varchar(60) NOT NULL,
  `mengetahui` int(20) DEFAULT 0,
  `isi` text NOT NULL,
  `lampiran` varchar(255) NOT NULL,
  `status` enum('belum','sudah') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `memo_keluar`
--

INSERT INTO `memo_keluar` (`kode_memo`, `no_memo`, `id_penerima`, `pengirim`, `id_jabatan`, `tanggal`, `perihal`, `mengetahui`, `isi`, `lampiran`, `status`) VALUES
('030d2eea-f11b-48f9-96ed-4cb1e90a6e9c', '05/MI- PII/I/2016', 14, 13, 11, '2020-12-07', 's', 12, '<p>coba tes</p>', '', 'sudah'),
('1148ab5f-dfad-4745-a82f-56e51f0e19f2', '03/IMM-TEKNOKRAT/06/XI/2020', 14, 13, 11, '2020-11-06', 'COBA TEMBUSAN', 12, '<p>CRA INSTA</p>', '', 'sudah'),
('188fd667-ea8d-473a-9ace-ae311e93fb7f', '27/RSMG/VIII/2020', 14, 13, 11, '2020-08-27', 'coba', 12, '<p>ttes123</p>', 'SURAT DESA.pdf', 'sudah'),
('206b86fd-d3d2-48ea-a814-70a3e7339731', '32/UMG-IMM/VII/2002', 14, 13, 11, '2020-07-31', 'Pengajuan Dana', 12, '<p>hhhh</p>', '', 'sudah'),
('29968fb5-3e81-4acf-8ff2-e7a81797ddd2', '08/UMG/IX/2020', 14, 13, 11, '2020-09-08', 'Peta kuman terhadap kepekaan antibiotika di RSMG tahun 2015', 12, '<p>TES</p>', 'KK.pdf', 'sudah'),
('37ea8861-ba4e-4ece-9ad7-61369650bee5', '05/MI- PPI/I/2016', 14, 17, 12, '2020-08-01', 'Pemberitaual Covid', 0, '<p>gggg</p>', '', 'sudah'),
('5825dfb9-a300-4ed5-b0ae-4af845b2e621', '90/GRESIK/2020', 14, 13, 11, '2020-12-15', 'UJIAN KP', 12, '<p>TES</p>', '', 'sudah'),
('619b17dd-9d05-441c-9534-0d06bd6cce06', '029/IMM-RTL/IX/2020', 14, 13, 11, '2020-09-29', 'Rencana Tindak Lanjut', 12, '<p>tes</p>', '', 'sudah'),
('76a87894-f6bb-4b07-bb6e-0e48ffa8f99c', '05/MI- PPI/I/2016', 14, 13, 11, '2020-11-03', 'tes', 12, '<p>hhhh</p>', '', 'sudah'),
('8625f51f-c21e-47b7-96da-c525e8c1a1c9', '31', 14, 13, 11, '2020-07-31', 'Pemberitaual Covid', 12, '<p>ssss</p>', '', 'sudah'),
('9548ce9f-eeb7-45e4-ac54-5c7e9aa35384', '19/IMM/XI/2020', 14, 13, 11, '2020-11-19', 'COBA TANGGAL 19', 12, '<p>COBA&nbsp;</p>', '', 'sudah'),
('a7a493bd-a137-4994-bd5b-e04513fc1747', '05/MI- PPI/I/2016', 14, 13, 11, '2020-11-16', 'coba', 12, '<p>fffff</p>', '', 'sudah'),
('bb5183ed-8f24-4a57-aaab-ccd18ea050b6', '05/MI- PPI/I/2016', 14, 13, 11, '2020-07-31', 'Peta kuman terhadap kepekaan antibiotika di RSMG tahun 2015', 12, '<p>jjjjjjjj</p>', '', 'sudah'),
('c45b6046-66d4-48c0-850a-b6ef018cce78', '30/PAN-QURBAN/11/2020', 14, 13, 11, '2020-11-11', 'QURBAN', 12, '<p><span style=\"font-family: &quot;Times New Roman&quot;;\">Efficiently evolve collaborative materials for future-proof results. Objectively productivate customer directed materials for goal-oriented technology. Intrinsicly enhance low-risk high-yield strategic theme areas rather than standardized sources. Professionally synergize market positioning convergence without dynamic portals. Continually whiteboard an expanded array of leadership skills vis-a-vis exceptional platforms.</span></p><p><span style=\"font-family: &quot;Times New Roman&quot;;\">Holisticly unleash superior materials with resource-leveling applications. Dynamically procrastinate compelling synergy with focused processes. Efficiently morph functionalized architectures through user-centric \"outside the box\" thinking. Appropriately grow ethical web-readiness whereas proactive \"outside the box\" thinking. Professionally maximize end-to-end e-business and dynamic scenarios.</span></p><p><span style=\"font-family: &quot;Times New Roman&quot;;\">Phosfluorescently actualize diverse schemas without technically sound experiences. Proactively procrastinate front-end potentialities after front-end relationships. Energistically develop extensible schemas rather than backend internal or \"organic\" sources. Progressively reinvent superior best practices after resource-leveling functionalities. Phosfluorescently morph team building networks with emerging e-tailers.</span></p><p><span style=\"font-family: &quot;Times New Roman&quot;;\">Energistically maximize effective convergence without innovative best practices. Conveniently customize multidisciplinary opportunities for e-business infomediaries. Collaboratively productize stand-alone portals with 2.0 results. Conveniently plagiarize real-time total linkage before reliable processes. Competently architect adaptive schemas via distributed web services.</span></p>', '', ''),
('d69b9e98-7f3f-468f-a86a-59ab51cc1b3c', '30/IMM/XI/2020', 14, 13, 11, '2020-11-17', 'HARI SELASA', 7, '<p>Phosfluorescently initiate clicks-and-mortar users via 2.0 meta-services. Interactively synergize cross-media innovation vis-a-vis value-added catalysts for change. Collaboratively negotiate collaborative deliverables after reliable users. Objectively deploy client-focused sources with B2B resources. Synergistically optimize distinctive internal or \"organic\" sources vis-a-vis standardized networks.</p><p>Globally conceptualize accurate e-business via focused technology. Assertively supply multifunctional methodologies and ubiquitous innovation. Globally leverage existing proactive communities rather than e-business expertise. Quickly strategize backward-compatible platforms without cutting-edge manufactured products. Enthusiastically drive premier customer service without exceptional customer service.</p><p>Authoritatively drive global paradigms via adaptive schemas. Assertively iterate high-payoff methodologies whereas stand-alone value. Synergistically strategize performance based partnerships rather than robust niches. Quickly matrix customer directed e-commerce and client-focused leadership skills. Uniquely repurpose distributed technology via state of the art scenarios</p><p>Credibly coordinate diverse products after frictionless niches. Proactively productize strategic platforms via frictionless experiences. Continually architect exceptional interfaces for sustainable systems.</p>', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `memo_masuk`
--

CREATE TABLE `memo_masuk` (
  `kode_memo` varchar(255) NOT NULL,
  `no_memo` varchar(255) NOT NULL,
  `id_penerima` int(20) NOT NULL,
  `pengirim` int(20) NOT NULL,
  `id_jabatan` int(20) NOT NULL,
  `tanggal` date NOT NULL,
  `perihal` varchar(60) NOT NULL,
  `mengetahui` int(20) NOT NULL,
  `isi` text NOT NULL,
  `lampiran` varchar(255) NOT NULL,
  `status` enum('belum','sudah','tolak') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `memo_masuk`
--

INSERT INTO `memo_masuk` (`kode_memo`, `no_memo`, `id_penerima`, `pengirim`, `id_jabatan`, `tanggal`, `perihal`, `mengetahui`, `isi`, `lampiran`, `status`) VALUES
('030d2eea-f11b-48f9-96ed-4cb1e90a6e9c', '05/MI- PII/I/2016', 14, 13, 11, '2020-12-07', 's', 12, '<p>coba tes</p>', '', 'sudah'),
('1148ab5f-dfad-4745-a82f-56e51f0e19f2', '03/IMM-TEKNOKRAT/06/XI/2020', 14, 13, 11, '2020-11-06', 'COBA TEMBUSAN', 12, '<p>CRA INSTA</p>', '', 'sudah'),
('188fd667-ea8d-473a-9ace-ae311e93fb7f', '27/RSMG/VIII/2020', 14, 13, 11, '2020-08-27', 'coba', 12, '<p>ttes123</p>', 'SURAT DESA.pdf', 'sudah'),
('29968fb5-3e81-4acf-8ff2-e7a81797ddd2', '08/UMG/IX/2020', 14, 13, 11, '2020-09-08', 'Peta kuman terhadap kepekaan antibiotika di RSMG tahun 2015', 12, '<p>TES</p>', 'KK.pdf', 'sudah'),
('37ea8861-ba4e-4ece-9ad7-61369650bee5', '05/MI- PPI/I/2016', 14, 17, 12, '2020-08-01', 'Pemberitaual Covid', 0, '<p style=\"text-align: justify; \"><b>Assalamualaikum Wr.Wb</b></p><p style=\"text-align: justify; \">Dalam rangka pengembangan Sistem Informasi Manajemen RS agar sesuai dengan Kebutuhan</p><p style=\"text-align: justify; \">RSMG. maka pada tanggal 6 april 2020, Instalasi Teknologi Informasi RSMG melakukan Update</p><p style=\"text-align: justify; \">SIMRS Khanza. Namun Dalam Perjalanannya ada kendala-kendala yang harus segera ditindak lanjuti&nbsp;</p><p style=\"text-align: justify; \">agar sesuai dengan kebutuhan Instalasi Farmasi RS Muhammadiyah Gresik</p><p style=\"text-align: justify; \"><span style=\"font-size: 1rem;\"><br></span></p><p style=\"text-align: justify; \"><span style=\"font-size: 1rem;\">Demikian Memo Ini Kami Sampaikan, atas Perhatiannya kami sampaikan Terimakasih</span></p><p style=\"text-align: justify; \"><span style=\"font-size: 1rem;\"><b>Wassalamualaikum, Wr.Wb&nbsp;</b></span><br></p>', '', 'sudah'),
('5825dfb9-a300-4ed5-b0ae-4af845b2e621', '90/GRESIK/2020', 14, 13, 11, '2020-12-15', 'UJIAN KP', 12, '<p>TES</p>', '', 'sudah'),
('619b17dd-9d05-441c-9534-0d06bd6cce06', '029/IMM-RTL/IX/2020', 14, 13, 11, '2020-09-29', 'Rencana Tindak Lanjut', 12, '<p>tes</p>', '', 'sudah'),
('74a7a097-c74b-4cb0-8283-88fdce6110b9', '12/MI.RSMG-IF/IV/202', 14, 13, 11, '2020-09-04', 'Pemberitaual Covid', 12, '<p>ddd</p>', '', 'sudah'),
('76a87894-f6bb-4b07-bb6e-0e48ffa8f99c', '05/MI- PPI/I/2016', 14, 13, 11, '2020-11-03', 'tes', 12, '<p>hhhh</p>', '', 'sudah'),
('8625f51f-c21e-47b7-96da-c525e8c1a1c9', '31', 14, 13, 11, '2020-07-31', 'Pemberitaual Covid', 12, '<p>ssss</p>', '', 'sudah'),
('9548ce9f-eeb7-45e4-ac54-5c7e9aa35384', '19/IMM/XI/2020', 14, 13, 11, '2020-11-19', 'COBA TANGGAL 19', 12, '<p>COBA&nbsp;</p>', '', 'sudah'),
('a7a493bd-a137-4994-bd5b-e04513fc1747', '05/MI- PPI/I/2016', 14, 13, 11, '2020-11-16', 'coba', 12, '<p>fffff</p>', '', 'sudah'),
('bb5183ed-8f24-4a57-aaab-ccd18ea050b6', '05/MI- PPI/I/2016', 14, 13, 11, '2020-07-31', 'Peta kuman terhadap kepekaan antibiotika di RSMG tahun 2015', 12, '<p>jjjjjjjj</p>', '', 'sudah'),
('c45b6046-66d4-48c0-850a-b6ef018cce78', '30/PAN-QURBAN/11/2020', 14, 13, 11, '2020-11-11', 'QURBAN', 12, '<p><span style=\"font-family: &quot;Times New Roman&quot;;\">Efficiently evolve collaborative materials for future-proof results. Objectively productivate customer directed materials for goal-oriented technology. Intrinsicly enhance low-risk high-yield strategic theme areas rather than standardized sources. Professionally synergize market positioning convergence without dynamic portals. Continually whiteboard an expanded array of leadership skills vis-a-vis exceptional platforms.</span></p><p><span style=\"font-family: &quot;Times New Roman&quot;;\">Holisticly unleash superior materials with resource-leveling applications. Dynamically procrastinate compelling synergy with focused processes. Efficiently morph functionalized architectures through user-centric \"outside the box\" thinking. Appropriately grow ethical web-readiness whereas proactive \"outside the box\" thinking. Professionally maximize end-to-end e-business and dynamic scenarios.</span></p><p><span style=\"font-family: &quot;Times New Roman&quot;;\">Phosfluorescently actualize diverse schemas without technically sound experiences. Proactively procrastinate front-end potentialities after front-end relationships. Energistically develop extensible schemas rather than backend internal or \"organic\" sources. Progressively reinvent superior best practices after resource-leveling functionalities. Phosfluorescently morph team building networks with emerging e-tailers.</span></p><p><span style=\"font-family: &quot;Times New Roman&quot;;\">Energistically maximize effective convergence without innovative best practices. Conveniently customize multidisciplinary opportunities for e-business infomediaries. Collaboratively productize stand-alone portals with 2.0 results. Conveniently plagiarize real-time total linkage before reliable processes. Competently architect adaptive schemas via distributed web services.</span></p>', '', 'tolak'),
('d69b9e98-7f3f-468f-a86a-59ab51cc1b3c', '30/IMM/XI/2020', 14, 13, 11, '2020-11-17', 'HARI SELASA', 7, '<p>Phosfluorescently initiate clicks-and-mortar users via 2.0 meta-services. Interactively synergize cross-media innovation vis-a-vis value-added catalysts for change. Collaboratively negotiate collaborative deliverables after reliable users. Objectively deploy client-focused sources with B2B resources. Synergistically optimize distinctive internal or \"organic\" sources vis-a-vis standardized networks.</p><p>Globally conceptualize accurate e-business via focused technology. Assertively supply multifunctional methodologies and ubiquitous innovation. Globally leverage existing proactive communities rather than e-business expertise. Quickly strategize backward-compatible platforms without cutting-edge manufactured products. Enthusiastically drive premier customer service without exceptional customer service.</p><p>Authoritatively drive global paradigms via adaptive schemas. Assertively iterate high-payoff methodologies whereas stand-alone value. Synergistically strategize performance based partnerships rather than robust niches. Quickly matrix customer directed e-commerce and client-focused leadership skills. Uniquely repurpose distributed technology via state of the art scenarios</p><p>Credibly coordinate diverse products after frictionless niches. Proactively productize strategic platforms via frictionless experiences. Continually architect exceptional interfaces for sustainable systems.</p>', '', 'tolak');

-- --------------------------------------------------------

--
-- Table structure for table `pegawai`
--

CREATE TABLE `pegawai` (
  `id_pegawai` int(11) NOT NULL,
  `nip` varchar(30) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `id_jabatan` int(20) NOT NULL,
  `akses` varchar(30) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `qr_code` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pegawai`
--

INSERT INTO `pegawai` (`id_pegawai`, `nip`, `nama`, `id_jabatan`, `akses`, `username`, `password`, `qr_code`) VALUES
(13, '170602056', 'Wahyu Lazzuady', 11, 'karu', 'admin1', '$2y$10$CuhukXnHFrXXTnG9sm9q0.Syu/heYJsIHD8AzERMZHh15OEJLEcRy', '170602056.png'),
(17, '170602077', 'Muniroh', 12, 'kabag', 'admin2', '$2y$10$xqSSEpEL9lEJCuhpHQVimuowvcvy0h/5WP9lDduZFvEo9bO3IJe1u', '170602077.png'),
(21, '45678', 'dr. Imam Suyuthi. Sp.An', 14, 'direktur', 'dirut', '$2y$10$/SN2FOqwb6YJtwmmKUwANuKGbilnsU1qI1xqxIrUyUQ/WbALSqxK6', '45678.png'),
(22, '170809777', 'Dia Ambita', 9, 'admin', 'ambita', '$2y$10$MgJnhztqEipFcP8iXC.nvuJEvUw6j48vQHHyFuABLi2PVKV5OcWni', '170809777.png'),
(28, '17070000', 'Alfiyah Hanun, S.Si, Apt', 15, 'karu', 'farmasi', '$2y$10$AW/m9JB3VxdkiNRt6ewquuTVQMDrlwTwxm4kcekWKPMVn/BHrFhSe', '17070000.png'),
(30, '200602054', 'Dian Umbara', 7, 'kabag', 'dian', '$2y$10$lrGXTQ6K86P0a8Vox7TgEe6UNWle9c06PCxtB0SVF94.QXy1.6oL.', '200602054.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `detail_cc`
--
ALTER TABLE `detail_cc`
  ADD PRIMARY KEY (`id_detail`),
  ADD KEY `id_pegawai` (`id_pegawai`),
  ADD KEY `kode_memo` (`kode_memo`);

--
-- Indexes for table `disposisi`
--
ALTER TABLE `disposisi`
  ADD PRIMARY KEY (`id_disposisi`),
  ADD KEY `tujuan` (`tujuan`),
  ADD KEY `kode_memo` (`kode_memo`);

--
-- Indexes for table `jabatan`
--
ALTER TABLE `jabatan`
  ADD PRIMARY KEY (`id_jabatan`);

--
-- Indexes for table `memo_keluar`
--
ALTER TABLE `memo_keluar`
  ADD PRIMARY KEY (`kode_memo`),
  ADD KEY `id_penerima` (`id_penerima`),
  ADD KEY `pengirim` (`pengirim`),
  ADD KEY `id_jabatan` (`id_jabatan`);

--
-- Indexes for table `memo_masuk`
--
ALTER TABLE `memo_masuk`
  ADD PRIMARY KEY (`kode_memo`),
  ADD KEY `id_penerima` (`id_penerima`),
  ADD KEY `pengirim` (`pengirim`),
  ADD KEY `id_jabatan` (`id_jabatan`);

--
-- Indexes for table `pegawai`
--
ALTER TABLE `pegawai`
  ADD PRIMARY KEY (`id_pegawai`),
  ADD KEY `id_jabatan` (`id_jabatan`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `detail_cc`
--
ALTER TABLE `detail_cc`
  MODIFY `id_detail` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `disposisi`
--
ALTER TABLE `disposisi`
  MODIFY `id_disposisi` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `jabatan`
--
ALTER TABLE `jabatan`
  MODIFY `id_jabatan` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `pegawai`
--
ALTER TABLE `pegawai`
  MODIFY `id_pegawai` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `memo_keluar`
--
ALTER TABLE `memo_keluar`
  ADD CONSTRAINT `fk_jabatan_memo_keluar` FOREIGN KEY (`id_jabatan`) REFERENCES `jabatan` (`id_jabatan`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_penerima_memo_keluar` FOREIGN KEY (`id_penerima`) REFERENCES `jabatan` (`id_jabatan`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_pengirim_keluar` FOREIGN KEY (`pengirim`) REFERENCES `pegawai` (`id_pegawai`);

--
-- Constraints for table `pegawai`
--
ALTER TABLE `pegawai`
  ADD CONSTRAINT `fk_id_jabatan` FOREIGN KEY (`id_jabatan`) REFERENCES `jabatan` (`id_jabatan`) ON DELETE NO ACTION ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
