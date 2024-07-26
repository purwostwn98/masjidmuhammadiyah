<?php namespace App\Models;

use CodeIgniter\Model;

class WuryModel extends Model
{

	function getONE($tb,$klm,$whr){
		$builder = $this->db->table($tb);
		$builder->select($klm);
		if($whr){
			$builder->where($whr);
		}	
		$query = $builder->get();
		return $query->getRowArray();
	}
	function getAll($tb,$klm,$whr){
		$builder = $this->db->table($tb);
		$builder->select($klm);
		if($whr){
			$builder->where($whr);
		}	
		$query = $builder->get();
		return $query->getResultArray();
	}

	function UpdateDataBatch($tb,$data,$whr){
		
		$builder = $this->db->table($tb);
		return $builder->updateBatch($data,$whr);
	}

	function CloseTicket($casid)
	{
		$builder = $this->db->table('tbl_cas_ticket');
		$builder->delete(['ticket' => $casid]);
	} 
	function CreateData($tb,$data){
		$builder = $this->db->table($tb);
		return $builder->insert($data);
	}
	function UpdateData($tb,$data,$whr){
		$builder = $this->db->table($tb);
		$builder->set($data);
		$builder->where($whr);
		return $builder->update();
	}
	function DellData($tb,$whr){
		$builder = $this->db->table($tb);
		$builder->delete($whr);
	}
	function getAllJoint($tb,$klm,$whr,$tbj){
		$builder = $this->db->table($tb);
		$builder->select($klm);
		if($tbj){
			foreach($tbj as $join){
				$builder->join($join['tbj'], $join['tbon']);
			}
		}
		
		if($whr){
			$builder->where($whr);
		}	
		$query = $builder->get();
		return $query->getResultArray();
	}
	
	function CountData($tb,$cl,$whr){
		$builder = $this->db->table($tb);
		$builder->selectCount($cl);
		if($whr){
			$builder->where($whr);
		}
		$query = $builder->get();
		return $query->getRowArray();
	}
	function CountJoint($tb,$klm,$whr,$tbj){
		$builder = $this->db->table($tb);
		$builder->select($klm);
		if($tbj){
			foreach($tbj as $join){
				$builder->join($join['tbj'], $join['tbon']);
			}
		}
		
		if($whr){
			$builder->where($whr);
		}
		return $builder->countAll();	
	}

	function Read($qry){
		$db = db_connect();
		$query = $db->query($qry);
		return $query->getResultArray();
	}
	function ReadOneRow($qry){
		$db = db_connect();
		$query = $db->query($qry);
		return $query->getRowArray();
	}

	
	
}