<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 
 */
class Car_wash_model extends Admin_model
{
    public $table = "car_washes c";
    public $select_column = ['c.id', 'c.vehicle_no', 'c.payment_id', 'c.status', 'c.vehicle_company', 'c.vehicle_model', 'c.wash_date', 'c.wash_time', 'c.discount', "CONCAT(u.app_no, ', ', u.society, ', ', u.nearby, ', ', a.area) AS address", "c.user_id"];
    public $search_column = ['c.id', 'c.vehicle_no', 'c.payment_id', 'c.status', 'c.vehicle_company', 'c.vehicle_model', 'c.wash_date', 'c.wash_time', 'c.discount'];
    public $order_column = [null, 'c.vehicle_no', 'c.payment_id', 'c.vehicle_company', 'c.vehicle_model', 'c.wash_date', 'c.wash_time', 'c.discount', 'c.status', null];
    public $order = ['c.id' => 'DESC'];

    public function make_query()  
    {  
        $this->db->select($this->select_column)
                 ->from($this->table)
                 ->join('users u', 'u.id = c.user_id')
                 ->join('areas a', 'a.id = u.area');
        
        foreach ($this->search_column as $i => $item) 
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
        return $this->db->select('c.id')
                         ->from($this->table)
                         ->get()
                         ->num_rows();
    }
}