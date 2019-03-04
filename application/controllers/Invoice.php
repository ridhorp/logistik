<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Invoice extends MY_Controller {

	public function index()
	{
		$this->load->view('invoice/list_invoice');
	}

	public function detail_invoice($no_invoice)
	{
		if($this->input->is_ajax_request())
		{
			$this->load->model('m_invoice');
			//$this->load->model('m_order_master');

			$dt['detail'] = $this->m_invoice->get_detail($no_invoice);
			$dt['master'] = $this->m_invoice->get_master($no_invoice)->row();
			
			$this->load->view('invoice/detail_invoice', $dt);
		}
	}

	public function data_invoice()
	{
		$this->load->model('m_invoice');

		$requestData	= $_REQUEST;
		$fetch			= $this->m_invoice->fetch_list_invoice($requestData['search']['value'], $requestData['order'][0]['column'], $requestData['order'][0]['dir'], $requestData['start'], $requestData['length']);
		
		$totalData		= $fetch['totalData'];
		$totalFiltered	= $fetch['totalFiltered'];
		$query			= $fetch['query'];

		$data	= array();
		foreach($query->result_array() as $row)
		{ 
			$nestedData[]	= $row['tanggal'];
			$nestedData[]	= "<a href='".site_url('invoice/detail_invoice/'.$row['no_invoice'])."' id='DetailInvoice'><i class='icon-note'></i>".$row['no_invoice']."</a>";
			$nestedData[]	= $row['no_job_order'];
			$nestedData[]	= $row['tujuan'];
			$nestedData[]	= $row['remarks'];
			$nestedData[]	= $row['total'];
			$nestedData[]	= "<a href='".site_url('invoice/create_invoice/'.$row['no_job_order'])."' id='DetailInvoice'><i class='icon-note'></i>Print</a>";
			
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

	public function create_invoice($no_jo = NULL)
	{
		/*$id_admin		= $this->session->ap_id_user;
		$level = $this->session->userdata('ap_level');
		if($level !== 'admin')
		{
			exit();
		}
		else
		{*/
			if( ! empty($no_jo))
			{
					$this->load->model('m_invoice');
					
					if($_POST)
					{
						$this->load->library('form_validation');

						$this->form_validation->set_rules('invoice','Invoice','trim|required|max_length[300]');
						$this->form_validation->set_rules('tujuan','Tujuan','trim|required|max_length[300]');
						$this->form_validation->set_message('required','%s harus diisi !');
						
						if($this->form_validation->run() == TRUE)
						{
							$dt=array(

								'no_invoice' => $this->input->post('invoice'),
								'no_job_order' => $no_jo,
								'tujuan' => $this->input->post('tujuan'),
								'remarks'=>'',
								'total' =>'',
								'tanggal'=>''
							);
						
							$insert = $this->m_invoice->create_invoice_master($dt);
								if($insert)
								{
									$inserted	= 0;
						
									$no_array	= 0;
									foreach($_POST['account'] as $k)
									{
										if( ! empty($k))
										{
											$account 		= $_POST['account'][$no_array];
											$description	= $_POST['description'][$no_array];
											$amount			= $_POST['amount'][$no_array];
											
											
											$dt = array(
												'no_invoice' => $this->input->post('invoice'),
												'account_code' => $account,
												'description' => $description,
												'amount' => $amount
												
											);
											
											$insert_detail	= $this->m_invoice->create_invoice_detail($dt);
											if($insert_detail)
											{
												$inserted++;
											}
										}

										$no_array++;
									}
								
									if($inserted > 0)
									{
										echo json_encode(array('status' => 1, 'pesan' => "Invoice berhasil dibuat !"));
										
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
						$this->load->model('m_jo');
						$dt['data'] = $this->m_jo->getID($no_jo)->row();
						$this->load->view('invoice/invoice',$dt);
					}
			}
		
	}
}
