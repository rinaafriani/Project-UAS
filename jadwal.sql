-- phpMyAdmin SQL Dump
-- version 3.1.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 08, 2017 at 08:31 PM
-- Server version: 5.1.35
-- PHP Version: 5.2.10

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `jadwal`
--

-- --------------------------------------------------------

--
-- Table structure for table `guru`
--

CREATE TABLE IF NOT EXISTS `guru` (
  `kode_guru` char(5) NOT NULL,
  `nip` varchar(20) NOT NULL,
  `nama_guru` varchar(100) NOT NULL,
  `kelamin` varchar(10) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `no_telepon` varchar(20) NOT NULL,
  `status_aktif` enum('Aktif','Tidak') NOT NULL,
  PRIMARY KEY (`kode_guru`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `guru`
--

INSERT INTO `guru` (`kode_guru`, `nip`, `nama_guru`, `kelamin`, `alamat`, `no_telepon`, `status_aktif`) VALUES
('G0002', '8715002', 'alkamar', 'Laki-laki', 'jalan beringin 18 padang', '081277641520', 'Aktif'),
('G0001', '8815001', 'syafril', 'Laki-laki', 'jalan  kopi raya 17 ', '081363028758', 'Aktif'),
('G0003', '8616003', 'sumiati', 'Perempuan', 'komplek arai pinang ,jln merdeka 2 E/11 G.P', '081364749310', 'Aktif'),
('G0004', '8115004', 'hayatul nismah', 'Perempuan', 'komp.cendana Thp IV/A/ 2 air tawar', '085272817666', 'Aktif'),
('G0005', '8515005', 'rini susanty,S.IQ,S.pdi', 'Perempuan', 'jln.Kopi Raya no 7 alai padang', '081372931093', 'Aktif'),
('G0006', '8815006', 'dewi minerva', 'Perempuan', 'pelangi regency B,9 gunung pangilun', '082171883116', 'Aktif'),
('G0007', '8616007', 'elisdar', 'Perempuan', 'komp.rahaka griya permai blok E 6 L.buya', '085263373461', 'Aktif'),
('G0008', '8715008', 'dra.erniwati', 'Perempuan', 'komp.tarok Indah E/6 Balai baru', '081363495469', 'Aktif'),
('G0009', '8416009', 'nani kurniawati,S.pd', 'Perempuan', 'jln.linggar jati no .25 tabing', '085383424171', 'Aktif'),
('G0010', '8516010', 'mardi,spd', 'Laki-laki', 'kel.pasia nan tigo pasi sabalah RT 02 RW 01', '081374453102', 'Aktif'),
('G0011', '8516011', 'reni adriani,s.pd', 'Perempuan', 'jln.beringin  IV A no.7 lolong belanti', '082172220420', 'Aktif'),
('G0012', '8516012', 'gusti herawati,s.pd', 'Perempuan', 'jln.Limau manih ', '085274971907', 'Aktif'),
('G0013', '8715013', 'beti angreni,S.pd', 'Perempuan', 'Perum novel Indah B/7 S.sapih', '08126741950', 'Aktif'),
('G0014', '8615014', 'Hj.hawarniyetti,S.pd', 'Perempuan', 'pondok ranah  Minang c/7', '081267630299', 'Aktif'),
('G0015', '8416015', 'dwi ilona,S.Si', 'Perempuan', 'Taman Sakinah Blok E 14 L.buaya', '085274138210', 'Aktif'),
('G0016', '8715016', 'risma yetti,S.pd', 'Perempuan', 'jln.Raudah II No.9 Lapai padang', '081374200455', 'Aktif'),
('G0017', '8315017', 'Dra.dahlia erni ', 'Perempuan', 'aspol lolong blok PA II/4 pdg barat', '081363160155', 'Aktif'),
('G0018', '9115018', 'eka yuliana,S.E', 'Perempuan', 'jln.seb Panodang utara 2 No.299  ', '082392422124', 'Aktif'),
('G0019', '9015019', 'mardiati,S.pd', 'Perempuan', 'Komp.Kuala Nyiur 2 blok C/7', '085263911494', 'Aktif'),
('G0020', '8716020', 'yos indriani ,S.pd', 'Perempuan', 'Komplek belanti Indah B 4 G.pangilun', '08126726955', 'Aktif'),
('G0021', '8716021', 'widiana', 'Perempuan', 'jln.maransi indah no.19', '085272578528', 'Aktif'),
('G0022', '8115022', 'muskan,S.pd', 'Laki-laki', 'jln.Bakti ABRI No.1 RW 01 RT 01  BTK', '082388288209', 'Aktif'),
('G0023', '8316023', 'arif rizal,S.pd', 'Laki-laki', 'jln Ujung pandan No.55 A kel Olo', '081374614729', 'Aktif'),
('G0024', '8615024', 'riska septiani,S.pd', 'Perempuan', 'Jln lolongkaran RT.002 RW 002 kel.sungai sapih', '081270346198', 'Aktif'),
('G0025', '8915025', 'fitrisni', 'Laki-laki', 'tarandam VII no.16 Padang', '08126776240', 'Aktif');

-- --------------------------------------------------------

--
-- Table structure for table `hari`
--

CREATE TABLE IF NOT EXISTS `hari` (
  `id_h` int(5) NOT NULL AUTO_INCREMENT,
  `hari` varchar(25) NOT NULL,
  PRIMARY KEY (`id_h`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=117 ;

--
-- Dumping data for table `hari`
--

INSERT INTO `hari` (`id_h`, `hari`) VALUES
(111, 'Senin'),
(112, 'Selasa'),
(113, 'Rabu'),
(114, 'Kamis'),
(115, 'Jummat'),
(116, 'Sabtu');

-- --------------------------------------------------------

--
-- Table structure for table `jadwal_guru`
--

CREATE TABLE IF NOT EXISTS `jadwal_guru` (
  `kode_jadwal` int(5) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL,
  `kelas` varchar(10) NOT NULL,
  `kode_guru` varchar(50) NOT NULL,
  `nama_guru` varchar(50) NOT NULL,
  `matapelajaran` varchar(20) NOT NULL,
  `id_h` int(10) NOT NULL,
  `id_w` varchar(50) NOT NULL,
  PRIMARY KEY (`kode_jadwal`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=83 ;

--
-- Dumping data for table `jadwal_guru`
--

INSERT INTO `jadwal_guru` (`kode_jadwal`, `username`, `kelas`, `kode_guru`, `nama_guru`, `matapelajaran`, `id_h`, `id_w`) VALUES
(63, 'admin', 'VII 3', '8516010', 'mardi,spd', 'B.Inggris', 111, '08.00-08.40'),
(64, 'admin', 'VII 3', '8516010', 'mardi,spd', 'B.Inggris', 111, '08.40-09.20'),
(65, 'admin', 'VII 3', '8715008', 'dra.erniwati', 'B.Indonesia', 111, '09.20-10.00'),
(66, 'admin', 'VII 3', '8715008', 'dra.erniwati', 'B.Indonesia', 111, '10.30-11.10'),
(67, 'admin', 'VII 3', '8515005', 'rini susanty,S.IQ,S.pdi', 'PAI', 111, '11.10-11.50'),
(68, 'admin', 'VII 3', '8715016', 'risma yetti,S.pd', 'IPA', 111, '11.50-12.30'),
(69, 'admin', 'VII 3', '8715016', 'risma yetti,S.pd', 'IPA', 111, '12.30-13.10'),
(70, 'admin', 'VII 3', '8715008', 'dra.erniwati', 'B.Indonesia', 112, '07.00-07.40'),
(71, 'admin', 'VII 3', '8715008', 'dra.erniwati', 'B.Indonesia', 112, '07.40-08.20'),
(72, 'admin', 'VII 3', '8715008', 'dra.erniwati', 'B.Indonesia', 112, '08.20-09.00'),
(73, 'admin', 'VII 3', '8715013', 'beti angreni,S.pd', 'Matematika', 112, '09.00-09.40'),
(74, 'admin', 'VII 3', '8715013', 'beti angreni,S.pd', 'Matematika', 112, '10.10-10.50'),
(75, 'admin', 'VII 3', '8715013', 'beti angreni,S.pd', 'Matematika', 112, '10.50-11.30'),
(76, 'admin', 'VII 3', '8715002', 'alkamar', 'IPS', 112, '11.30-12.10'),
(77, 'admin', 'VII 3', '8715016', 'risma yetti,S.pd', 'IPA', 113, '07.00-07.40'),
(78, 'admin', 'VII 3', '8715016', 'risma yetti,S.pd', 'IPA', 113, '07.40-08.20'),
(79, 'admin', 'VII 3', '8715016', 'risma yetti,S.pd', 'IPA', 113, '08.20-09.00'),
(80, 'admin', 'VII 3', '8715013', 'beti angreni,S.pd', 'Matematika', 113, '09.00-09.40'),
(81, 'admin', 'VII 3', '8715013', 'beti angreni,S.pd', 'Matematika', 113, '10.10-10.50'),
(82, 'admin', 'VII 3', '8715013', 'beti angreni,S.pd', 'Matematika', 113, '10.50-11.30');

-- --------------------------------------------------------

--
-- Table structure for table `pelajaran`
--

CREATE TABLE IF NOT EXISTS `pelajaran` (
  `kode_pelajaran` char(4) NOT NULL,
  `nama_pelajaran` varchar(100) NOT NULL,
  `keterangan` varchar(100) NOT NULL,
  PRIMARY KEY (`kode_pelajaran`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pelajaran`
--

INSERT INTO `pelajaran` (`kode_pelajaran`, `nama_pelajaran`, `keterangan`) VALUES
('P001', 'PAI', 'Wajib'),
('P002', 'PKn', 'Wajib'),
('P003', 'B.Indonesia', 'Wajib'),
('P004', 'B.Inggris', 'Wajib'),
('P005', 'Matematika', 'Wajib'),
('P010', 'IPA', 'wajib'),
('P007', 'B.Inggris', 'Wajib'),
('P008', 'IPS', 'wajib'),
('P009', 'penjaskes', 'wajib'),
('P014', 'keterampilan', 'wajib'),
('P011', 'Seni Budaya', 'wajib'),
('P012', 'BK', 'wajib'),
('P013', 'TIK', 'wajib'),
('P015', 'BAM', 'wajib');

-- --------------------------------------------------------

--
-- Table structure for table `rb_login`
--

CREATE TABLE IF NOT EXISTS `rb_login` (
  `username` varchar(50) NOT NULL,
  `password` varchar(50) DEFAULT NULL,
  `nama_lengkap` varchar(50) NOT NULL,
  `induk` varchar(20) NOT NULL,
  `level` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `nohp` varchar(20) NOT NULL,
  `alamat` text NOT NULL,
  PRIMARY KEY (`username`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rb_login`
--

INSERT INTO `rb_login` (`username`, `password`, `nama_lengkap`, `induk`, `level`, `email`, `nohp`, `alamat`) VALUES
('admin', 'admin', 'Administrator', '', 'admin', 'admin@gmail.com', '082170214499', 'Jl.Sudirman 21 '),
('20150001', '12345', 'Indah Wahyuni', '', 'walikelas', 'Perempuan', '082170214495', 'Jl. Pala 1'),
('yaya', 'yaya', 'Nur Hidayah', '', 'walikelas', 'nurhidayah@gmail.com', '083177663448', 'Jl.Ujung Gurun No 56'),
('jaka', '12345', 'Jaka Hariyanto', '', 'walikelas', 'Laki-laki', '082170214495', 'Padang'),
('8815001', 'guru', 'syafril', '', 'walikelas', 'Laki-laki', '081363028758', 'jalan  kopi raya 17 '),
('8715002', 'guru', 'alkamar', '', 'walikelas', 'Laki-laki', '081277641520', 'jalan beringin 18 padang'),
('8616003', 'guru', 'sumiati', '', 'walikelas', 'Perempuan', '081364749310', 'komplek arai pinang ,jln merdeka 2 E/11 G.P'),
('8115004', 'guru', 'hayatul nismah', '', 'walikelas', 'Perempuan', '085272817666', 'komp.cendana Thp IV/A/ 2 air tawar'),
('8515005', 'guru', 'rini susanty,S.IQ,S.pdi', '', 'walikelas', 'Perempuan', '081372931093', 'jln.Kopi Raya no 7 alai padang'),
('8815006', 'guru', 'dewi minerva', '', 'walikelas', 'Perempuan', '082171883116', 'pelangi regency B,9 gunung pangilun'),
('8616007', 'guru', 'elisdar', '', 'walikelas', 'Perempuan', '085263373461', 'komp.rahaka griya permai blok E 6 L.buya'),
('8715008', 'guru', 'dra.erniwati', '', 'walikelas', 'Perempuan', '081363495469', 'komp.tarok Indah E/6 Balai baru'),
('8416009', 'guru', 'nani kurniawati,spd', '', 'walikelas', 'Perempuan', '085383424171', 'jln.linggar jati no .25 tabing'),
('8516010', 'guru', 'mardi,spd', '', 'walikelas', 'Laki-laki', '081374453102', 'kel.pasia nan tigo pasi sabalah RT 02 RW 01'),
('8516011', 'guru', 'reni adriani,s.pd', '', 'walikelas', 'Perempuan', '082172220420', 'jln.beringin  IV A no.7 lolong belanti'),
('8516012', 'guru', 'gusti herawati,s.pd', '', 'walikelas', 'Perempuan', '085274971907', 'jln.Limau manih '),
('8715013', 'guru', 'beti angreni,S.pd', '', 'walikelas', 'Perempuan', '08126741950', 'Perum novel Indah B/7 S.sapih'),
('8615014', 'guru', 'Hj.hawarniyetti,S.pd', '', 'walikelas', 'Perempuan', '081267630299', 'pondok ranah  Minang c/7'),
('8416015', 'guru', 'dwi ilona,S.Si', '', 'walikelas', 'Perempuan', '085274138210', 'Taman Sakinah Blok E 14 L.buaya'),
('8715016', 'guru', 'risma yetti,S.pd', '', 'walikelas', 'Perempuan', '081374200455', 'jln.Raudah II No.9 Lapai padang'),
('8315017', 'guru', 'Dra.dahlia erni ', '', 'walikelas', 'Perempuan', '081363160155', 'aspol lolong blok PA II/4 pdg barat'),
('9115018', 'guru', 'eka yuliana,S.E', '', 'walikelas', 'Perempuan', '082392422124', 'jln.seb Panodang utara 2 No.299  '),
('9015019', 'guru', 'mardiati,S.pd', '', 'walikelas', 'Perempuan', '085263911494', 'Komp.Kuala Nyiur 2 blok C/7'),
('8716020', 'guru', 'yos indriani ,S.pd', '', 'walikelas', 'Perempuan', '08126726955', 'Komplek belanti Indah B 4 G.pangilun'),
('8716021', 'guru', 'widiana', '', 'walikelas', 'Perempuan', '085272578528', 'jln.maransi indah no.19'),
('8115022', 'guru', 'muskan,S.pd', '', 'walikelas', 'Laki-laki', '082388288209', 'jln.Bakti ABRI No.1 RW 01 RT 01  BTK'),
('8316023', 'guru', 'arif rizal,S.pd', '', 'walikelas', 'Laki-laki', '081374614729', 'jln Ujung pandan No.55 A kel Olo'),
('8615024', 'guru', 'riska septiani,S.pd', '', 'walikelas', 'Perempuan', '081270346198', 'Jln lolongkaran RT.002 RW 002 kel.sungai sapih'),
('8915025', 'guru', 'mangatur lumbantoruan', '', 'walikelas', 'Laki-laki', '08126255236', 'prm tmn firdaus blok MJ/18 Padang sarai');

-- --------------------------------------------------------

--
-- Table structure for table `siswa`
--

CREATE TABLE IF NOT EXISTS `siswa` (
  `kode_siswa` char(5) NOT NULL,
  `nis` varchar(20) NOT NULL,
  `nama_siswa` varchar(100) NOT NULL,
  `kelamin` varchar(20) NOT NULL,
  `kelas` varchar(10) NOT NULL,
  `wali_kelas` varchar(50) NOT NULL,
  `agama` varchar(20) NOT NULL,
  `tempat_lahir` varchar(100) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `no_telepon` varchar(20) NOT NULL,
  `foto` varchar(100) NOT NULL,
  `tahun_angkatan` char(4) NOT NULL,
  `status` enum('Aktif','Lulus','Keluar') NOT NULL,
  PRIMARY KEY (`kode_siswa`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `siswa`
--

INSERT INTO `siswa` (`kode_siswa`, `nis`, `nama_siswa`, `kelamin`, `kelas`, `wali_kelas`, `agama`, `tempat_lahir`, `tanggal_lahir`, `alamat`, `no_telepon`, `foto`, `tahun_angkatan`, `status`) VALUES
('S0003', '03003', 'tasya chan', 'Perempuan', 'VII 3', 'riska septiani,S.pd', 'Islam', 'padang', '2003-01-09', 'jalan beringin 16 padang', '085288867904', 'S0003.tasya chan.jpg', '2016', 'Aktif'),
('S0002', '03002', 'devrian prayoga', 'Laki-laki', 'VII 3', 'riska septiani,S.pd', 'Islam', 'padang', '2003-06-06', 'Jln lolongkaran RT.005 RW 001 kel.sungai sapih', '085274799073', 'S0002.devrian prayoga.jpg', '2016', 'Aktif'),
('S0001', '03001', 'amisha rain', 'Perempuan', 'VII 3', 'riska septiani,S.pd', 'Islam', 'padang', '2004-01-01', 'jln.linggar jati no .40 tabing', '08527476665381', 'S0001.amisha.jpg', '2016', 'Aktif'),
('S0004', '03004', 'dea nabila simatupang', 'Perempuan', '0', '', 'Kristen', 'medan', '2003-09-22', 'komplek arai pinang ,jln merdeka 6 E/14 G.P', '085274988365', '', '2016', 'Aktif'),
('S0005', '03005', 'maryam marya', 'Perempuan', 'VII 3', 'riska septiani,S.pd', 'Islam', 'padang', '2003-06-22', 'jln.pondok kopi no 16', '0852758576565', 'S0005.mariyam marya.jpg', '2016', 'Aktif'),
('S0006', '03006', 'ega mawar ningsih', 'Perempuan', 'VII 3', 'riska septiani,S.pd', 'Islam', 'padang', '2003-01-28', 'jln.gadut no 35', '085263697793', 'S0006.ega mawar ningsih.jpg', '2016', 'Aktif');

-- --------------------------------------------------------

--
-- Table structure for table `tb_kelas`
--

CREATE TABLE IF NOT EXISTS `tb_kelas` (
  `kode_kelas` varchar(10) NOT NULL,
  `nama_kelas` varchar(20) NOT NULL,
  `wali_kelas` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_kelas`
--

INSERT INTO `tb_kelas` (`kode_kelas`, `nama_kelas`, `wali_kelas`) VALUES
('K001', 'VII 3', 'riska septiani,S.pd'),
('K002', 'VII 2', 'dra.erniwati'),
('K003', 'VII 1', 'beti angreni,S.pd'),
('K004', 'VIII 3', 'dwi ilona,S.Si'),
('K005', 'VIII 2', 'widiana'),
('K006', 'VIII 1', 'rini susanty,S.IQ,S.pdi'),
('K007', 'IX 3', 'yos indriani ,S.pd'),
('K008', 'IX 2', 'dewi minerva'),
('K009', 'IX 1', 'gusti herawati,s.pd');

-- --------------------------------------------------------

--
-- Table structure for table `waktu_j`
--

CREATE TABLE IF NOT EXISTS `waktu_j` (
  `id_w` int(5) NOT NULL AUTO_INCREMENT,
  `id_h` varchar(5) NOT NULL,
  `jamm` varchar(20) NOT NULL,
  PRIMARY KEY (`id_w`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=150 ;

--
-- Dumping data for table `waktu_j`
--

INSERT INTO `waktu_j` (`id_w`, `id_h`, `jamm`) VALUES
(111, '111', '08.00-08.40'),
(112, '111', '08.40-09.20'),
(113, '111', '09.20-10.00'),
(114, '111', '10.30-11.10'),
(115, '111', '11.10-11.50'),
(116, '111', '11.50-12.30'),
(117, '111', '12.30-13.10'),
(118, '112', '07.00-07.40'),
(119, '112', '07.40-08.20'),
(120, '112', '08.20-09.00'),
(121, '112', '09.00-09.40'),
(122, '112', '10.10-10.50'),
(123, '112', '10.50-11.30'),
(124, '112', '11.30-12.10'),
(125, '113', '07.00-07.40'),
(126, '113', '07.40-08.20'),
(127, '113', '08.20-09.00'),
(128, '113', '09.00-09.40'),
(129, '113', '10.10-10.50'),
(130, '113', '10.50-11.30'),
(131, '113', '11.30-12.10'),
(132, '114', '07.00-07.40'),
(133, '114', '07.40-08.20'),
(134, '114', '08.20-09.00'),
(135, '114', '09.00-09.40'),
(136, '114', '10.10-10.50'),
(137, '114', '10.50-11.30'),
(138, '114', '11.30-12.10'),
(139, '115', '07.00-07.50'),
(140, '115', '07.50-08.30'),
(141, '115', '08.30-09.10'),
(142, '115', '09.10-09.50'),
(143, '115', '10.10-10.50'),
(144, '115', '10.50-11.30'),
(145, '116', '07.00-07.40'),
(146, '116', '07.40-08.20'),
(147, '116', '08.20-09.00'),
(148, '116', '09.00-09.40'),
(149, '116', '10.10-10.50');
