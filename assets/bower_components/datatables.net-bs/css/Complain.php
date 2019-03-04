<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Complain extends MY_Controller {

	public function index(){
		$this->load->model('m_dashboard');
		$dt['count'] = $this->m_dashboard->get_count()->row();
        //$this->load->view('include/month',$dt);
		$this->load->view('complain/complain',$dt);
		
	}

	
    

    public function data_complain()
	{
		$this->load->model('m_complain');
		$level 			= $this->session->ap_level;
		$user 			= $this->session->ap_id_user;

		$requestData	= $_REQUEST;
		$fetch			= $this->m_complain->fetch_data_complain($level,$user,$requestData['search']['value'], $requestData['order'][0]['column'], $requestData['order'][0]['dir'], $requestData['start'], $requestData['length']);
		
		$totalData		= $fetch['totalData'];
		$totalFiltered	= $fetch['totalFiltered'];
		$query			= $fetch['query'];

		$data	= array();
		foreach($query->result_array() as $row)
		{ 
			$span="";
			$status= $row['status_resolve'];
			if($status == 'complete'){
				$span="<span class='label label-info'>";
			}elseif($status == 'pending'){
				$span="<span class='label label-danger'>";
			}elseif($status == 'new'){
				$span="<span class='label label-success'>";
			}
			
			$span1="";
			$sifat= $row['status'];
			if($sifat == 'normal'){
				$span1="<span class='label label-light-success'>";
			}elseif($sifat == 'very urgent'){
				$span1="<span class='label label-light-danger'>";
			}elseif($sifat == 'urgent'){
				$span1="<span class='label label-light-warning'>";
			}
			$nestedData = array(); 
			$nestedData[]	= $row['nomor'];
			$nestedData[]	= $row['nama'];
			$nestedData[]	= $row['subject'];
			$nestedData[]	= $row['description'];
		    $nestedData[]	= $span.$status."</span>"; 
			//$nestedData[]	= preg_replace("/\r\n|\r|\n/",'<br />', $row['keterangan']);
			$nestedData[]	= $span1.$sifat."</span>";
			$nestedData[]	= $row['tanggal'];
			//$nestedData[]	= "<a href='".site_url('order/log-order/'.$row['id_order_m'])."' id='AddResponse'><i class='fa fa-file-text-o fa-fw'></i>Tracking Order</a>";
		//	$nestedData[]	= $row[''];
		
			if($level == 'admin')
			{
				$nestedData[]	= "<a href='".site_url('response/add_responses/'.$row['id_complain'])."' id='AddResponse'><i class='icon-note'></i></a> | <a href='".site_url('complain/del_complain/'.$row['id_complain'])."' id='DelComplain'><i class='icon-trash'></i></a> ";
//$nestedData[]	= "<a href='".site_url('response/del_responses/'.$row['id_complain'])."' id='DelResponse'><i class='icon-trash'></i></a>";
			}
			$data[] = $nestedData;
		}

		$json_data = array(
			"draw"            => intval( $requestData['draw'] ),  
			"recordsTotal"    => intval( $totalData ),  
			"recordsFiltered" => intval( $totalFiltered ), 
			"data"            => $data
			);

		echo json_encode($json_data);
	}
	
	public function add_complain()
	{
		$id_user		= $this->session->ap_id_user;
		$level = $this->session->userdata('ap_level');
		if($level == 'user' OR $level == 'admin')
		{
			if($_POST)
			{
				$this->load->library('form_validation');
				$this->form_validation->set_rules('shortDescription','Deskripsi','trim|required|alpha_numeric_spaces');				
				$this->form_validation->set_message('required','%s harus diisi !');
				$this->form_validation->set_message('alpha_numeric_spaces', '%s Harus huruf / angka !');

				if($this->form_validation->run() == TRUE)
				{
					$this->load->model('m_complain');
					date_default_timezone_set("Asia/Jakarta");
					$dta = array(
						'id_user' 		=> $id_user,
						'subject'		=> $this->input->post('subject'),
						'status'		=> $this->input->post('trait'),
						'description'	=> $this->input->post('shortDescription'),
						'type'			=> $this->input->post('type'),
						'tgl'			=> date('Y-m-d H:i:s')
					);
					$insert 		= $this->m_complain->add_complain($dta);
					if($insert)
					{
						echo json_encode(array(
							'status' => 1,
							'pesan' => "Complain anda sudah dilaporkan"
						));
					}
					else
					{
						$this->query_error();
					}
				}
				else
				{
					$this->input_error();
				}
			}
			else
			{
				$this->load->model('m_dashboard');
				$this->load->model('m_user');
				$dt['count'] = $this->m_dashboard->get_count()->row();
				$dt['profile']	= $this->m_user->get_baris($id_user)->row();
				//$this->load->view('include/month',$dt);
				$this->load->view('complain/add_complain',$dt);
			}
		}else{
			
			exit();
		}
	}
	
	public function del_complain($id_complain)
	{
		$level = $this->session->userdata('ap_level');
		if($level !== 'admin')
		{
			exit();
		}
		else
		{
			if($this->input->is_ajax_request())
			{
				$this->load->model('m_complain');
				$hapus = $this->m_complain->del_complain($id_complain);
				if($hapus)
				{
					echo json_encode(array(
						"pesan" => "Data berhasil dihapus !
					"));
				}
				else
				{
					echo json_encode(array(
						"pesan" => "Terjadi kesalahan, coba lagi !
					"));
				}
			}
		}
	}
}

?>