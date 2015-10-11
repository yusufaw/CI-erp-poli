-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 30 Sep 2014 pada 23.49
-- Versi Server: 5.6.16
-- PHP Version: 5.5.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `poliklinik`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `antrian`
--

CREATE TABLE IF NOT EXISTS `antrian` (
  `id_antrian` int(11) NOT NULL AUTO_INCREMENT,
  `no_antrian` int(11) NOT NULL,
  `id_pasien` int(11) NOT NULL,
  `waktu_antri` datetime NOT NULL,
  `waktu_selesai` datetime NOT NULL,
  `status` int(11) NOT NULL,
  `tarif` varchar(15) NOT NULL,
  `total_pembayaran` varchar(15) NOT NULL,
  PRIMARY KEY (`id_antrian`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data untuk tabel `antrian`
--

INSERT INTO `antrian` (`id_antrian`, `no_antrian`, `id_pasien`, `waktu_antri`, `waktu_selesai`, `status`, `tarif`, `total_pembayaran`) VALUES
(9, 2, 4, '2014-07-01 10:04:48', '2014-07-01 10:10:21', 1, '0', '0');

-- --------------------------------------------------------

--
-- Struktur dari tabel `authorization`
--

CREATE TABLE IF NOT EXISTS `authorization` (
  `username` varchar(15) NOT NULL,
  `id_pegawai` int(10) unsigned NOT NULL,
  `password` varchar(50) NOT NULL,
  `modul` int(10) unsigned NOT NULL,
  PRIMARY KEY (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `authorization`
--

INSERT INTO `authorization` (`username`, `id_pegawai`, `password`, `modul`) VALUES
('bambang', 6, 'bambang', 5),
('budi', 2, 'budi', 2),
('citra', 3, 'citra', 2),
('dany', 5, 'dany', 3),
('ucup', 1, 'ucup', 1),
('yoke', 4, 'yoke', 4);

-- --------------------------------------------------------

--
-- Struktur dari tabel `daftar_barang`
--

CREATE TABLE IF NOT EXISTS `daftar_barang` (
  `id_barang` int(11) NOT NULL AUTO_INCREMENT,
  `nama_barang` varchar(50) NOT NULL,
  `stok` int(11) NOT NULL,
  `satuan` int(11) NOT NULL,
  `jenis` int(11) NOT NULL,
  `harga` varchar(20) NOT NULL,
  PRIMARY KEY (`id_barang`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `departemen`
--

CREATE TABLE IF NOT EXISTS `departemen` (
  `id_departemen` int(11) NOT NULL AUTO_INCREMENT,
  `nama_departemen` varchar(30) NOT NULL,
  PRIMARY KEY (`id_departemen`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data untuk tabel `departemen`
--

INSERT INTO `departemen` (`id_departemen`, `nama_departemen`) VALUES
(1, 'Pelayanan'),
(2, 'Warehouse'),
(3, 'Hr'),
(4, 'Accounting');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jabatan`
--

CREATE TABLE IF NOT EXISTS `jabatan` (
  `id_jabatan` int(11) NOT NULL AUTO_INCREMENT,
  `nama_jabatan` varchar(30) NOT NULL,
  PRIMARY KEY (`id_jabatan`),
  UNIQUE KEY `nama_jabatan` (`nama_jabatan`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data untuk tabel `jabatan`
--

INSERT INTO `jabatan` (`id_jabatan`, `nama_jabatan`) VALUES
(1, 'Admin'),
(2, 'Pegawai');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jenis_barang`
--

CREATE TABLE IF NOT EXISTS `jenis_barang` (
  `id_jenisbarang` int(11) NOT NULL AUTO_INCREMENT,
  `jenis_barang` varchar(30) NOT NULL,
  PRIMARY KEY (`id_jenisbarang`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data untuk tabel `jenis_barang`
--

INSERT INTO `jenis_barang` (`id_jenisbarang`, `jenis_barang`) VALUES
(1, 'obat'),
(2, 'alat');

-- --------------------------------------------------------

--
-- Struktur dari tabel `modul`
--

CREATE TABLE IF NOT EXISTS `modul` (
  `id_modul` int(11) NOT NULL AUTO_INCREMENT,
  `nama_modul` varchar(30) NOT NULL,
  PRIMARY KEY (`id_modul`),
  UNIQUE KEY `nama_modul` (`nama_modul`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data untuk tabel `modul`
--

INSERT INTO `modul` (`id_modul`, `nama_modul`) VALUES
(4, 'Accounting'),
(3, 'HR'),
(1, 'Pelayanan'),
(5, 'Super_Admin'),
(2, 'Warehouse');

-- --------------------------------------------------------

--
-- Struktur dari tabel `order_barang`
--

CREATE TABLE IF NOT EXISTS `order_barang` (
  `id_barang` int(11) NOT NULL AUTO_INCREMENT,
  `nama_barang` varchar(50) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `satuan` int(11) NOT NULL,
  `jenis` int(11) NOT NULL,
  `harga_satuan` varchar(15) NOT NULL,
  `harga_total` varchar(15) NOT NULL,
  `waktu_pengajuan` date NOT NULL,
  `waktu_diterima` date NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id_barang`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data untuk tabel `order_barang`
--

INSERT INTO `order_barang` (`id_barang`, `nama_barang`, `jumlah`, `satuan`, `jenis`, `harga_satuan`, `harga_total`, `waktu_pengajuan`, `waktu_diterima`, `status`) VALUES
(1, 'Amoxilin', 50, 0, 2, '20000', '0', '2014-06-30', '0000-00-00', 2),
(2, 'Budrexs', 3, 0, 1, '7500', '0', '2014-06-30', '0000-00-00', 2),
(3, 'Panadol', 6, 1, 1, '70000', '0', '2014-06-30', '2014-06-30', 2),
(4, 'Cek', 78, 1, 2, '90000', '7020000', '2014-06-30', '2014-06-30', 3),
(5, 'Paramex', 500, 3, 1, '5000', '2500000', '2014-06-30', '2014-06-30', 3),
(6, 'Kursi', 25, 1, 2, '100000', '2500000', '2014-06-30', '2014-07-01', 2),
(7, 'Pimtrakol', 50, 3, 1, '8000', '400000', '2014-06-30', '2014-06-30', 2),
(8, 'Oxadon', 120, 1, 1, '12000', '1440000', '2014-07-01', '2014-07-01', 2),
(9, 'suntik', 3, 2, 2, '15000', '45000', '2014-07-01', '0000-00-00', 1),
(10, 'bantal', 100, 1, 2, '15000', '1500000', '2014-07-01', '0000-00-00', 1),
(11, 'guling', 50, 1, 2, '15000', '750000', '2014-07-01', '0000-00-00', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pasien`
--

CREATE TABLE IF NOT EXISTS `pasien` (
  `id_pasien` int(11) NOT NULL AUTO_INCREMENT,
  `nama_pasien` varchar(50) NOT NULL,
  `pekerjaan` int(1) NOT NULL,
  `alamat` varchar(200) NOT NULL,
  `tanggal_daftar` date NOT NULL,
  PRIMARY KEY (`id_pasien`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data untuk tabel `pasien`
--

INSERT INTO `pasien` (`id_pasien`, `nama_pasien`, `pekerjaan`, `alamat`, `tanggal_daftar`) VALUES
(1, 'Joni', 1, 'Surabaya', '2014-06-12'),
(2, 'Soekarwo', 1, 'Madura, Jawa Timur', '2014-06-30'),
(4, 'Soekarno', 4, 'Mojokerto, Indonesia', '2014-06-30'),
(5, 'Citra K', 2, 'Blitar', '2014-06-30'),
(6, '0', 0, '0', '2014-06-30'),
(7, 'Kusuma', 1, 'Surabaya', '2014-06-30'),
(8, 'Dewi', 3, 'Malang', '2014-06-30'),
(9, 'Budi', 2, 'Kesamben, Blitar', '2014-06-30');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pegawai`
--

CREATE TABLE IF NOT EXISTS `pegawai` (
  `id_pegawai` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(50) NOT NULL,
  `alamat` varchar(100) DEFAULT NULL,
  `telepon` varchar(15) DEFAULT NULL,
  `status_pegawai` int(10) unsigned NOT NULL,
  `jabatan` int(10) unsigned NOT NULL,
  `departemen` int(10) unsigned NOT NULL,
  `gaji` varchar(20) NOT NULL,
  `tanggal_masuk` date NOT NULL,
  `tanggal_keluar` date NOT NULL,
  `foto` varchar(30) NOT NULL,
  PRIMARY KEY (`id_pegawai`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Dumping data untuk tabel `pegawai`
--

INSERT INTO `pegawai` (`id_pegawai`, `nama`, `alamat`, `telepon`, `status_pegawai`, `jabatan`, `departemen`, `gaji`, `tanggal_masuk`, `tanggal_keluar`, `foto`) VALUES
(1, 'Yusuf Aji Wibowo', 'Jalan Gajayana Gang III C No 561 Kota Malang', '082134335134', 1, 1, 1, '10', '2013-03-03', '2016-04-02', 'ucup.jpg'),
(2, 'Budi Setiawan', 'Jalan Soekarno Hatta No 131 Kota Malang', '082134335134', 2, 2, 2, '200000', '2014-04-06', '2014-08-09', 'raku.jpg'),
(3, 'Citra Kusuma Dewi', 'Jalan Sumbersari No 131 Kota Malang', '082134335134', 1, 1, 2, '240000', '2014-04-06', '2014-08-09', 'hinata.jpg'),
(4, 'Yoke Kusuma Arbawa', 'Jalan Soekarno Hatta No 64 Kota Malang', '082134335134', 1, 1, 3, '500000', '2014-04-06', '2014-08-09', 'tsukishima.jpg'),
(5, 'Yudistya Dany Pradana', 'Jalan Gajayana No 23 Kota Malang', '082134335134', 1, 1, 3, '340000', '2014-04-06', '2014-08-09', 'kuroko.jpg'),
(6, 'Bambang Saputra', 'Jalan Bandung No 321 Kota Surabaya', '08572441145', 2, 1, 4, '300000000', '2013-08-13', '2015-04-16', 'bambang.jpg'),
(10, 'Yukihiro Matsumoto', 'Jalan Naruto gang III, Tokyo City', '633333333', 1, 1, 1, '12333', '2016-03-02', '2021-09-03', ''),
(11, 'Dan Moran', 'Washington University in St. Louis', '5444444444', 2, 2, 4, '344444444', '2002-11-03', '2016-11-30', ''),
(12, 'Guido van Rossum', 'he University of Amsterdam, Belanda', '4444444444', 1, 2, 1, '222222222', '2013-08-01', '2017-10-06', ''),
(13, 'Percobaan', 'jakfjak', '0909', 1, 1, 1, '8888888', '2014-12-01', '2015-01-01', 'Percobaan.jpg'),
(14, 'aPAH', 'KJASFKJ', '8989', 1, 1, 1, '8989', '2014-01-01', '2015-01-01', 'aPAH.jpg'),
(15, 'Mas Joko', 'Ngawi', '787878', 1, 1, 1, '9898', '2014-01-01', '2015-01-01', 'MasJoko.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pekerjaan`
--

CREATE TABLE IF NOT EXISTS `pekerjaan` (
  `id_pekerjaan` int(11) NOT NULL AUTO_INCREMENT,
  `nama_pekerjaan` varchar(15) NOT NULL,
  PRIMARY KEY (`id_pekerjaan`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data untuk tabel `pekerjaan`
--

INSERT INTO `pekerjaan` (`id_pekerjaan`, `nama_pekerjaan`) VALUES
(1, 'Dosen'),
(2, 'Mahasiswa'),
(3, 'Karyawan'),
(4, 'Petani'),
(5, 'Pedagang'),
(6, 'PNS');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pembelian_obat`
--

CREATE TABLE IF NOT EXISTS `pembelian_obat` (
  `id_pembelian` int(11) NOT NULL AUTO_INCREMENT,
  `id_antrian` int(11) NOT NULL,
  `order_barang` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `harga` varchar(15) NOT NULL,
  PRIMARY KEY (`id_pembelian`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=40 ;

--
-- Dumping data untuk tabel `pembelian_obat`
--

INSERT INTO `pembelian_obat` (`id_pembelian`, `id_antrian`, `order_barang`, `jumlah`, `harga`) VALUES
(33, 28, 5, 5, '25000'),
(34, 29, 3, 7, '490000'),
(35, 29, 3, 5, '350000'),
(36, 29, 5, 4, '20000'),
(37, 29, 5, 4, '20000'),
(38, 29, 5, 5, '25000'),
(39, 29, 5, 4, '20000');

-- --------------------------------------------------------

--
-- Struktur dari tabel `penggajian`
--

CREATE TABLE IF NOT EXISTS `penggajian` (
  `id_penggajian` int(11) NOT NULL AUTO_INCREMENT,
  `id_pegawai` int(11) NOT NULL,
  `hari_aktif` int(11) NOT NULL,
  `cuti` int(11) NOT NULL,
  `lembur` int(11) NOT NULL,
  `total` varchar(15) NOT NULL,
  `waktu_pengajuan` date NOT NULL,
  `waktu_diterima` date NOT NULL DEFAULT '0000-00-00',
  `status_gaji` int(11) NOT NULL,
  PRIMARY KEY (`id_penggajian`,`id_pegawai`,`waktu_diterima`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=18 ;

--
-- Dumping data untuk tabel `penggajian`
--

INSERT INTO `penggajian` (`id_penggajian`, `id_pegawai`, `hari_aktif`, `cuti`, `lembur`, `total`, `waktu_pengajuan`, `waktu_diterima`, `status_gaji`) VALUES
(4, 2, 30, 0, 0, '200000', '0000-00-00', '2014-06-29', 2),
(5, 10, 30, 0, 0, '12333', '0000-00-00', '0000-00-00', 2),
(6, 6, 30, 5, 10, '350000000', '0000-00-00', '2014-06-30', 3),
(7, 2, 30, 9, 4, '166666.66666667', '0000-00-00', '0000-00-00', 3),
(12, 15, 22, 0, 9, '13947.181818182', '0000-00-00', '2014-06-29', 2),
(13, 3, 22, 0, 0, '240000', '2014-06-30', '2014-06-30', 2),
(14, 2, 22, 0, 0, '200000', '2014-06-30', '2014-06-30', 3),
(15, 10, 22, 0, 0, '12333', '2014-06-30', '2014-07-01', 2),
(16, 1, 30, 0, 0, '10', '2014-06-30', '2014-06-30', 3),
(17, 1, 30, 0, 0, '10', '2014-06-30', '2014-06-30', 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `satuan_barang`
--

CREATE TABLE IF NOT EXISTS `satuan_barang` (
  `id_satuanbarang` int(11) NOT NULL AUTO_INCREMENT,
  `satuan_barang` varchar(30) NOT NULL,
  PRIMARY KEY (`id_satuanbarang`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data untuk tabel `satuan_barang`
--

INSERT INTO `satuan_barang` (`id_satuanbarang`, `satuan_barang`) VALUES
(1, 'buah'),
(2, 'lusin'),
(3, 'dos');

-- --------------------------------------------------------

--
-- Struktur dari tabel `status_gaji`
--

CREATE TABLE IF NOT EXISTS `status_gaji` (
  `id_status_gaji` int(11) NOT NULL AUTO_INCREMENT,
  `nama_status` varchar(15) NOT NULL,
  PRIMARY KEY (`id_status_gaji`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data untuk tabel `status_gaji`
--

INSERT INTO `status_gaji` (`id_status_gaji`, `nama_status`) VALUES
(1, 'Belum Diproses'),
(2, 'Diterima'),
(3, 'Ditolak');

-- --------------------------------------------------------

--
-- Struktur dari tabel `status_pegawai`
--

CREATE TABLE IF NOT EXISTS `status_pegawai` (
  `id_status_pegawai` int(11) NOT NULL AUTO_INCREMENT,
  `nama_status_pegawai` varchar(20) NOT NULL,
  PRIMARY KEY (`id_status_pegawai`),
  UNIQUE KEY `nama_status_pegawai` (`nama_status_pegawai`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data untuk tabel `status_pegawai`
--

INSERT INTO `status_pegawai` (`id_status_pegawai`, `nama_status_pegawai`) VALUES
(1, 'Aktif Tetap'),
(2, 'Aktif Tidak Tetap'),
(3, 'Tidak Aktif');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
