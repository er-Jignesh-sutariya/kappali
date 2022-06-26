<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 
 */
class Main_model extends Public_model
{
	public function add($post, $table)
	{
		if ($this->db->insert($table, $post)) {
			$id = $this->db->insert_id();
			return ($id) ? $id : true;
		}else
			return false;
	}

	public function addOrder($d, $wallet = null)
	{
		$this->db->trans_start();

		$this->db->insert('car_washes', $d);

		if($wallet) $this->db->update('users', $wallet, ['id' => $d['user_id']]);

		$this->db->trans_complete();

		return $this->db->trans_status();
	}
}