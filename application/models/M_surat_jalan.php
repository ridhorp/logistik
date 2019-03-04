<?php
class M_surat_jalan extends CI_Model 
{
	function fetch_list_surat_jalan($like_value = NULL, $column_order = NULL, $column_dir = NULL, $limit_start = NULL, $limit_length = NULL)
	{
		$sql = "
		SELECT 
			(@row:=@row+1) AS nomor, 
			no,
			tujuan,
			asal,
			no_polisi, 
			pemilik_angkutan,
			no_do,
			emkl
		FROM 
			tbl_surat_jalan_master 
			, (SELECT @row := 0) r WHERE 1=1
		";

		$data['totalData'] = $this->db->query($sql)->num_rows();
		
		if( ! empty($like_value))
		{
			$sql .= " AND ( ";
			$sql .= "
				tujuan LIKE '%".$this->db->escape_like_str($like_value)."%' 
				OR no LIKE '%".$this->db->escape_like_str($like_value)."%'
				OR asal LIKE '%".$this->db->escape_like_str($like_value)."%'
				OR no_polisi LIKE '%".$this->db->escape_like_str($like_value)."%'
				OR pemilik_angkutan LIKE '%".$this->db->escape_like_str($like_value)."%'
				OR no_do LIKE '%".$this->db->escape_like_str($like_value)."%'
				OR emkl LIKE '%".$this->db->escape_like_str($like_value)."%'

			";
			$sql .= " ) ";
		}
		
		$data['totalFiltered']	= $this->db->query($sql)->num_rows();
		
		$columns_order_by = array( 
			0 => 'no',
			1 => 'tujuan',
			2 => 'asal',
			3 => 'no_polisi',
			4 => 'pemilik_angkutan',
			5 => 'no_do',
			6 => 'emkl'
		);
		
		$sql .= " ORDER BY ".$columns_order_by[$column_order]." ".$column_dir.", nomor ";
		$sql .= " LIMIT ".$limit_start." ,".$limit_length." ";
		
		$data['query'] = $this->db->query($sql);
		return $data;
	}
	
	function insert_data_surat($dta)
	{
		return $this->db->insert('tbl_surat_jalan_master', $dta);
	}

	function insert_detail_data_surat($dta)
	{
		return $this->db->insert('tbl_surat_jalan_detail', $dta);
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