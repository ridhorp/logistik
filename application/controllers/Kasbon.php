<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kasbon extends MY_Controller {

	public function index()
	{
		$this->add_kasbon();
	}

	public function list_kasbon()
	{
		$this->load->view('kasbon/list_kasbon');
	}

	public function data_kasbon()
	{
		$this->load->model('m_kasbon');

		$requestData	= $_REQUEST;
		$fetch			= $this->m_kasbon->fetch_list_kasbon($requestData['search']['value'], $requestData['order'][0]['column'], $requestData['order'][0]['dir'], $requestData['start'], $requestData['length']);
		
		$totalData		= $fetch['totalData'];
		$totalFiltered	= $fetch['totalFiltered'];
		$query			= $fetch['query'];

		$data	= array();
		foreach($query->result_array() as $row)
		{ 
			$nestedData = array(); 
			$nestedData[]	= $row['tanggal'];
			$nestedData[]	= $row['no_kasbon'];
			$nestedData[]	= $row['untuk'];
			$nestedData[]	= $row['total'];
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
	
	public function add_kasbon()
	{
	//	$id_user		= $this->session->ap_id_user;
	//	$level = $this->session->userdata('ap_level');
	//	if($level == 'user' OR $level == 'admin')
	//	{
			if($_POST)
			{
				$this->load->library('form_validation');
				$this->form_validation->set_rules('tanggal','Tanggal','trim|required');
				$this->form_validation->set_rules('no_kasbon','No Kasbon','trim|required');		
				$this->form_validation->set_rules('untuk','Untuk','trim|required');				
				$this->form_validation->set_message('required','%s harus diisi !');
				$this->form_validation->set_message('alpha_numeric_spaces', '%s Harus huruf / angka !');

				if($this->form_validation->run() == TRUE)
				{
					$this->load->model('m_kasbon');
					date_default_timezone_set("Asia/Jakarta");
					$dta = array(
						'tanggal'				=> $this->input->post('tanggal'),
						'no_kasbon'			=> $this->input->post('no_kasbon'),
						'untuk'				=> $this->input->post('untuk'),
						'total'			=> $this->input->post('total')
					);
					$master 		= $this->m_kasbon->insert_data_kasbon($dta);
					if($master)
					{
					//	$no_surat_jalan 	= $this->m_surat_jalan->get_id($nomor_nota)->row()->id_order_m;
						$inserted	= 0;
						
							$no_array	= 0;
							foreach($_POST['kode_rek'] as $k)
							{
								if( ! empty($k))
								{
									$uraian 		= $_POST['uraian'][$no_array];
									$kode_rek	= $_POST['kode_rek'][$no_array];
									$jumlah			= $_POST['jumlah'][$no_array];
									
									$dt = array(
										'no_kasbon' => $this->input->post('no_kasbon'),
										'pengeluaran' => $uraian,
										'kode_rek' => $kode_rek,
										'jumlah' => $jumlah
									);
									
									$insert_detail	= $this->m_kasbon->insert_detail_kasbon($dt);
									if($insert_detail)
									{
										$inserted++;
									}
								}

								$no_array++;
							}
						
							if($inserted > 0)
							{
								echo json_encode(array('status' => 1, 'pesan' => "Kasbon berhasil dibuat !"));
								
							}
							else
							{
								$this->query_error();
							}
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
				$this->load->view('kasbon/kasbon');
			}
	}

	public function cek_no_kasbon($no_kasbon)
	{
		$this->load->model('m_order_master');
		$cek = $this->m_kasbon->cek_kasbon_validasi($no_kasbon);

		if($cek->num_rows() > 0)
		{
			return FALSE;
		}
		return TRUE;
	}
}
