<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Ratelist extends Admin_controller {

	protected $redirect = 'ratelist';
	protected $name = 'ratelist';
	protected $title = 'ratelist';
	protected $table = 'ratelist';
    protected $cat_type = 'Scrap';
    protected $access = ['Super admin'];

	public function index()
	{
		$data['name'] = $this->name;
        $data['title'] = $this->title;
        $data['url'] = $this->redirect;
        $data['cat_type'] = $this->cat_type;
        $data['dataTable'] = true;

		return $this->template->load('template', $this->redirect.'/home', $data);
	}

    public function get()
    {
        $this->load->model('ratelist_model', 'data');
        $fetch_data = $this->data->make_datatables();
        $sr = $_POST['start'] + 1;
        $data = [];
        foreach($fetch_data as $row)
        {  
            $sub_array = [];
            $sub_array[] = $sr;
            $sub_array[] = $row->item_name;
            $sub_array[] = $row->item_rate;
            $sub_array[] = $row->cat_name;

            $action = '<div style="display: flex;">';

            $action .= anchor($this->redirect.'/update/'.e_id($row->id), '<i class="fa fa-edit"></i>', 'class="btn btn-primary btn-outline-primary btn-icon mr-1"');

            $action .= form_open($this->redirect.'/delete', 'id="'.e_id($row->id).'"', ['id' => e_id($row->id)]).
                form_button([ 'content' => '<i class="fa fa-trash"></i>', 
                    'type'  => 'button',
                    'class' => 'btn btn-danger btn-outline-danger btn-icon', 
                    'onclick' => "script.delete(".e_id($row->id)."); return false;"]).
                form_close();

            $action .= '</div>';
            $sub_array[] = $action;

            $data[] = $sub_array;  
            $sr++;
        }

        $output = [
            "draw"              => intval($_POST["draw"]),  
            "recordsTotal"      => $this->data->count(),
            "recordsFiltered"   => $this->data->get_filtered_data(),
            "data"              => $data
        ];
        
        echo json_encode($output);
    }

    public function add()
    {
        $this->form_validation->set_rules($this->validate);
        if ($this->form_validation->run() == FALSE)
        {
            $data['name'] = $this->name;
            $data['title'] = $this->title;
            $data['url'] = $this->redirect;
            $data['operation'] = 'add';
            $data['cats'] = $this->main->getall('category', 'id, cat_name', ['is_deleted' => 0, 'cat_type' => $this->cat_type]);
            
            return $this->template->load(admin('template'), $this->redirect.'/add', $data);
        }
        else
        { 
            $post = [ 
            	'item_name' => $this->input->post('item_name'), 
            	'item_rate' => $this->input->post('item_rate'),
            	'cat_id' => my_crypt($this->input->post('cat_id'), 'd')
            ];
            
            $id = $this->main->add($post, $this->table);

            flashMsg($id, ucwords($this->title)." added successfully.", ucwords($this->title)." not added. Try again.", $this->redirect);
        }
    }

    public function update($id)
    {
        $this->form_validation->set_rules($this->validate);
        if ($this->form_validation->run() == FALSE)
        {
            $data['id'] = $id;
            $data['name'] = $this->name;
            $data['title'] = $this->title;
            $data['url'] = $this->redirect;
            $data['operation'] = 'update';
            $data['data'] = $this->main->get($this->table, 'cat_id, item_name, item_rate', ['id' => d_id($id)]);
            $data['cats'] = $this->main->getall('category', 'id, cat_name', ['is_deleted' => 0, 'cat_type' => $this->cat_type]);

            if ($data['data'])
                return $this->template->load(admin('template'), $this->redirect.'/update', $data);
            else
                return $this->error_404();
        }
        else
        { 
            $post = [ 
            	'item_name' => $this->input->post('item_name'), 
            	'item_rate' => $this->input->post('item_rate'),
            	'cat_id' => my_crypt($this->input->post('cat_id'), 'd')
            ];

            $uid = $this->main->update(['id' => d_id($id)], $post, $this->table);

            flashMsg($uid, ucwords($this->title)." updated successfully.", ucwords($this->title)." not updated. Try again.", $this->redirect);
        }
    }

    public function delete()
    {
        $id = $this->main->update(['id' => d_id($this->input->post('id'))], ['is_deleted' => 1], $this->table);

        flashMsg($id, ucwords($this->title)." deleted successfully.", ucwords($this->title)." not deleted. Try again.", $this->redirect);
    }

    protected $validate = [
        [
            'field' => 'item_name',
            'label' => 'Item name',
            'rules' => 'required',
            'errors' => [
                'required' => "%s is Required"
            ]
        ],
        [
            'field' => 'item_rate',
            'label' => 'Item rate',
            'rules' => 'required',
            'errors' => [
                'required' => "%s is Required"
            ]
        ],
        [
            'field' => 'cat_id',
            'label' => 'Category name',
            'rules' => 'required',
            'errors' => [
                'required' => "%s is Required"
            ]
        ]
    ];
}
