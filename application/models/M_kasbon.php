<?php
class M_kasbon extends CI_Model 
{
	function fetch_list_kasbon($like_value = NULL, $column_order = NULL, $column_dir = NULL, $limit_start = NULL, $limit_length = NULL)
	{
		$sql = "
		SELECT 
			(@row:=@row+1) AS nomor, 
			no_kasbon,
			untuk,
			total,
			tanggal
		FROM 
			tbl_kasbon_master 
			, (SELECT @row := 0) r WHERE 1=1
		";

		$data['totalData'] = $this->db->query($sql)->num_rows();
		
		if( ! empty($like_value))
		{
			$sql .= " AND ( ";
			$sql .= "
				no_kasbon LIKE '%".$this->db->escape_like_str($like_value)."%' 
				OR untuk LIKE '%".$this->db->escape_like_str($like_value)."%'
				OR tanggal LIKE '%".$this->db->escape_like_str($like_value)."%'
			";
			$sql .= " ) ";
		}
		
		$data['totalFiltered']	= $this->db->query($sql)->num_rows();
		
		$columns_order_by = array( 
			0 => 'tanggal',
			1 => 'no_kasbon',
			2 => 'untuk',
			3 => 'total'
		);
		
		$sql .= " ORDER BY ".$columns_order_by[$column_order]." ".$column_dir.", nomor ";
		$sql .= " LIMIT ".$limit_start." ,".$limit_length." ";
		
		$data['query'] = $this->db->query($sql);
		return $data;
	}
	
	function insert_data_kasbon($dta)
	{
		return $this->db->insert('tbl_kasbon_master', $dta);
	}

	function insert_detail_kasbon($dta)
	{
		return $this->db->insert('tbl_kasbon_detail', $dta);
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