<?php
class Warehouse_model extends CI_Model
{
	function __contruct()
	{
		parent::__construct();
	}
	
	function barang_tersedia(){
		$query = $this->db->query("select ob.id_barang, ob.nama_barang,ob.harga_satuan, ob.jumlah, sb.satuan_barang as satuan, jb.jenis_barang as jenis from order_barang ob, jenis_barang jb, satuan_barang sb where ob.jenis=jb.id_jenisbarang and ob.satuan=sb.id_satuanbarang and ob.status=2 order by ob.id_barang desc");
		return $query;
	}
	
	function update_barang($id_barang)
	{
		$data = array(
              'nama_barang'=>$this->input->post('nama_barang'),
			  'jenis'=>$this->input->post('jenis'),
			  'harga_satuan'=>$this->input->post('harga'),
            );
		$this->db->where('id_barang', $id_barang);
		$this->db->update('order_barang',$data);
		return $this->db->affected_rows() > 0;
	}
	
	
	function data_barang($id_barang){
		$query = $this->db->query("select * from order_barang where id_barang=".$id_barang);
		return $query;
	}
	
	function barang_order(){
		$query = $this->db->query("select * from order_barang order by id_barang desc");
		return $query;
	}
	
	function satuan_barang(){
		$query = $this->db->query("select * from satuan_barang");
		return $query;
	}
	
	function jenis_barang(){
		$query = $this->db->query("select * from jenis_barang");
		return $query;
	}
	
	function order_barang()
	{
		$data = array(
              'nama_barang'=>$this->input->post('nama'),
			  'jumlah'=>$this->input->post('stok'),
			  'satuan'=>$this->input->post('satuan_barang'),
			  'jenis'=>$this->input->post('jenis'),
			  'harga_satuan'=>$this->input->post('harga_satuan'),
			  'harga_total'=>($this->input->post('stok')*$this->input->post('harga_satuan')),
			  'status'=>1
            );
		$this->db->set('waktu_pengajuan', 'now()',FALSE);
		$this->db->insert('order_barang',$data);
		return $this->db->affected_rows() > 0;
	}
}
?>