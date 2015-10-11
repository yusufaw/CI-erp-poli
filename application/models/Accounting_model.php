<?php
class Accounting_model extends CI_Model
{
	function __contruct()
	{
		parent::__construct();
	}
	
	function daftar_gaji()
	{
		$query = $this->db->query("SELECT pe.id_penggajian, p.id_pegawai, p.nama, pe.hari_aktif, pe.cuti, pe.lembur, pe.total, pe.waktu_pengajuan, pe.waktu_diterima, pe.status_gaji FROM `penggajian` pe, `pegawai` p WHERE pe.id_pegawai=p.id_pegawai order by pe.id_penggajian desc");
		return $query; 
	}
	
	function daftar_pemasukan()
	{
		$query = $this->db->query("SELECT a.id_antrian, a.tarif, a.total_pembayaran, a.waktu_selesai, p.nama_pasien from antrian a, pasien p where a.id_pasien=p.id_pasien order by a.id_antrian");
		return $query; 
	}
	
	function daftar_pembelian()
	{
		$query = $this->db->query("SELECT po.id_pembelian, po.jumlah, po.harga, ob.nama_barang from pembelian_obat po, order_barang ob where po.order_barang=ob.id_barang order by po.id_pembelian desc");
		return $query; 
	}
	
	
	function detail_gaji($id_penggajian)
	{
		$query = $this->db->query("select p.nama, pe.total from pegawai p, penggajian pe where p.id_pegawai=pe.id_pegawai and pe.id_penggajian=".$id_penggajian );
		return $query;
	}
	
	function terima_gaji($id_penggajian){
		$data = array(
              'status_gaji'=>'2'
            );
		$this->db->where('id_penggajian', $id_penggajian);
		$this->db->set('waktu_diterima','now()', FALSE);
		$this->db->update('penggajian',$data);
		return $this->db->affected_rows() > 0;
	}
	
	function terima_barang($id_barang){
		$data = array(
              'status'=>'2'
            );
		$this->db->where('id_barang', $id_barang);
		$this->db->set('waktu_diterima','now()', FALSE);
		$this->db->update('order_barang',$data);
		return $this->db->affected_rows() > 0;
	}
	
	function tolak_gaji($id_penggajian){
		$data = array(
              'status_gaji'=>'3'
            );
		$this->db->where('id_penggajian', $id_penggajian);
		$this->db->set('waktu_diterima','now()', FALSE);
		$this->db->update('penggajian',$data);
		return $this->db->affected_rows() > 0;
	}
	
	function tolak_barang($id_barang){
		$data = array(
              'status'=>'3'
            );
		$this->db->where('id_barang', $id_barang);
		$this->db->set('waktu_diterima','now()', FALSE);
		$this->db->update('order_barang',$data);
		return $this->db->affected_rows() > 0;
	}
}
?>