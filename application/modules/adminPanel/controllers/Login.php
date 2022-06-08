<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $auth = $this->session->auth;
        if ($auth) 
            return redirect(admin());

        $this->load->model('main_model', 'main');
    }

	protected $table = 'admins';
	
    protected $login = [
        [
            'field' => 'mobile',
            'label' => 'Mobile No.',
            'rules' => 'required|numeric|exact_length[10]',
            'errors' => [
                'required' => "%s is Required",
                'numeric' => "%s is Invalid",
                'exact_length' => "%s is Invalid",
            ],
        ],
        [
            'field' => 'password',
            'label' => 'Password',
            'rules' => 'required',
            'errors' => [
                'required' => "%s is Required"
            ],
        ]
    ];

	public function index()
    {
    	$data['title'] = 'login';
    	$this->form_validation->set_rules($this->login);

    	if ($this->form_validation->run() == FALSE)
    		return $this->template->load('auth/template', 'auth/login', $data);
    	else{
    		$post = [
    			'mobile'   	 => $this->input->post('mobile'),
    			'password'   => my_crypt($this->input->post('password'))
    		];
            
            $user = $this->main->get($this->table, 'id auth', $post);
            
            if ($user) {
    			$this->session->set_userdata($user);
    			return redirect(admin());
    		}else{
    			$this->session->set_flashdata(['title' => 'Error ! ', 'notify' => 'danger', 'message' => 'Invalid credentials.']);
    			return redirect(admin('login'));
    		}
    	}
    }

    public function forgot_password()
    {
        $data['title'] = 'forgot password';
        $forgot = [
                    [
                        'field' => 'mobile',
                        'label' => 'Email OR Mobile No.',
                        'rules' => 'required',
                        'errors' => [
                            'required' => "%s"
                        ],
                    ]
                ];

        $this->form_validation->set_rules($forgot);
        if ($this->form_validation->run() == FALSE) {
            return $this->template->load('auth/template', 'auth/forgot_password', $data);
        }else{

            $mobile = $this->input->post('mobile');
            $user = $this->main->get($this->table, 'id, email', "email = '".$mobile."' OR mobile = '".$mobile."'");
            
            if ($user) {
                $otp =  rand(100000, 999999);
                $otp =  123456;
                
                $this->main->update($user, ['otp' => $otp, 'last_update' => date('Y-m-d H:i:s')], $this->table);

                $this->load->library('email');
                $message = "Yor OTP for password reset - ".$otp;

                $this->email->clear();
                $this->email->set_newline("\r\n");
                $this->email->from($this->main->check($this->table, ['id' => 1], 'email'));
                $this->email->to($user['email']);
                $this->email->subject('Yor OTP for password reset.');
                $this->email->message($message);
                if ($this->email->send()) {
                    $this->session->set_flashdata(['title' => 'Success | ','notify' => 'success', 'message' => 'Email Sent Successfull to your email address.', 'emailCheck' => $user['email']]);
                    return redirect(admin('checkOtp'));
                }else{
                    $this->session->set_flashdata(['title' => 'Error ! ', 'notify' => 'danger', 'message' => 'Email not sent. Please try again.']);
                    return redirect(admin('forgot-password'));
                }
            }else{
                $this->session->set_flashdata(['title' => 'Error ! ', 'notify' => 'danger', 'message' => 'Mobile No. not registered.']);
                return redirect(admin('forgot-password'));
            }
        }
    }

    public function checkOtp()
    {
        if (!$this->session->emailCheck): return redirect(admin('forgot-password')); endif;
     
        $data['title'] = 'OTP Verify';
        
        $this->form_validation->set_rules('otp', 'OTP', 'required', ['required' => "%s is Required"]);

        if ($this->form_validation->run() == FALSE){
            $this->session->set_flashdata('emailCheck', $this->session->emailCheck);
            return $this->template->load('auth/template', 'auth/check_otp', $data);
        }
        else{
            $post = [
                'email'           => $this->session->emailCheck,
                'otp'             => $this->input->post('otp'),
                'last_update >= ' => date('Y-m-d H:i:s', strtotime('-5 minutes'))
            ];

            $user = $this->main->check($this->table, $post, 'id');
            
            if ($user) {
                $flash = ['title' => 'Success | ', 'notify' => 'success', 'message' => 'OTP match. Change your password.', 'adminId' => $user];
                $this->session->set_flashdata($flash);
                return redirect(admin('changePassword'));
            }else{
                $flash = ['title' => 'Error ! ', 'notify' => 'danger', 'message' => 'OTP not match. Please try again.', 'emailCheck' => $this->session->emailCheck];
                $this->session->set_flashdata($flash);
                return redirect(admin('checkOtp'));
            }
        }
    }

    public function changePassword()
    {
        if (empty($this->session->adminId)): return redirect(admin('login')); endif;
        if ($_SERVER['HTTP_HOST'] === 'localhost'):
            $this->session->set_flashdata('adminId', $this->session->adminId);
        endif;
        $data['title'] = 'Change Password';

        $this->form_validation->set_rules('password', 'Password', 'required', ['required' => "%s is Required"]);
        $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required|matches[password]', ['required' => "%s is Required", 'matches' => "%s is Differ than Password"]);

        if ($this->form_validation->run() == FALSE) {
            return $this->template->load('auth/template', 'auth/change_password', $data);
        }else{
            $post = ['password' => my_crypt($this->input->post('password'))];
            $id = $this->main->update(['id' => $this->session->adminId], $post, $this->table);
            
            if ($id) {
                $flash = ['title' => 'Success | ', 'notify' => 'success', 'message' => 'Password changed. Login with new password.'];
                $this->session->set_flashdata($flash);
                return redirect(admin('login'));
            }else{
                $flash = ['title' => 'Error ! ', 'notify' => 'danger', 'message' => 'Password not changed. Please try again.', 'adminId' => $this->session->adminId];
                $this->session->set_flashdata($flash);
                return redirect(admin('changePassword'));
            }
        }
    }
}
