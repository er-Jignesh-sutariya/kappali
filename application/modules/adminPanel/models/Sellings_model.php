<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 
 */
class Sellings_model extends Admin_model
{
    public $table = "sellings s";
    public $select_column = ['s.id', 'name', 'phone', 'app_no', 'nearby', 'society', 'CONCAT(a.area, " - ", a.pincode) area', 'prods', 'create_date', 'status', 'order_type'];
    public $search_column = ['name', 'phone', 'app_no', 'nearby', 'society', 'a.area', 'prods', 'create_date', 'status'];
    public $order_column = [null, null, 'status', 'order_type', 'name', 'phone', 'app_no', 'prods', 'create_date'];
    public $order = ['s.id' => 'DESC'];

    public function make_query()  
    {  
        $this->db->select($this->select_column)
                 ->from($this->table)
                 ->join('areas a', 'a.id = s.area');
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
        return $this->db->select('s.id')
                         ->from($this->table)
                         ->join('areas a', 'a.id = s.area')
                         ->get()
                         ->num_rows();
    }

    public function getPrint()
    {
        return $this->db->select($this->select_column)
                         ->from($this->table)
                         ->where(['status' => 'Pending', 'create_date' => date("Y-m-d")])
                         ->join('areas a', 'a.id = s.area')
                         ->get()
                         ->result();
    }

    public function saveSelling($id)
    {
        $this->db->trans_begin();
        foreach ($this->input->post('prods') as $prod_id => $kg) {
            if ($kg) {
                $post = [
                    'sell_id' => d_id($id),
                    'item' => $this->main->check('ratelist', ['id' => $prod_id], 'item_name'),
                    'rate' => $this->main->check('ratelist', ['id' => $prod_id], 'item_rate'),
                    'rec_kg' => $kg,
                    'create_date' => date("Y-m-d")
                ];

                $this->db->insert('recieved_items', $post);
            }
        }

        $this->db->where(['id' => d_id($id)])->update($this->table, ['vendor_name' => $this->input->post('vendor_name'), 'status' =>
        "Completed", 'received_by' => $this->auth]);

        if ($this->db->trans_status() === FALSE)
        {
            $this->db->trans_rollback();
            return FALSE;
        }
        else
        {
            $this->db->trans_commit();
            return TRUE;
        }
    }

    public function getSelling($id)
    {
        return $this->db->select('id, r.rate, r.rec_kg, r.create_date, UCASE(r.item) item')
                        ->from('recieved_items r')
                        ->where(['sell_id' => $id])
                        ->get()
                        ->result();
    }
}