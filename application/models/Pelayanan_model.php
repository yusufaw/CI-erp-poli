<?php
class Pelayanan_model extends CI_Model
{
	function __contruct()
	{
		parent::__construct();
	}
	function hapus_pasien($id_pasien)
	{
		$this->db->where("id_pasien", $id_pasien);
    	$this->db->delete("pasien");
		return $this->db->affected_rows();
	}
	
	function tambah_pasien() {
		$this->load->helper('date');
		
		$data=array(
		'nama_pasien'=>$this->input->post('nama'),
		'pekerjaan'=>$this->input->post('pekerjaan'),
		'alamat'=>$this->input->post('alamat'),
		
		);
		$this->db->set('tanggal_daftar','NOW()', FALSE);
		$this->db->insert('pasien',$data);
		return $this->db->affected_rows()>0;
	}
	
	function tambah_antrian($id_pasien) {
		$this->load->helper('date');
		$query = $this->db->query("select no_antrian from antrian order by no_antrian desc limit 1");
		$terkahir = $query->row()->no_antrian;
		$data=array(
		'id_pasien'=>$id_pasien,
		'no_antrian'=>($terkahir+1)
		);
		$this->db->set('waktu_antri','NOW()', FALSE);
		$this->db->insert('antrian',$data);
		return $this->db->affected_rows()>0;
	}
	
	
	function update_pasien($id_pasien)
	{
		$data = array(
              'nama_pasien'=>$this->input->post('nama'),
			  'pekerjaan'=>$this->input->post('pekerjaan'),
			  'alamat'=>$this->input->post('alamat'),
			  
            );
		$this->db->where('id_pasien', $id_pasien);
		$this->db->update('pasien',$data);
		return $this->db->affected_rows() > 0;
	}

	function hapus_antrian($id_antrian)
	{
		$data = array(
              'status'=>1,
			  'total_pembayaran'=>$this->input->post('harga_total'),
			  'tarif'=>$this->input->post('tarif'),
			  
            );
		$this->db->where('id_antrian', $id_antrian);
		$this->db->set('waktu_selesai','NOW()', FALSE);
		$this->db->update('antrian',$data);
		return $this->db->affected_rows() > 0;
	}
	
	function daftar_obat(){
		$query = $this->db->query("select * from order_barang where jenis=1");
		return $query;	
	}
	
	function detail_obat($id_barang){
		$query = $this->db->query("select * from order_barang where jenis=1 and id_barang=".$id_barang);
		return $query;	
	}

	function getDaftar_pasien($id_pasien){
		$query = $this->db->query("select id_pasien, nama_pasien, pekerjaan, alamat from pasien where id_pasien=".$id_pasien);
		return $query;	
	}
	
	function selesai_obat($id_antrian){
		$array=$this->input->post('ok');
		for($i=0;$i<count($array);$i++){
			$data=json_decode($array[$i], TRUE);
			$this->db->insert('pembelian_obat',json_decode($array[$i], TRUE));
			//foreach ($data['ok'] as $key) {
				//$this->update_jumlah($data['ok']->order_barang,$data['ok']->jumlah);
			//}
			$query = $this->db->query("select jumlah from order_barang where id_barang=".$data[0]['order_barang']);
			$x = $query->row()->jumlah;
			$y = $x-($data[0]['jumlah']);
			$jumlah = array('jumlah'=>$y);
			$this->db->where('id_barang', $id_barang);
			$this->db->update('order_barang',$jumlah);
			
		}
		
		return json_decode($array);
	}
	
	function update_jumlah($id_barang, $jum){
		$query = $this->db->query("select jumlah from order_barang where id_barang=".$id_barang);
			$x = $query->row()->jumlah;
			$y = $x-$jum;
			$jumlah = array('jumlah'=>$y);
			$this->db->where('id_barang', $id_barang);
			$this->db->update('order_barang',$jumlah);
	}
	
	function getDaftar_antrian($id_antrian){
		$query = $this->db->query("select a.no_antrian, a.waktu_antri, a.id_pasien, p.nama_pasien, pe.nama_pekerjaan from pekerjaan pe, antrian a, pasien p where p.pekerjaan=pe.id_pekerjaan and a.id_pasien = p.id_pasien and  a.id_antrian=".$id_antrian);
		return $query;	 
	}
	
	function daftar_antrian(){
		$query = $this->db->query("select a.id_antrian, a.no_antrian,a.waktu_antri, a.id_pasien, p.nama_pasien from antrian a, pasien p where a.id_pasien = p.id_pasien and a.status=0");
		return $query;	
	}
	
	function semua_pekerjaan(){
		$query = $this->db->query("select * from pekerjaan");
		return $query;
	}
	
	function nama_pasien($id_pasien)
	{
		$query = $this->db->query("select id_pasien, nama_pasien from pasien where id_pasien=".$id_pasien);
		return $query;
	}
	function daftar_pasien()
	{
		$query = $this->db->query("select pa.id_pasien, pa.nama_pasien, pe.nama_pekerjaan as pekerjaan, pa.alamat, pa.tanggal_daftar from pasien pa, pekerjaan pe where pa.pekerjaan=pe.id_pekerjaan order by pa.id_pasien");
		return $query; 
	}
}
?>