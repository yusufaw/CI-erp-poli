<?php if(!defined('BASEPATH'))	exit('No direct script access allowed');

class Accounting extends CI_Controller {
	function __contruct()
	{
		parent::__construct();
		$this->load->helper(array('url', 'form'));
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
			
			$pemasukan = $this->Accounting_model->daftar_pemasukan();
			foreach($pemasukan->result() as $items){
				$data["daftar_pemasukan"][] = $items;
				
			}
			
			$pembelian = $this->Accounting_model->daftar_pembelian();
			foreach($pembelian->result() as $items){
				$data["daftar_pembelian"][] = $items;
				
			}
			$data["nama_modul"]="Accounting";
			$data["menu_kiri1"]="Penerimaan";
			$data["menu_kiri2"]="Order";
			$data["link_kiri1"]="index.php/accounting";
			$data["link_kiri2"]="index.php/accounting/order";
			$this->load->vars($data);
			$this->load->view('atas');
			if ($data["modul"]=="4" || $data["modul"]=="5") {
				$this->load->view('kiri');
				$this->load->view('accounting/index');
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
			echo "<meta http-equiv='refresh' content='0; url=".base_url()."index.php/web'>";
		}
		
	}
	
	function terima_gaji($id_penggajian)
	{
		$data = $this->Accounting_model->terima_gaji($id_penggajian);
		if($data)
		{
			?>
			<script type="text/javascript" language="javascript">
			alert("Proses Terima Berhasil");
			</script>
			<?php
		}
	}
	
	function terima_barang($id_barang)
	{
		$data = $this->Accounting_model->terima_barang($id_barang);
		if($data)
		{
			?>
			<script type="text/javascript" language="javascript">
			alert("Proses Terima Berhasil");
			</script>
			<?php
		}
	}
	
	function tolak_gaji($id_penggajian)
	{
		$data = $this->Accounting_model->tolak_gaji($id_penggajian);
		if($data)
		{
			?>
			<script type="text/javascript" language="javascript">
			alert("Proses Tolak Berhasil");
			</script>
			<?php
		}
	}
	
	function tolak_barang($id_barang)
	{
		$data = $this->Accounting_model->tolak_barang($id_barang);
		if($data)
		{
			?>
			<script type="text/javascript" language="javascript">
			alert("Proses Tolak Berhasil");
			</script>
			<?php
		}
	}
	
	function getPegawaiGaji($id_penggajian)
	{
		$data_pegawai_gaji = $this->Accounting_model->detail_gaji($id_penggajian);
		foreach($data_pegawai_gaji->result() as $items){
			$data[]=$items;
		}
		header('content-type:application/json');
		echo json_encode($data);
	}
	
	function order()
	{
		$s = $this->session->userdata('user_login');
		$session=isset($s) ? $s:'';
		if($session!="")
		{
			$pecah=explode("|",$session);
			$data["username"] = $pecah[0];
			$data["id_pegawai"] = $pecah[1];
			$data["modul"] = $pecah[2];
			
			$barang_order = $this->Warehouse_model->barang_order();
			foreach($barang_order->result() as $items){
				$data["barang_order"][] = $items;
			}
			
			$daftar_gaji = $this->Hr_model->daftar_gaji();
			foreach($daftar_gaji->result() as $items){
				$data["daftar_gaji_pegawai"][] = $items;
			}
			
			$pegawai = $this->web_model->detail_pegawai($data['id_pegawai']);
			foreach($pegawai->result() as $items){
				$data["nama_pegawai"] = $items->nama;
				$data["foto"] = $items->foto;
			}
			$data["nama_modul"]="Accounting";
			$data["menu_kiri1"]="Penerimaan";
			$data["menu_kiri2"]="Order";
			$data["link_kiri1"]="index.php//accounting";
			$data["link_kiri2"]="index.php//accounting/order";
			$this->load->vars($data);
			$this->load->view('atas');
			if ($data["modul"]=="4" || $data["modul"]=="5") {
				$this->load->view('kiri');
				$this->load->view('accounting/order');
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
			echo "<meta http-equiv='refresh' content='0; url=".base_url()."index.php/web'>";
		}
	}
}