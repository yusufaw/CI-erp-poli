<?php if(!defined('BASEPATH'))	exit('No direct script access allowed');

class Super_Admin extends CI_Controller {
	function __contruct()
	{
		parent::__construct();
		$this->load->helper(array('url', 'form'));
		$this->load->model('Super_Admin_model');
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
			
			$pegawai = $this->web_model->detail_pegawai($data['id_pegawai']);
			foreach($pegawai->result() as $items){
				$data["nama_pegawai"] = $items->nama;
				$data["foto"] = $items->foto;
			}
			
			$daftar_pegawai = $this->Hr_model->daftar_pegawai();
			foreach($daftar_pegawai->result() as $items){
				$data["daftar_pegawai"][] = $items;
			}
			$data["nama_modul"]="Super";
			$data["menu_kiribaru1"]="HR";
			$data["menu_kiribaru2"]="Accounting";
			$data["menu_kiribaru3"]="Warehouse";
			$data["menu_kiribaru4"]="Pelayanan";
			$data["link_kiribaru1"]="index.php/hr";
			$data["link_kiribaru2"]="index.php/accounting";
			$data["link_kiribaru3"]="index.php/warehouse";
			$data["link_kiribaru4"]="index.php/pelayanan";
			$this->load->vars($data);
			$this->getStatusSemua();
			$this->getJabatanSemua();
			$this->getDepartemenSemua();
			$this->load->view('atas');
			$this->load->view('bawah');
			if ($data["modul"]=="5") {
				$this->load->view('kiri_baru');
				$this->load->view('Super_Admin/index');
			}
		}
		else
		{
			?>
			<script type="text/javascript" language="javascript">
			alert("Anda belum Log In...!!!\nAnda harus Log In untuk mengakses halaman ini...!!!");
			</script>
			<?php
			echo "<meta http-equiv='refresh' content='0; url=".base_url()."index.php/web'>";
		}
	}
	
	function daftarpegawai()
	{
		$s = $this->session->userdata('user_login');
		$session=isset($s) ? $s:'';
		if($session!="")
		{
			$daftar_pegawai = $this->Hr_model->daftar_pegawai();
			foreach($daftar_pegawai->result() as $items){
				$data[]=$items;
			}
			header('content-type:application/json');
			echo json_encode($data);
		}
		else
		{
			?>
			<script type="text/javascript" language="javascript">
			alert("Anda belum Log In...!!!\nAnda harus Log In untuk mengakses halaman ini...!!!");
			</script>
			<?php
			echo "<meta http-equiv='refresh' content='0; url=".base_url()."index.php/web'>";
		}
	}

	function update_pegawai($id_pegawai)
	{
		$data=$this->Hr_model->update_pegawai($id_pegawai);
		if($data)
		{
			?>
			<script type="text/javascript" language="javascript">
				alert("Update Pegawai Berhasil");
			</script>
			<?php
		}
	}
	
	function gaji_pegawai($id_pegawai){
		$data=$this->Hr_model->gaji_pegawai($id_pegawai);
		
	}
	
	function tambah_pegawai()
	{
		
		$config['file_name'] = str_replace(' ','',$this->input->post('nama'));
		$config['upload_path'] = './application/views/img/pegawai/';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']	= '100';
		$config['max_width']  = '1024';
		$config['max_height']  = '768';

		$this->load->library('upload', $config);

		if ( ! $this->upload->do_upload('foto'))
		{
			$error = array('error' => $this->upload->display_errors());

			?>
			<script type="text/javascript" language="javascript">
				alert("Error : "<?php echo $error ?>);
			</script>
			<?php
			echo "<meta http-equiv='refresh' content='0; url=".base_url()."hr/tambah'>";
		}
		else
		{
			$image_data = $this->upload->data();
			$save=$this->Hr_model->tambah_pegawai($image_data['file_name']);
			?>
			<script type="text/javascript" language="javascript">
				alert("Upload Pegawai Berhasil");
			</script>
			<?php
			//echo "<meta http-equiv='refresh' content='0; url=".base_url()."hr/tambah'>";
			if($save)
			{
			?>
			<script type="text/javascript" language="javascript">
				alert("Tambah Pegawai Berhasil");
			</script>
			<?php
			echo "<meta http-equiv='refresh' content='0; url=".base_url()."hr/tambah'>";
			}
			else{
				?>
			<script type="text/javascript" language="javascript">
				alert("Tambah Pegawai Gagal");
			</script>
			<?php
			}
		}
		
		
		
	}

	function getPegawaiGaji($id_pegawai)
	{
		$data_pegawai_gaji = $this->Hr_model->detail_gaji($id_pegawai);
		foreach($data_pegawai_gaji->result() as $items){
			$data[]=$items;
		}
		header('content-type:application/json');
		echo json_encode($data);
	}
	
	function hapus_pegawai($id_pegawai)
	{
		$data=$this->Hr_model->hapus_pegawai($id_pegawai);
		echo $data;
		if($data)
		{
			?>
			<script type="text/javascript" language="javascript">
				alert("Hapus Pegawai Berhasil");
			</script>
			<?php
		}
	}
	
	function getDetailPegawai($id_pegawai)
	{
		$detail_pegawai = $this->Hr_model->detail_pegawai($id_pegawai);
			foreach($detail_pegawai->result() as $items){
				$data[]=$items;
			}
		header('content-type:application/json');
		echo json_encode($data);
	}
	
	function getNamaPegawai($id_pegawai)
	{
		$data_nama = $this->Hr_model->nama_pegawai($id_pegawai);
			foreach($data_nama->result() as $items){
				$data[]=$items;
			}
		header('content-type:application/json');
		echo json_encode($data);
	}
	
	function getStatusPegawai($id_pegawai)
	{
		$data_status = $this->Hr_model->status_pegawai($id_pegawai);
			foreach($data_status->result() as $items){
				$data[]=$items;
			}
		header('content-type:application/json');
		echo json_encode($data);
	}
	
	function getJabatanPegawai($id_pegawai)
	{
		$data_jabatan = $this->Hr_model->jabatan_pegawai($id_pegawai);
			foreach($data_jabatan->result() as $items){
				$data[]=$items;
			}
		header('content-type:application/json');
		echo json_encode($data);
	}
	
	function getDepartemenPegawai($id_pegawai)
	{
		$data_departemen = $this->Hr_model->departemen_pegawai($id_pegawai);
			foreach($data_departemen->result() as $items){
				$data[]=$items;
			}
		header('content-type:application/json');
		echo json_encode($data);
	}

	function getStatusSemua(){
		$semua_status = $this->Hr_model->semua_status();
		foreach($semua_status->result() as $items){
				$data["semua_status"][] = $items;
		}
		$this->load->vars($data);
	}
	
	function getJabatanSemua(){
		$semua_jabatan = $this->Hr_model->semua_jabatan();
		foreach($semua_jabatan->result() as $items){
				$data["semua_jabatan"][] = $items;
		}
		$this->load->vars($data);
	}
	
	function getDepartemenSemua(){
		$semua_departemen = $this->Hr_model->semua_departemen();
		foreach($semua_departemen->result() as $items){
				$data["semua_departemen"][] = $items;
		}
		$this->load->vars($data);
	}
	
	function tambah()
	{
		$s = $this->session->userdata('user_login');
		$session=isset($s) ? $s:'';
		if($session!="")
		{
			$pecah=explode("|",$session);
			$data["username"] = $pecah[0];
			$data["id_pegawai"] = $pecah[1];
			$data["modul"] = $pecah[2];
			
			$pegawai = $this->web_model->detail_pegawai($data['id_pegawai']);
			foreach($pegawai->result() as $items){
				$data["nama_pegawai"] = $items->nama;
				$data["foto"] = $items->foto;
			}
			
			$data["nama_modul"]="Human Resources";
			$data["menu_kiri1"]="Penggajian";
			$data["menu_kiri2"]="Pengelolaan Data";
			$data["link_kiri1"]="hr";
			$data["link_kiri2"]="hr/kelola";
			$this->load->vars($data);
			$this->getStatusSemua();
			$this->getJabatanSemua();
			$this->getDepartemenSemua();
			$this->load->view('atas');
			$this->load->view('bawah');
			if ($data["modul"]=="3") {
				$this->load->view('kiri');
				$this->load->view('hr/tambah');
			} else {	
				$this->load->view('not_permission');
			}
		}
		else
		{
			?>
			<script type="text/javascript" language="javascript">
			alert("Anda belum Log In...!!!\nAnda harus Log In untuk mengakses halaman ini...!!!");
			</script>
			<?php
			echo "<meta http-equiv='refresh' content='0; url=".base_url()."index.php/web'>";
		}
	}	
}