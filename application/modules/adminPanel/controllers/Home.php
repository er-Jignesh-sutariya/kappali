<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends Admin_controller {

	protected $redirect = '';
	protected $table = 'admins';
    protected $access = ['Super admin', 'Admin', 'Delivery boy'];

	public function index()
	{
        $this->load->model('article_model');
        
		$data['name'] = 'dashboard';
		$data['title'] = 'dashboard';
		$data['url'] = $this->redirect;
        $data['article'] = $this->article_model->count();
        
		return $this->template->load('template', 'dashboard', $data);
	}

	public function profile()
	{
		$this->form_validation->set_rules($this->validate);
        if ($this->form_validation->run() == FALSE)
        {
			$data['name'] = 'dashboard';
			$data['title'] = 'profile';
			$data['url'] = $this->redirect;

			return $this->template->load('template', 'profile', $data);
        }else{
        	$post = [
                'name'        => $this->input->post('name'),
                'mobile'      => $this->input->post('mobile'),
                'email'       => $this->input->post('email')
            ];

            if ($this->input->post('password')) 
                $post['password'] = my_crypt($this->input->post('password'));

        	$id = $this->main->update(['id' => $this->auth], $post, $this->table);
        	
        	if ($id)
            	$this->session->set_userdata($this->main->get($this->table, 'id auth, UCASE(name) name, mobile, email', ['id' => $this->auth]));

			flashMsg($id, "Profile updated successfully.", "Profile not updated. Try again.", $this->redirect.'/profile');
        }
	}

    public function upload()
    {
        $config = [
            'upload_path'      => 'assets/images/',
            'allowed_types'    => 'jpg|jpeg|png',
            'file_name'        => time(),
            'file_ext_tolower' => TRUE
        ];

        $this->load->library('upload');
        $this->upload->initialize($config);
        
        if (!$this->upload->do_upload("image"))
            flashMsg(0, '', strip_tags($this->upload->display_errors()), $this->redirect);
        else{
            $img = $this->input->post('image');
            $post = [
                        'image'  => $this->upload->data("file_name")
                    ];

            $uid = $this->main->update(['page'  => $this->input->post('page')], $post, 'images');

            if ($uid && !empty($_FILES['image']['name']) && $img != 'default.jpg' && file_exists('assets/images/'.$img))
                unlink('assets/images/'.$img);

            flashMsg($uid, ucwords($this->title)." updated successfully.", ucwords($this->title)." not updated. Try again.", $this->redirect);
        }
    }

    public function logout()
    {
        $this->session->sess_destroy();
        return redirect(admin('login'));
    }

	public function database()
	{
		// Load the DB utility class
        $this->load->dbutil();
        
        // Backup your entire database and assign it to a variable
        $backup = $this->dbutil->backup();

        // Load the download helper and send the file to your desktop
        $this->load->helper('download');
        force_download(APP_NAME.'.zip', $backup);

        return redirect(admin());
	}

    public function mobile_check($str)
    {   
        if ($this->main->check($this->table, ['mobile' => $str, 'id != ' => $this->auth], 'id'))
        {
            $this->form_validation->set_message('mobile_check', 'The %s is already in use');
            return FALSE;
        } else
            return TRUE;
    }

    public function email_check($str)
    {   
        if ($this->main->check($this->table, ['email' => $str, 'id != ' => $this->auth], 'id'))
        {
            $this->form_validation->set_message('email_check', 'The %s is already in use');
            return FALSE;
        } else
            return TRUE;
    }

    protected $validate = [
        [
            'field' => 'name',
            'label' => 'User Name',
            'rules' => 'required',
            'errors' => [
                'required' => "%s is Required"
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
            'field' => 'mobile',
            'label' => 'Mobile No.',
            'rules' => 'required|exact_length[10]|callback_mobile_check|numeric',
            'errors' => [
                'required' => "%s is Required",
                'numeric' => "%s is Invalid",
                'exact_length' => "%s is Invalid",
            ]
        ]
    ];
}
