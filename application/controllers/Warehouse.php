<?php if(!defined('BASEPATH'))	exit('No direct script access allowed');

class Warehouse extends CI_Controller {
	function __contruct()
	{
		parent::__construct();
		$this->load->helper(array('url', 'form'));
		$this->load->model('Warehouse_model');
	}
	
	function getDataBarang($id_barang)
	{
            $data_barang = $this->Warehouse_model->data_barang($id_barang);
		foreach($data_barang->result() as $items){
			$data[]=$items;
		}
		header('content-type:application/json');
		echo json_encode($data);
	}
	
	function update_barang($id_barang)
	{
		$data=$this->Warehouse_model->update_barang($id_barang);
		if($data)
		{
			?>
			<script type="text/javascript" language="javascript">
				alert("Update Barang Berhasil");
			</script>
			<?php
		}
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
			
			$barang_tersedia = $this->Warehouse_model->barang_tersedia();
			foreach($barang_tersedia->result() as $items){
				$data["barang_tersedia"][] = $items;
			}
			$pegawai = $this->web_model->detail_pegawai($data['id_pegawai']);
			foreach($pegawai->result() as $items){
				$data["nama_pegawai"] = $items->nama;
				$data["foto"] = $items->foto;
			}
			
			$pembelian = $this->Accounting_model->daftar_pembelian();
			foreach($pembelian->result() as $items){
				$data["daftar_pembelian"][] = $items;
				
			}
			$data["nama_modul"]="Warehouse";
			$data["menu_kiri1"]="Barang Tersedia";
			$data["menu_kiri2"]="Order";
			$data["link_kiri1"]="index.php/Warehouse";
			$data["link_kiri2"]="index.php/warehouse/order";
			$this->load->vars($data);
			$this->getJenisBarang();
			$this->load->view('atas');
			if ($data["modul"]=="2" || $data["modul"]=="5") {
				$this->load->view('kiri');
				$this->load->view('warehouse/index');
			} else {	
				$this->load->view('not_permission');
			}
			
			$this->load->view('bawah');
		}
		else
		{?>
			<script type="text/javascript" language="javascript">
			alert("Anda belum Log In...!!!\nAnda harus Log In untuk mengakses halaman ini...!!!");
			</script>
			<?php
			echo "<meta http-equiv='refresh' content='0; url=".base_url()."index.php/web'>";
		}	
	}
	
	function order ()
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
			
			$barang_order = $this->Warehouse_model->barang_order();
			foreach($barang_order->result() as $items){
				$data["barang_order"][] = $items;
			}
			$data["nama_modul"]="Warehouse";
			$data["menu_kiri1"]="Barang Tersedia";
			$data["menu_kiri2"]="Order";
			$data["link_kiri1"]="index.php/warehouse";
			$data["link_kiri2"]="index.php/warehouse/order";
			$this->load->vars($data);
			$this->getSatuanBarang();
			$this->getJenisBarang();
			$this->load->view('atas');
			if ($data["modul"]=="2" || $data["modul"]=="5") {
				$this->load->view('kiri');
				$this->load->view('warehouse/order');
			} else {	
				$this->load->view('not_permission');
			}
			
			$this->load->view('bawah');
		}
		else
		{?>
			<script type="text/javascript" language="javascript">
			alert("Anda belum Log In...!!!\nAnda harus Log In untuk mengakses halaman ini...!!!");
			</script>
			<?php
			echo "<meta http-equiv='refresh' content='0; url=".base_url()."index.php/web'>";
		}
	}
	
	function getSatuanBarang(){
		$data_satuan=$this->Warehouse_model->satuan_barang();
		foreach($data_satuan->result() as $items){
			$data["semua_satuan_barang"][]=$items;
		}
		$this->load->vars($data);
	}
	
	function getJenisBarang(){
		$data_jenis = $this->Warehouse_model->jenis_barang();
		foreach($data_jenis->result() as $items){
			$data["semua_jenis_barang"][]=$items;
		}
		$this->load->vars($data);
	}
	
	function proses_order(){
		$data=$this->Warehouse_model->order_barang();
		
		if($data){
			?>
			<script type="text/javascript" language="javascript">
			alert("Proses Order Berhasil");
			</script>
			<?php
			echo "<meta http-equiv='refresh' content='0; url=".base_url()."warehouse/order'>";
		}
	}
	
}