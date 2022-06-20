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

	public function addOrder($d, $wallet)
	{
		$post = [
			'payment_id'      => "Wallet discount",
			'user_id'         => $d['user_id'],
			'vehicle_no'      => $d['vehicle_no'],
			'vehicle_company' => $d['vehicle_company'],
			'vehicle_model'   => $d['vehicle_model'],
			'wash_date'       => $d['wash_date'],
			'wash_time'       => $d['wash_time'],
			'washes'          => $d['washes'],
			'created_at'      => time(),
			'discount'		  => $d['discount']
		];
		
		$this->db->trans_start();

		$this->db->insert('car_washes', $post);
		$this->db->update('users', $wallet, ['id' => $d['user_id']]);

		$this->db->trans_complete();

		return $this->db->trans_status();
	}
}