<?php
class M_jo extends CI_Model 
{
	function fetch_list_jo($like_value = NULL, $column_order = NULL, $column_dir = NULL, $limit_start = NULL, $limit_length = NULL)
	{
		$sql = "
		SELECT 
			(@row:=@row+1) AS nomor, 
			no_job_order,
			customer_code,
			no_pib_peb,
			no_b_l,
			vessel, 
			eta,
			port_loading,
			port_destination,
			tps_warehouse,
			bc_tgl,
			party_volume,
			description_of_goods,
			no_container
		FROM 
			tbl_job_order 
			, (SELECT @row := 0) r WHERE 1=1
		";

		$data['totalData'] = $this->db->query($sql)->num_rows();
		
		if( ! empty($like_value))
		{
			$sql .= " AND ( ";
			$sql .= "
			no_job_order LIKE '%".$this->db->escape_like_str($like_value)."%' 
				OR no_pib_peb LIKE '%".$this->db->escape_like_str($like_value)."%'
				OR no_b_l LIKE '%".$this->db->escape_like_str($like_value)."%'
				OR vessel LIKE '%".$this->db->escape_like_str($like_value)."%'
				OR eta LIKE '%".$this->db->escape_like_str($like_value)."%'
				OR port_loading LIKE '%".$this->db->escape_like_str($like_value)."%'
				OR port_destination LIKE '%".$this->db->escape_like_str($like_value)."%'

			";
			$sql .= " ) ";
		}
		
		$data['totalFiltered']	= $this->db->query($sql)->num_rows();
		
		$columns_order_by = array( 
			0 => 'no_job_order',
			1 => 'no_pib_peb',
			2 => 'no_b_l',
			3 => 'vessel',
			4 => 'eta',
			5 => 'port_loading',
			6 => 'port_destination',
			7 => 'tps_warehouse',
			8 => 'bc_tgl',
			9 => 'party_volume',
			10 => 'description_of_goods',
			11 => 'no_container'
		
		);
		
		$sql .= " ORDER BY ".$columns_order_by[$column_order]." ".$column_dir.", nomor ";
		$sql .= " LIMIT ".$limit_start." ,".$limit_length." ";
		
		$data['query'] = $this->db->query($sql);
		return $data;
	}
	
	function insert_job($dta)
	{
		return $this->db->insert('tbl_job_order', $dta);
	}

	function get_master($no_jo){
    
        $sql = "SELECT a.*, b.no_invoice FROM 
			tbl_job_order as a 
			left join tbl_invoice_master as b on a.no_job_order = b.no_job_order
        WHERE a.no_job_order = '".$no_jo."' LIMIT 1";
        
        return $this->db->query($sql);
	}
	function getID($no_jo){
    
        $sql = "SELECT
			no_job_order
		FROM 
			tbl_job_order
        WHERE no_job_order = '".$no_jo."' LIMIT 1";
        
        return $this->db->query($sql);
	}
	

	function del_jo($id_complain)
	{
		$sql="DELETE data_complain,data_response 
			FROM data_complain,data_response
			WHERE data_complain.id_complain = data_response.id_complain
			AND data_complain.id_complain='".$id_complain."'";
		return $this->db->query($sql, array($id_complain));
	}
	
}