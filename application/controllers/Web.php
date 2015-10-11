<?php if(!defined('BASEPATH'))	exit('No direct script access allowed');

class Web extends CI_Controller {
	function __contruct()
	{
		parent::__construct();
		$this->load->helper(array('url', 'form'));
		session_start();
	}
	
	function index()
	{
		$this->load->view('login');
	}
	
	function masuklogin()
	{
		$username = $this->input->post('usr');
		$pwd = $this->input->post('pwd');
		$hasil = $this->web_model->data_login($username,$pwd);
		if (count($hasil->result_array())>0){
			foreach($hasil->result() as $items){
				$session_user=$items->username."|".$items->id_pegawai."|".$items->modul;
				$tanda=$items->modul;
			}
			//$_SESSION['user_login'] = $session_user;
			$this->session->set_userdata('user_login',$session_user);
			$nama_modul = $this->web_model->nama_modul($tanda);
			echo "<meta http-equiv='refresh' content='0; url=".base_url().'index.php/'.$nama_modul."'>";
		}
		else
		{
		?>
		<script type="text/javascript">
		alert("Username atau Password Yang Anda Masukkan Salah..!!!");			
		</script>
		<?php
			echo "<meta http-equiv='refresh' content='0; url=".base_url()."'>";
		}
	}
	
	function logout()
	{
		$this->session->sess_destroy();
		echo "<meta http-equiv='refresh' content='0; url=".base_url()."index.php/web'>";
	}
}