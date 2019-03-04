<?php
class M_complain extends CI_Model 
{
	function fetch_data_complain($level,$user,$like_value = NULL, $column_order = NULL, $column_dir = NULL, $limit_start = NULL, $limit_length = NULL)
	{
	$sql="";
	if($level == 'admin'){
		
		$sql = "
		SELECT 
			(@row:=@row+1) AS nomor, 
			a.id_complain,
			b.nama,
			a.subject,
			a.description, 
			DATE_FORMAT(a.tgl, '%d %b %Y - %H:%i:%s') AS tanggal,
			a.status_resolve,
			a.status
		FROM 
			data_complain AS a 
			LEFT JOIN pj_user AS b ON a.id_user = b.id_user
			, (SELECT @row := 0) r WHERE 1=1
		";
	}else if($level == 'user'){
		$sql = "
		SELECT 
			(@row:=@row+1) AS nomor, 
			a.id_complain,
			b.nama,
			a.subject,
			a.description, 
			DATE_FORMAT(a.tgl, '%d %b %Y - %H:%i:%s') AS tanggal,
			a.status_resolve,
			a.status
		FROM 
			data_complain AS a 
			LEFT JOIN pj_user AS b ON a.id_user = b.id_user
			, (SELECT @row := 0) r WHERE 1=1 AND a.id_user ='".$user."'
		";
	}

		$data['totalData'] = $this->db->query($sql)->num_rows();
		
		if( ! empty($like_value))
		{
			$sql .= " AND ( ";
			$sql .= "
				a.subject LIKE '%".$this->db->escape_like_str($like_value)."%' 
				OR b.nama LIKE '%".$this->db->escape_like_str($like_value)."%'
				OR DATE_FORMAT(a.tgl, '%d %b %Y') LIKE '%".$this->db->escape_like_str($like_value)."%'

			";
			$sql .= " ) ";
		}
		
		$data['totalFiltered']	= $this->db->query($sql)->num_rows();
		
		$columns_order_by = array( 
			0 => 'nomor',
			1 => 'a.nama',
			2 => 'a.subject',
			3 => 'a.description',
			4 => 'status_resolve',
			5 => 'status',
			6 => 'tanggal'
		);
		
		$sql .= " ORDER BY ".$columns_order_by[$column_order]." ".$column_dir.", nomor ";
		$sql .= " LIMIT ".$limit_start." ,".$limit_length." ";
		
		$data['query'] = $this->db->query($sql);
		return $data;
	}
	
	function add_complain($dta)
	{
		return $this->db->insert('data_complain', $dta);
	}
	
	function del_complain($id_complain)
	{
		$sql="DELETE data_complain,data_response 
			FROM data_complain,data_response
			WHERE data_complain.id_complain = data_response.id_complain
			AND data_complain.id_complain='".$id_complain."'";
		return $this->db->query($sql, array($id_complain));
	}
	
}