<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Admins extends Admin_controller {

	protected $redirect = 'admins';
	protected $name = 'admins';
	protected $title = 'admins';
	protected $table = 'admins';
    protected $access = ['Super admin'];

	public function index()
	{
		$data['name'] = $this->name;
        $data['title'] = $this->title;
        $data['url'] = $this->redirect;
        $data['dataTable'] = true;

		return $this->template->load('template', $this->redirect.'/home', $data);
	}

    public function get()
    {
        $this->load->model('admins_model', 'data');
        $fetch_data = $this->data->make_datatables();
        $sr = $_POST['start'] + 1;
        $data = [];
        foreach($fetch_data as $row)
        {  
            $sub_array = [];
            $sub_array[] = $sr;
            $sub_array[] = $row->name;
            $sub_array[] = $row->mobile;
            $sub_array[] = $row->email;
            $sub_array[] = $row->role;

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
            $post = [ 
            			'name' => $this->input->post('name'),
            			'mobile' => $this->input->post('mobile'),
            			'password' => my_crypt($this->input->post('password')),
            			'email' => $this->input->post('email'),
            			'role' => $this->input->post('role'),
            			'otp' => 123456,
            			'last_update' => date("Y-m-d H:i:s")
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
            $data['data'] = $this->main->get($this->table, 'mobile, name, email, role', ['id' => d_id($id)]);

            if ($data['data'])
                return $this->template->load(admin('template'), $this->redirect.'/update', $data);
            else
                return $this->error_404();
        }
        else
        { 
            $post = [ 
            			'name' => $this->input->post('name'),
            			'mobile' => $this->input->post('mobile'),
            			'email' => $this->input->post('email'),
            			'role' => $this->input->post('role'),
            			'last_update' => date("Y-m-d H:i:s")
            		];
           	if ($this->input->post('password'))
           		$post['password'] = my_crypt($this->input->post('password'));
           	
            $uid = $this->main->update(['id' => d_id($id)], $post, $this->table);

            flashMsg($uid, ucwords($this->title)." updated successfully.", ucwords($this->title)." not updated. Try again.", $this->redirect);
        }
    }

    public function delete()
    {
        $id = $this->main->update(['id' => d_id($this->input->post('id'))], ['is_deleted' => 1], $this->table);

        flashMsg($id, ucwords($this->title)." deleted successfully.", ucwords($this->title)." not deleted. Try again.", $this->redirect);
    }

    public function mobile_check($str)
    {   

        $id = $this->uri->segment(4);
        $mob = $this->main->check($this->table, array('mobile' => $str), 'id');
        if ((!empty($id) && $mob != d_id($id)) || ($mob && empty($id)))
        {
            $this->form_validation->set_message('mobile_check', 'The %s is already in use');
            return FALSE;
        } else{
            return TRUE;
        }
    }

    public function password_check($str)
    {   
        $id = $this->uri->segment(4);
        
        if (empty($id) && $str == '')
        {
            $this->form_validation->set_message('password_check', '%s is required');
            return FALSE;
        } else{
            return TRUE;
        }
    }

    public function email_check($str)
    {   

        $id = $this->uri->segment(4);
        $email = $this->main->check($this->table, array('email' => $str), 'id');
        if ((!empty($id) && $email != d_id($id)) || ($email && empty($id)))
        {
            $this->form_validation->set_message('email_check', 'The %s is already in use');
            return FALSE;
        } else{
            return TRUE;
        }
    }

    protected $validate = [
        [
            'field' => 'name',
            'label' => 'Name',
            'rules' => 'required',
            'errors' => [
                'required' => "%s is Required"
            ]
        ],
        [
            'field' => 'mobile',
            'label' => 'Mobile no',
            'rules' => 'required|numeric|exact_length[10]|callback_mobile_check',
            'errors' => [
                'required' => "%s is Required",
                'numeric' => "%s is not valid",
                'exact_length' => "%s is not valid"
            ]
        ],
        [
            'field' => 'email',
            'label' => 'Email',
            'rules' => 'required|callback_email_check',
            'errors' => [
                'required' => "%s is Required"
            ]
        ],
        [
            'field' => 'role',
            'label' => 'Role',
            'rules' => 'required',
            'errors' => [
                'required' => "%s is Required"
            ]
        ],
        [
            'field' => 'password',
            'label' => 'Password',
            'rules' => 'callback_password_check'
        ]
    ];
}
