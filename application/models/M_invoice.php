<?php
class M_invoice extends CI_Model 
{
	function fetch_list_invoice($like_value = NULL, $column_order = NULL, $column_dir = NULL, $limit_start = NULL, $limit_length = NULL)
	{
		$sql = "
		SELECT 
			(@row:=@row+1) AS nomor, 
			no_invoice,
			no_job_order,
			remarks,
			tujuan, 
			total,
			tanggal
		FROM 
			tbl_invoice_master 
			, (SELECT @row := 0) r WHERE 1=1
		";

		$data['totalData'] = $this->db->query($sql)->num_rows();
		
		if( ! empty($like_value))
		{
			$sql .= " AND ( ";
			$sql .= "
				tujuan LIKE '%".$this->db->escape_like_str($like_value)."%' 
				OR no_invoice LIKE '%".$this->db->escape_like_str($like_value)."%'
				OR no_job_order LIKE '%".$this->db->escape_like_str($like_value)."%'
				OR tanggal LIKE '%".$this->db->escape_like_str($like_value)."%'
			";
			$sql .= " ) ";
		}
		
		$data['totalFiltered']	= $this->db->query($sql)->num_rows();
		
		$columns_order_by = array( 
			0 => 'tanggal',
			1 => 'no_invoice',
			2 => 'no_job_order',
			3 => 'remarks',
			4 => 'tujuan',
			5 => 'total',
			6 => 'tanggal'
		);
		
		$sql .= " ORDER BY ".$columns_order_by[$column_order]." ".$column_dir.", nomor ";
		$sql .= " LIMIT ".$limit_start." ,".$limit_length." ";
		
		$data['query'] = $this->db->query($sql);
		return $data;
	}
	
	function create_invoice_master($dt)
	{
		return $this->db->insert('tbl_invoice_master', $dt);
	}

	function create_invoice_detail($dta)
	{
		return $this->db->insert('tbl_invoice_detail', $dta);
	}

	function get_master($no_invoice){
    
        $sql = "SELECT
			no_invoice,
			no_job_order,
			remarks,
			tujuan, 
			DATE_FORMAT(tanggal, '%d %b %Y - %H:%i:%s') AS tanggal,
			total
		FROM 
			tbl_invoice_master
        WHERE no_invoice = '".$no_invoice."' LIMIT 1";
        
        return $this->db->query($sql);
	}

	function get_detail($no_invoice){
    
        $sql = "SELECT
			account_code,
			description,
			amount
		FROM 
			tbl_invoice_detail
        WHERE no_invoice = '".$no_invoice."'";
        
        return $this->db->query($sql);
	}

	function del_data_surat($id_complain)
	{
		$sql="DELETE data_complain,data_response 
			FROM data_complain,data_response
			WHERE data_complain.id_complain = data_response.id_complain
			AND data_complain.id_complain='".$id_complain."'";
		return $this->db->query($sql, array($id_complain));
	}
	
}