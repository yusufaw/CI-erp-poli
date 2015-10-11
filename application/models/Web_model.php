<?php
class web_model extends CI_Model
{
	function __contruct()
	{
		parent::__construct();
	}
	
	function data_login($user, $pass)
	{
		$user_bersih = mysql_real_escape_string($user);
		$pass_bersih = mysql_real_escape_string($pass);
		$query = $this->db->query("select * from authorization where username='$user_bersih' and password='$pass_bersih'");
		return $query;
	}
	
	function detail_pegawai($id_pegawai)
	{
		$query = $this->db->query("select * from pegawai where id_pegawai='$id_pegawai'");
		return $query;
	}
	
	function nama_modul($id_modul)
	{
		$query = $this->db->query("select nama_modul from modul where id_modul='$id_modul'");
		$hasil = $query->row()->nama_modul;
		return $hasil; 
	}
}
?>