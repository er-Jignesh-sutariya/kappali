<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Category extends Admin_controller {

	protected $redirect = 'category';
	protected $name = 'category';
	protected $title = 'category';
	protected $table = 'category';
    protected $cat_type = 'Scrap';
    protected $access = ['Super admin'];

	public function index()
	{
		$data['name'] = $this->name;
        $data['title'] = $this->title;
        $data['url'] = $this->redirect;
        $data['dataTable'] = true;
        $data['cat_type'] = $this->cat_type;

		return $this->template->load('template', $this->redirect.'/home', $data);
	}

    public function get()
    {
        $this->load->model('category_model', 'data');
        $fetch_data = $this->data->make_datatables();
        $sr = $_POST['start'] + 1;
        $data = [];
        foreach($fetch_data as $row)
        {  
            $sub_array = [];
            $sub_array[] = $sr;
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
            
            return $this->template->load(admin('template'), $this->redirect.'/add', $data);
        }
        else
        { 
            $post = [ 'cat_name' => $this->input->post('cat_name') ];
            
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
            $data['data'] = $this->main->get($this->table, 'cat_name', ['id' => d_id($id)]);

            if ($data['data'])
                return $this->template->load(admin('template'), $this->redirect.'/update', $data);
            else
                return $this->error_404();
        }
        else
        { 
            $post = [ 'cat_name' => $this->input->post('cat_name') ];

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
            'field' => 'cat_name',
            'label' => 'Category name',
            'rules' => 'required',
            'errors' => [
                'required' => "%s is Required"
            ]
        ]
    ];
}
