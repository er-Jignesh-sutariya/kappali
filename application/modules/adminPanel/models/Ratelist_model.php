<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 
 */
class Ratelist_model extends Admin_model
{
    public $table = "ratelist r";
    public $select_column = ['r.id', 'r.item_name', 'r.item_rate', 'c.cat_name'];
    public $search_column = ['r.item_name', 'r.item_rate', 'c.cat_name'];
    public $order_column = [null, 'r.item_name', 'r.item_rate', 'c.cat_name', null];
    public $order = ['r.id' => 'DESC'];

    public function make_query()  
    {  
        $this->db->select($this->select_column)
                 ->from($this->table)
                 ->where(['r.is_deleted' => 0, 'c.is_deleted' => 0])
                 ->where(['c.cat_type' => $this->input->post('cat_type')])
                 ->join('category c', 'c.id = r.cat_id');
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
                        ->where(['r.is_deleted' => 0, 'c.is_deleted' => 0])
                        ->where(['c.cat_type' => $this->input->post('cat_type')])
                 		->join('category c', 'c.id = r.cat_id')
                        ->get()
                        ->num_rows();
    }
}