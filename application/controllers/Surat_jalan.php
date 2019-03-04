<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Surat_jalan extends CI_Controller {

	public function index()
	{
		$this->add_surat_jalan();
	}

	public function list_surat_jalan()
	{
		$this->load->view('surat_jalan/list_surat_jalan');
	}

	public function data_surat_jalan()
	{
		$this->load->model('m_surat_jalan');

		$requestData	= $_REQUEST;
		$fetch			= $this->m_surat_jalan->fetch_list_surat_jalan($requestData['search']['value'], $requestData['order'][0]['column'], $requestData['order'][0]['dir'], $requestData['start'], $requestData['length']);
		
		$totalData		= $fetch['totalData'];
		$totalFiltered	= $fetch['totalFiltered'];
		$query			= $fetch['query'];

		$data	= array();
		foreach($query->result_array() as $row)
		{ 
			$nestedData = array(); 
			$nestedData[]	= $row['no'];
			$nestedData[]	= $row['tujuan'];
			$nestedData[]	= $row['asal'];
			$nestedData[]	= $row['no_polisi'];
			$nestedData[]	= $row['pemilik_angkutan'];
			$nestedData[]	= $row['no_do'];
			$nestedData[]	= $row['emkl']; 
			
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
	
	public function add_surat_jalan()
	{
	//	$id_user		= $this->session->ap_id_user;
	//	$level = $this->session->userdata('ap_level');
	//	if($level == 'user' OR $level == 'admin')
	//	{
			if($_POST)
			{
				$this->load->library('form_validation');
				$this->form_validation->set_rules('tujuan','Deskripsi','trim|required|alpha_numeric_spaces');				
				$this->form_validation->set_message('required','%s harus diisi !');
				$this->form_validation->set_message('alpha_numeric_spaces', '%s Harus huruf / angka !');

				if($this->form_validation->run() == TRUE)
				{
					$this->load->model('m_surat_jalan');
					date_default_timezone_set("Asia/Jakarta");
					$dta = array(
						'no'				=> $this->input->post('no_surat'),
						'tujuan'			=> $this->input->post('tujuan'),
						'asal'				=> $this->input->post('asal'),
						'no_polisi'			=> $this->input->post('no_polisi'),
						'pemilik_angkutan'	=> $this->input->post('pemilik_angkutan'),
						'no_do'				=> $this->input->post('no_do'),
						'emkl'				=> $this->input->post('emkl')
					);
					$master 		= $this->m_surat_jalan->insert_data_surat($dta);
					if($master)
					{
					//	$no_surat_jalan 	= $this->m_surat_jalan->get_id($nomor_nota)->row()->id_order_m;
						$inserted	= 0;
						
							$no_array	= 0;
							foreach($_POST['no_merk'] as $k)
							{
								if( ! empty($k))
								{
									$no_merk 		= $_POST['no_merk'][$no_array];
									$jenisbarang	= $_POST['jenis'][$no_array];
									$jumlah			= $_POST['jumlah'][$no_array];
									$keterangan		= $_POST['keterangan'][$no_array];
									
									$dt = array(
										'no_surat_jalan' => $this->input->post('no_surat'),
										'no_merk' => $no_merk,
										'jenis_barang' => $jenisbarang,
										'jumlah_barang' => $jumlah,
										'keterangan' =>$keterangan
										
									);
									
									$insert_detail	= $this->m_surat_jalan->insert_detail_data_surat($dt);
									if($insert_detail)
									{
										$inserted++;
									}
								}

								$no_array++;
							}
						
							if($inserted > 0)
							{
								echo json_encode(array('status' => 1, 'pesan' => "Surat berhasil dibuat !"));
								
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
				$this->load->view('surat_jalan/surat_jalan');
			}
	//	}else{
			
	//		exit();
	//	}
	}
	
	public function del_surat_jalan($id_complain)
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
