<?php if(!defined('BASEPATH'))	exit('No direct script access allowed');

class Pelayanan extends CI_Controller {
	function __contruct()
	{
		parent::__construct();
		$this->load->helper(array('url', 'form'));
		$this->load->model('Pelayanan_model');
	}
	function tambah_pasien(){
		$data=$this->Pelayanan_model->tambah_pasien();
		if($data)
		{
			?>
			<script type="text/javascript" language="javascript">
				alert("Tambah Pasien Berhasil");
			</script>
			<?php
			echo "<meta http-equiv='refresh' content='0; url=".base_url()."pelayanan/'>";
		}
	}
	
	function tambah_antrian($id_pasien){
		$data=$this->Pelayanan_model->tambah_antrian($id_pasien);
		if($data)
		{
			?>
			<script type="text/javascript" language="javascript">
				alert("Tambah Antrian Berhasil");
			</script>
			<?php
			echo "<meta http-equiv='refresh' content='0; url=".base_url()."pelayanan/antrian'>";
		}
	}
	
	function daftar_pasien(){
		$s = $this->session->userdata('user_login');
		if($session=isset($s)){
			$session=$s;
			$daftar_pasien = $this->Pelayanan_model->daftar_pasien();
			foreach($daftar_pasien->result() as $items){
				$data["daftar_pasien"][]=$items;
			}
			$this->load->vars($data);	
		}else{
			$session='';
		}
	}
	
	function daftar_antrian(){
		$s = $this->session->userdata('user_login');
		$session=isset($s) ? $s:'';
		if($session!="")
		{
			$daftar_antrian = $this->Pelayanan_model->daftar_antrian();
			foreach($daftar_antrian->result() as $items){
				$data["daftar_antrian"][]=$items;
			}
			$this->load->vars($data);	
		}
	}
	
	
	function update_pasien($id_pasien)
	{
		$data=$this->Pelayanan_model->update_pasien($id_pasien);
		if($data)
		{
			 ?>
			 <script type="text/javascript" language="javascript">
				alert("Update Pegawai Berhasil");
			</script>
			 <?php
		}
	}
	
	function hapus_antrian($id_antrian)
	{
		$data=$this->Pelayanan_model->hapus_antrian($id_antrian);
		if($data)
		{
			 ?>
			 <script type="text/javascript" language="javascript">
				alert("Berhasil hore");
			</script>
			 <?php
		}
	}
	
	function getDaftarAntrian($id_pasien)
	{
		$data_pasien = $this->Pelayanan_model->getDaftar_antrian($id_pasien);
		foreach($data_pasien->result() as $items){
			$data[]=$items;
		}
		header('content-type:application/json');
		echo json_encode($data);
	}
	
	
	function getDaftarPasien($id_pasien)
	{
		$data_pasien = $this->Pelayanan_model->getDaftar_pasien($id_pasien);
		foreach($data_pasien->result() as $items){
			$data[]=$items;
		}
		header('content-type:application/json');
		echo json_encode($data);
	}
	
	function getSemuaPekerjaan(){
		$semua_pekerjaan = $this->Pelayanan_model->semua_pekerjaan();
		foreach($semua_pekerjaan->result() as $items){
				$data["semua_pekerjaan"][] = $items;
		}
		$this->load->vars($data);
	}
	function hapus_pasien($id_pasien)
	{
		$data=$this->Pelayanan_model->hapus_pasien($id_pasien);
		echo $data;
		if($data)
		{
			?>
			<script type="text/javascript" language="javascript">
				alert("Hapus Pasien Berhasil");
			</script>
			<?php
		}
	}
	function getNamaPasien($id_pasien)
	{
		$data_nama = $this->Pelayanan_model->nama_pasien($id_pasien);
			foreach($data_nama->result() as $items){
				$data[]=$items;
			}
		header('content-type:application/json');
		echo json_encode($data);
	}
	
	function daftar_obat()
	{
		$data_pasien = $this->Pelayanan_model->daftar_obat();
		foreach($data_pasien->result() as $items){
			$data[]=$items;
		}
		header('content-type:application/json');
		echo json_encode($data);
	}

	function index()
	{
		$s = $this->session->userdata('user_login');
		$session=isset($s) ? $s:'';
		if($session!="")
		{
			$pecah=explode("|",$session);
			$data["username"] = $pecah[0];
			$data["id_pegawai"] = $pecah[1];
			$data["modul"] = $pecah[2];
			$pegawai = $this->Web_model->detail_pegawai($data['id_pegawai']);
			foreach($pegawai->result() as $items){
				$data["nama_pegawai"] = $items->nama;
				$data["foto"] = $items->foto;
			}
			$data["nama_modul"]="Pelayanan";
			$data["menu_kiri1"]="Daftar Pasien";
			$data["menu_kiri2"]="Antrian Pasien";
			$data["link_kiri1"]="index.php/pelayanan";
			$data["link_kiri2"]="index.php/pelayanan/antrian";
			$this->load->vars($data);
			$this->daftar_pasien();
			$this->getSemuaPekerjaan();
			$this->load->view('atas');
			if ($data["modul"]=="1" || $data["modul"]=="5") {
				$this->load->view('kiri');
				$this->load->view('pelayanan/index');
			} else {	
				$this->load->view('not_permission');
			}
			$this->load->view('bawah');
		}
		else
		{
			?>
			<script type="text/javascript" language="javascript">
			alert("Anda belum Log In...!!!\nAnda harus Log In untuk mengakses halaman ini...!!!");
			</script>
			<?php
			echo "<meta http-equiv='refresh' content='0; url=".base_url()."'>"; 
			
		}	
	}

	function detail_obat($id_barang)
	{
		$data_obat = $this->Pelayanan_model->detail_obat($id_barang);
		foreach($data_obat->result() as $items){
			$data[]=$items;
		}
		header('content-type:application/json');
		echo json_encode($data);
	}
	
	function update_jumlah($id_barang, $jum)
	{
		$data_obat = $this->Pelayanan_model->update_jumlah($id_barang,$jum);
		
	}
	
	function selesai_obat($id_antrian)
	{
		$data_obat=$this->Pelayanan_model->selesai_obat($id_antrian);
		// echo $data;
		// if($data)
		// {
			// ?>
			// <script type="text/javascript" language="javascript">
				// alert("Berhasil Hore");
			// </script>
			// <?php
		// }
		// foreach($data_obat->result() as $items){
			// $data[]=$items;
		// }
		header('content-type:application/json');
		echo json_encode($data_obat);
	}

	function antrian()
	{
		$s = $this->session->userdata('user_login');
		$session=isset($s) ? $s:'';
		if($session!="")
		{
			$pecah=explode("|",$session);
			$data["username"] = $pecah[0];
			$data["id_pegawai"] = $pecah[1];
			$data["modul"] = $pecah[2];
			$pegawai = $this->Web_model->detail_pegawai($data['id_pegawai']);
			foreach($pegawai->result() as $items){
				$data["nama_pegawai"] = $items->nama;
				$data["foto"] = $items->foto;
			}
			
			$data_obat = $this->Pelayanan_model->daftar_obat();
			foreach($data_obat->result() as $items){
				$data["daftar_obat"][]=$items;
			}
			$data["nama_modul"]="Pelayanan";
			$data["menu_kiri1"]="Daftar Pasien";
			$data["menu_kiri2"]="Antrian Pasien"
            ;
			$data["link_kiri1"]="index.php/pelayanan";
			$data["link_kiri2"]="index.php/pelayanan/antrian";
			$this->load->vars($data);
			$this->daftar_pasien();
			$this->daftar_antrian();
			$this->getSemuaPekerjaan();
			$this->load->view('atas');
			if ($data["modul"]=="1" || $data["modul"]=="5") {
				$this->load->view('kiri');
				$this->load->view('pelayanan/antrian');
			} else {	
				$this->load->view('not_permission');
			}
			$this->load->view('bawah');
		}
		else
		{
			?>
			<script type="text/javascript" language="javascript">
			alert("Anda belum Log In...!!!\nAnda harus Log In untuk mengakses halaman ini...!!!");
			</script>
			<?php
			echo "<meta http-equiv='refresh' content='0; url=".base_url()."'>"; 
			
		}	
	}
}
?>