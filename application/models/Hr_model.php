<?php
class Hr_model extends CI_Model
{
	function __contruct()
	{
		parent::__construct();
	}
	
	function daftar_pegawai()
	{
		$query = $this->db->query("select p.id_pegawai, p.nama, p.alamat, p.telepon, sp.nama_status_pegawai as status, j.nama_jabatan as jabatan, d.nama_departemen as departemen, p.gaji, p.tanggal_masuk, p.tanggal_keluar, p.foto from pegawai p, status_pegawai sp, jabatan j, departemen d where p.status_pegawai = sp.id_status_pegawai and p.jabatan = j.id_jabatan and p.departemen = d.id_departemen order by p.id_pegawai");
		return $query; 
	}
	
	function daftar_gaji()
	{
		$query = $this->db->query("SELECT pe.id_penggajian, p.id_pegawai, p.nama, pe.hari_aktif, pe.cuti, pe.lembur, pe.total, pe.waktu_pengajuan, pe.waktu_diterima, sg.nama_status as status FROM `penggajian` pe, `pegawai` p, `status_gaji` sg WHERE pe.id_pegawai=p.id_pegawai and pe.status_gaji=sg.id_status_gaji order by pe.id_penggajian desc");
		return $query; 
	}
	
	function gaji_pegawai($id_pegawai){
		$query = $this->db->query("select gaji from pegawai where id_pegawai=".$id_pegawai);
		$gaji_reguler = $query->row()->gaji;
		$hari_aktif = $this->input->post('hari_aktif');
		$cuti = $this->input->post('cuti');
		$lembur = $this->input->post('lembur');
		$total = ($hari_aktif-$cuti+$lembur)/$hari_aktif*$gaji_reguler;
		$data = array(
              'id_pegawai'=>$id_pegawai,
			  'hari_aktif'=>$hari_aktif,
			  'cuti'=>$cuti,
			  'lembur'=>$lembur,
			  'total'=>$total,
			  'status_gaji'=>'1'
            );
        $this->db->set('waktu_pengajuan', 'now()', FALSE);
		$this->db->insert('penggajian',$data);
		return $this->db->affected_rows() > 0;
	}
	
	function detail_gaji($id_pegawai)
	{
		$query = $this->db->query("select id_pegawai, nama, gaji from pegawai where id_pegawai=".$id_pegawai);
		return $query;
	}
	
	function nama_pegawai($id_pegawai)
	{
		$query = $this->db->query("select id_pegawai, nama from pegawai where id_pegawai=".$id_pegawai);
		return $query;
	}
	
	function detail_pegawai($id_pegawai)
	{
		$query = $this->db->query("select * from pegawai where id_pegawai='".$id_pegawai."'");
		return $query;
	}
	
	function status_pegawai($id_pegawai){
		$query = $this->db->query("select status_pegawai from pegawai where id_pegawai='".$id_pegawai."'");
		return $query;
	}
	
	function jabatan_pegawai($id_pegawai){
		$query = $this->db->query("select jabatan from pegawai where id_pegawai='".$id_pegawai."'");
		return $query;
	}
	
	function departemen_pegawai($id_pegawai){
		$query = $this->db->query("select departemen from pegawai where id_pegawai='".$id_pegawai."'");
		return $query;
	}
	
	function semua_status()
	{
		$query = $this->db->query("select * from status_pegawai");
		return $query;
	}
	
	function semua_jabatan()
	{
		$query = $this->db->query("select * from jabatan");
		return $query;
	}
	
	function semua_departemen()
	{
		$query = $this->db->query("select * from departemen");
		return $query;
	}
	
	function hapus_pegawai($id_pegawai)
	{
		$this->db->where("id_pegawai", $id_pegawai);
    	$this->db->delete("pegawai");
		return $this->db->affected_rows();
	}
	
	function update_pegawai($id_pegawai)
	{
		$data = array(
              'nama'=>$this->input->post('nama'),
			  'alamat'=>$this->input->post('alamat'),
			  'telepon'=>$this->input->post('telepon'),
			  'status_pegawai'=>$this->input->post('status_pegawai'),
			  'jabatan'=>$this->input->post('jabatan'),
			  'departemen'=>$this->input->post('departemen'),
			  'gaji'=>$this->input->post('gaji'),
			  'tanggal_masuk'=>$this->input->post('tanggal_masuk'),
			  'tanggal_keluar'=>$this->input->post('tanggal_keluar'),
            );
		$this->db->where('id_pegawai', $id_pegawai);
		$this->db->update('pegawai',$data);
		return $this->db->affected_rows() > 0;
	}
	
	function tambah_pegawai($foto)
	{
		$data = array(
              'nama'=>$this->input->post('nama'),
			  'alamat'=>$this->input->post('alamat'),
			  'telepon'=>$this->input->post('telepon'),
			  'status_pegawai'=>$this->input->post('status_pegawai'),
			  'jabatan'=>$this->input->post('jabatan'),
			  'departemen'=>$this->input->post('departemen'),
			  'gaji'=>$this->input->post('gaji'),
			  'tanggal_masuk'=>$this->input->post('tanggal_masuk'),
			  'tanggal_keluar'=>$this->input->post('tanggal_keluar'),
			  'foto'=>$foto
            );
		$this->db->insert('pegawai',$data);
		return $this->db->affected_rows() > 0;
	}
}
?>