<?php defined('BASEPATH') OR exit('No direct script access allowed');

class ForgotPassword extends CI_controller  {

    public function __construct()
    {
        parent::__construct();
        if ($this->session->user_id)
            return redirect('');
        $this->load->model('main_model', 'main');
    }

    public function index()
	{
		$validate = [
                        [
                            'field' => 'phone',
                            'label' => 'Mobile no.',
                            'rules' => 'required|numeric|exact_length[10]',
                            'errors' => [
                                'required' => "%s is Required"
                            ]
                        ]
                    ];

        $this->form_validation->set_rules($validate);
        if ($this->form_validation->run() == FALSE)
        {
            $data['name'] = 'forgot_password';
            $data['title'] = 'forgot password';
		    return $this->template->load('auth/template', 'auth/forgot_password', $data);
        }else{
            $post['phone'] = $this->input->post('phone');

            $user = $this->main->get('users', 'id', $post);

            if ($user) {
                 $otp = [    
                    'mobile'     => $post['phone'],
                    'otp'        => rand(1000, 9999),
                    'created_at' => date("Y-m-d H:i:s")
                ];

                $this->main->delete('otp_check', ['mobile' => $post['phone']]);
                $this->main->add($otp, 'otp_check');
                $this->session->set_userdata('otp_id', $post['phone']);
                $sms = $this->config->item('otp_sms')['sms'];
                $sms = str_replace('{var}', $otp['otp'], $sms);
                send_sms($post['phone'], $sms, $this->config->item('otp_sms')['temp']);

                return redirect('checkOtp');
            }else{
                $this->session->set_flashdata('error', 'Mobile not registered.');
                return redirect('forgotPassword');
            }
        }
	}

    public function checkOtp()
    {
        $post = $this->session->userdata();

        if (!$post['otp_id']) return redirect('forgotPassword');
        
        $validate = [
                        [
                            'field' => 'otp',
                            'label' => 'OTP',
                            'rules' => 'required|numeric|exact_length[4]',
                            'errors' => [
                                'required' => "%s is Required"
                            ]
                        ]
                    ];

        $this->form_validation->set_rules($validate);

        if ($this->form_validation->run() == FALSE)
        {
            $data['name'] = 'check_otp';
            $data['title'] = 'check OTP';
            return $this->template->load('auth/template', 'auth/checkOtp', $data);
        }
        else
        {
            $otp = [    
                      'mobile'         => $post['otp_id'],
                      'otp'            => $this->input->post('otp'),
                      'created_at <= ' => date("Y-m-d H:i:s", strtotime('+5 minutes'))
                   ];
            
            if ($this->main->check('otp_check', $otp, 'mobile')){
                $user = $this->main->get('users', 'id verify_id', ['phone' => $post['otp_id']]);
                $this->session->set_userdata($user);
                return redirect('changePassword');
            }else{
                $this->session->set_flashdata('error', 'Invalid OTP. Try again.');
                return redirect('checkOtp');
            }
        }
    }

    public function changePassword()
    {
        $post = $this->session->userdata();

        if (!$post['verify_id']) return redirect('forgotPassword');

        $validate = [
                        [
                            'field' => 'password',
                            'label' => 'Password',
                            'rules' => 'required',
                            'errors' => [
                                'required' => "%s is Required"
                            ]
                        ]
                    ];

        $this->form_validation->set_rules($validate);

        if ($this->form_validation->run() == FALSE)
        {
            $data['name'] = 'changePassword';
            $data['title'] = 'Change Password';
            return $this->template->load('auth/template', 'auth/changePassword', $data);
        }
        else
        {
            $pass = [
                      'password' => md5($this->input->post('password'))
                   ];
            
            if ($this->main->update(['id' => $this->session->verify_id], $pass, 'users')){
                $this->session->unset_userdata(['verify_id', 'otp_id']);
                $this->session->set_flashdata('success', 'Password changed successfully.');
                return redirect('login');
            }else{
                $this->session->set_flashdata('error', 'Password not changed. Try again.');
                return redirect('changePassword');
            }
        }
    }
}