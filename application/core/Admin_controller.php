<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 
 */
class Admin_controller extends MY_Controller
{
	
	public function __construct()
	{
		parent::__construct();
		$this->auth = $this->session->auth;
		if (!$this->auth) 
			return redirect(admin('login'));

		$this->load->model('main_model', 'main');
		$this->user = (object) $this->main->get('admins', 'UCASE(name) name, mobile, email, role', ['id' => $this->auth]);
		$this->role = $this->user->role;
		if (!in_array($this->role, $this->access))
			return redirect(admin('unauthorised'));
		$this->redirect = admin($this->redirect);
	}

	public function error_404()
	{
		$data['name'] = 'error 404';
		$data['title'] = 'error 404';
		$data['error'] = '404';
		$data['message'] = "UH OH! You're lost.";
		$data['msg'] = "The page you are looking for does not exist. How you got here is a mystery. But you can click the button below to go back to the homepage.";
		$data['url'] = $this->redirect;
		return $this->template->load('template', 'error_404', $data);
	}

    public function unauthorised()
    {   
        $data['name'] = 'unauthorised';
        $data['title'] = 'unauthorised';
        $data['error'] = '403';
        $data['message'] = "UH OH! You're not authorised.";
		$data['msg'] = "The page you are looking for is not authorised. How you got here is a mystery. But you can click the button below to go back to the homepage.";
        $data['url'] = $this->redirect;
        
        return $this->template->load('template', 'error_404', $data);
    }
}