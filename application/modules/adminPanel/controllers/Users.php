<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends Admin_controller {

	protected $redirect = 'users';
	protected $name = 'users';
	protected $title = 'users';
	protected $table = 'users';
    protected $access = ['Super admin', 'Admin'];

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
        $this->load->model('users_model', 'data');
        $fetch_data = $this->data->make_datatables();
        $sr = $_POST['start'] + 1;
        $data = [];
        foreach($fetch_data as $row)
        {  
            $sub_array = [];
            $sub_array[] = $sr;
            $sub_array[] = $row->fname.' '.$row->lname;
            $sub_array[] = $row->phone;
            $sub_array[] = $row->balance;

            $action = '<div style="display: flex;">';

            $action .= anchor($this->redirect.'/balance/'.e_id($row->id), '<i class="fa fa-rupee"></i>', 'class="btn btn-primary btn-outline-primary btn-icon mr-1"');

            /*$action .= form_open($this->redirect.'/delete', 'id="'.e_id($row->id).'"', ['id' => e_id($row->id)]).
                form_button([ 'content' => '<i class="fa fa-trash"></i>', 
                    'type'  => 'button',
                    'class' => 'btn btn-danger btn-outline-danger btn-icon', 
                    'onclick' => "script.delete(".e_id($row->id)."); return false;"]).
                form_close();*/

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

    public function balance($id)
    {
        $this->form_validation->set_rules($this->validate);
        if ($this->form_validation->run() == FALSE)
        {
            $data['id'] = $id;
            $data['name'] = $this->name;
            $data['title'] = $this->title;
            $data['url'] = $this->redirect;
            $data['operation'] = 'balance';
            $data['data'] = $this->main->get($this->table, 'fname, lname, phone, balance', ['id' => d_id($id)]);

            if ($data['data'])
                return $this->template->load(admin('template'), $this->redirect.'/balance', $data);
            else
                return $this->error_404();
        }
        else
        { 
            $bal =  ($this->input->post('interior') ? $this->input->post('interior') : 0) + ($this->input->post('exterior') ? $this->input->post('exterior') : 0);
            /* $sms = $this->config->item('balance_add')['sms'];
            $sms = str_replace('{#var#}', $bal, $sms);
            send_sms(9974092050, $sms, $this->config->item('balance_add')['temp']); */
            
            $post = [
                        'balance' => $this->input->post('balance') + $bal
                    ];
            
            $uid = $this->main->update(['id' => d_id($id)], $post, $this->table);

            flashMsg($uid, ucwords($this->title)." updated successfully.", ucwords($this->title)." not updated. Try again.", $this->redirect);
        }
    }

    public function add()
    {
        $this->form_validation->set_rules($this->user);
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
                        'fname' => $post['fname'],
                        'lname' => $post['lname'],
                        'phone' => $post['phone'] 
                    ];
            
            $id = $this->main->add($post, $this->table);

            flashMsg($id, ucwords($this->title)." added successfully.", ucwords($this->title)." not added. Try again.", $this->redirect);
        }
    }

    protected $user = [
        [
            'field' => 'fname',
            'label' => 'First Name',
            'rules' => 'required',
            'errors' => [
                'required' => "%s is Required"
            ]
        ],
        [
            'field' => 'lname',
            'label' => 'Last Name',
            'rules' => 'required',
            'errors' => [
                'required' => "%s is Required"
            ]
        ],
        [
            'field' => 'phone',
            'label' => 'Mobile no',
            'rules' => 'required|numeric|exact_length[10]|is_unique[users.phone]',
            'errors' => [
                'required' => "%s is Required",
                'numeric' => "%s is not valid",
                'exact_length' => "%s is not valid",
                'is_unique' => "%s is already in use"
            ]
        ]
    ];

    protected $validate = [
        [
            'field' => 'balance',
            'label' => 'Balance',
            'rules' => 'required|is_natural',
            'errors' => [
                'required' => "%s is Required",
                'is_natural' => "%s is Invalid"
            ]
        ],
        [
            'field' => 'interior',
            'label' => 'Interior',
            'rules' => 'is_natural',
            'errors' => [
                'is_natural' => "%s is Invalid"
            ]
        ],
        [
            'field' => 'exterior',
            'label' => 'Exterior',
            'rules' => 'is_natural',
            'errors' => [
                'is_natural' => "%s is Invalid"
            ]
        ]
    ];
}
