<?php
class MY_Controller extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		//$this->session_cek();
	}
	
	function input_error()
	{
		$json['status'] = 0;
		//$json['pesan'] 	= "<div class='alert alert-warning error_validasi'>".validation_errors()."</div>";
		$json['pesan'] 	= validation_errors();
		$this->output
        	->set_content_type('application/json')
        	->set_output(json_encode($json));
	}

	function query_error($pesan = "Terjadi kesalahan, coba lagi !")
	{
		$json['status'] = 2;
		$json['pesan'] 	= "<div class='alert alert-danger error_validasi'>".$pesan."</div>";
		$json['pesan'] 	= $pesan;
		$this->output
			->set_content_type('application/json')
			->set_output(json_encode($json));
	}
/*
	function session_cek()
	{
		$u = $this->session->ap_id_user;
		$p = $this->session->ap_password;
		$x = $this->session->ap_level;

		$controller = $this->router->class;
		$method		= $this->router->method;

		if($controller == 'secure')
		{
			if($method == 'index')
			{
				if( ! empty($u) && ! empty($p))
				{
					$URL_home = '';
					if($x == 'admin')
					{
						$URL_home = 'admin/dashboard';
					}
					if($x == 'user')
					{
						$URL_home = 'user/dashboard';
					}
					redirect($URL_home, 'refresh');
				}
			}
		}
		else
		{
			if($this->session->userdata())
			{
				redirect('secure', 'refresh');
			}
			else
			{
				$this->load->model('m_user');
				$cek = $this->m_user->is_valid($u, $p);
				if($cek->num_rows() < 1)
				{
					redirect('secure/logout', 'refresh');
				}
			}
		}
	}*/

	function clean_tag_input($str)
	{
		$t = preg_replace('/<[^<|>]+?>/', '', htmlspecialchars_decode($str));
		$t = htmlentities($t, ENT_QUOTES, "UTF-8");
		$t = trim($t);
		return $t;
	}
}