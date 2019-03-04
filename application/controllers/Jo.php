<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jo extends MY_Controller {

	public function index()
	{
		$this->add_jo();
	}

	public function list_jo()
	{
		$this->load->view('job_order/list_jo');
	}

	public function detail_jo($no_jo)
	{
		if($this->input->is_ajax_request())
		{
			$this->load->model('m_jo');
			//$this->load->model('m_order_master');
			$dt['master'] = $this->m_jo->get_master($no_jo)->row();
			
			$this->load->view('job_order/detail_jo', $dt);
		}
	}

	public function data_jo()
	{
		$this->load->model('m_jo');

		$requestData	= $_REQUEST;
		$fetch			= $this->m_jo->fetch_list_jo($requestData['search']['value'], $requestData['order'][0]['column'], $requestData['order'][0]['dir'], $requestData['start'], $requestData['length']);
		
		$totalData		= $fetch['totalData'];
		$totalFiltered	= $fetch['totalFiltered'];
		$query			= $fetch['query'];

		$data	= array();
		foreach($query->result_array() as $row)
		{ 
			$nestedData[]	= "<a href='".site_url('jo/detail_jo/'.$row['no_job_order'])."' id='detailJo'>".$row['no_job_order']."</a>";
			$nestedData[]	= $row['customer_code'];
			$nestedData[]	= $row['no_b_l'];
			$nestedData[]	= $row['vessel'];
			$nestedData[]	= $row['eta'];
			$nestedData[]	= $row['port_loading'];
			$nestedData[]	= $row['port_destination'];
			$nestedData[]	= $row['party_volume'];
			$nestedData[]	= "<a href='".site_url('invoice/create_invoice/'.$row['no_job_order'])."' id='AddResponse'><i class='icon-note'></i>Buat Invoice</a> | <a href='".site_url('invoice/create_invoice/'.$row['no_job_order'])."' id='AddResponse'><i class='icon-note'></i> Print</a> ";
			
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
	
	public function add_jo()
	{
		$this->load->model('m_jo');
					
		if($_POST)
		{
			$this->load->library('form_validation');

			$this->form_validation->set_rules('no_job','Deskripsi','trim|required|max_length[300]');
			$this->form_validation->set_message('required','%s harus diisi !');
			
			if($this->form_validation->run() == TRUE)
			{
				
				$dt=array(
					'no_job_order' => $this->input->post('no_job'),
					'customer_code' => $this->input->post('customer_code'),
					'no_pib_peb' => $this->input->post('pib'),
					'no_b_l' => $this->input->post('bl_no'),
					'vessel' => $this->input->post('vessel'),
					'eta' => $this->input->post('eta'),
					'port_loading' => $this->input->post('p_load'),
					'port_destination' => $this->input->post('p_dest'),
					'tps_warehouse' => $this->input->post('tps'),
					'bc_tgl' => $this->input->post('bc_tgl'),
					'party_volume' => $this->input->post('volume'),
					'description_of_goods' => $this->input->post('desc'),
					'no_container' => $this->input->post('container')
				);
				
				$insert = $this->m_jo->insert_job($dt);
					if($insert)
					{
						
						echo json_encode(array(
							'status' => 1,
							'pesan' => "Berhasil Di Input"
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
			$this->load->view('job_order/jo');
		}
	
	}
}
