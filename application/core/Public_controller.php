<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 
 */
class Public_controller extends MY_Controller
{
	
	public function __construct()
	{
		parent::__construct();
		if (! $this->user_id = $this->session->user_id)
			return redirect('login');
		$this->load->model('main_model', 'main');
		$this->balance = "0";
		$this->points = "0";
		if (!$this->session->fname || !$this->session->lname || !$this->session->phone) {
			$user = $this->main->get('users', 'id user_id, fname, lname, phone', ['id' => $this->user_id]);
			$this->session->set_userdata($user);
		}
	}
}