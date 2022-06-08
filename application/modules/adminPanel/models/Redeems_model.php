<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 
 */
class Redeems_model extends Admin_model
{
    public $table = "redeems r";
    public $select_column = ['r.id', 'u.fname', 'u.lname', 'u.phone', 'r.points', 'r.payment_mode', 'r.create_date', 'r.status', 'r.trans_id'];
    public $search_column = ['u.fname', 'u.lname', 'u.phone', 'r.points', 'r.payment_mode', 'r.create_date', 'r.status', 'r.trans_id'];
    public $order_column = [null, 'u.fname', 'u.phone', 'r.points', 'r.payment_mode', 'r.create_date', 'r.status', 'r.trans_id', null];
    public $order = ['r.id' => 'DESC'];

    public function make_query()  
    {  
        $this->db->select($this->select_column)
                 ->from($this->table)
                 ->join("users u", "u.id = r.user_id");
        $i = 0;

        foreach ($this->search_column as $item) 
        {
            if($_POST['search']['value']) 
            {
                if($i===0) 
                {
                    $this->db->group_start(); 
                    $this->db->like($item, $_POST['search']['value']);
                }
                else
                {
                    $this->db->or_like($item, $_POST['search']['value']);
                }
 
                if(count($this->search_column) - 1 == $i) 
                    $this->db->group_end(); 
            }
            $i++;
        }
         
        if(isset($_POST['order'])) 
        {
            $this->db->order_by($this->order_column[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        }
        else if(isset($this->order))
        {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    public function count()
    {
        return $this->db->select('r.id')
                         ->from($this->table)
                         ->get()
                         ->num_rows();
    }
}