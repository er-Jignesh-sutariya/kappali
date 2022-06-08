<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_controller  {

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
                        ],
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
            $data['name'] = 'login';
            $data['title'] = 'login';
		    return $this->template->load('auth/template', 'auth/login', $data);
        }else{
            $post['phone'] = $this->input->post('phone');
            $post['password'] = md5($this->input->post('password'));
            
            $user = $this->main->get('users', 'id user_id, fname, lname, phone, balance, app_no, society, nearby, area, vehicle_no', $post);

            if ($user) {
                $this->session->set_userdata($user);
                return redirect('');
                /* $otp = [    
                          'mobile'     => $post['phone'],
                          'otp'        => rand(1000, 9999),
                          'created_at' => date("Y-m-d H:i:s")
                       ];
                if (!$this->main->check('otp_check', ['mobile' => $post['phone']], 'mobile'))
                    $id = $this->main->add($otp, 'otp_check');
                else
                    $id = $this->main->update(['mobile' => $post['phone']], $otp, 'otp_check');
                if ($id) {
                    $sms = "Dear customer ".$otp['otp']." is the OTP for your login in KAPPALI APP. For any query pls contact : kappali.info@gmail.com Thanks for choosing 'KAPPALI'";
                    send_sms($post['phone'], $sms);
                    $this->session->set_flashdata($post);
                    return redirect('checkOtp');
                }else{
                    $this->session->set_flashdata('error', 'OTP not send. Try again.');
                    return redirect('login');
                } */
            }else{
                $this->session->set_flashdata('error', 'Invalid credentials.');
                // $this->session->set_flashdata('error', 'Mobile not registered.');
                return redirect('login');
            }
        }
	}

	public function registration()
	{
		$this->form_validation->set_rules($this->validate);
        if ($this->form_validation->run() == FALSE)
        {
			$data['name'] = 'registration';
			$data['title'] = 'registration';
            $data['areas'] = $this->main->getall('areas', 'id, area, pincode', ['is_deleted' => 0], 'area ASC');

            return $this->template->load('auth/template', 'auth/registration', $data);
        }
        else
        {
            $area = $this->main->check('areas', ['area' => $this->input->post('area'), 'is_deleted' => 0], 'id');
            if (!$area)
                $area = $this->main->add(['area' => $this->input->post('area'), 'pincode' => 111111], 'areas');
        	
            $post = [
        		'fname' => $this->input->post('fname'),
        		'lname' => $this->input->post('lname'),
        		'phone' => $this->input->post('phone'),
                'app_no' => $this->input->post('app_no'),
                'society' => $this->input->post('society'),
                'password' => md5($this->input->post('password')),
                'nearby' => $this->input->post('nearby'),
                'area' => $area,
        	];
            
            $otp = [    
                      'mobile'     => $post['phone'],
                      'otp'        => rand(1000, 9999),
                      'created_at' => date("Y-m-d H:i:s")
                   ];

            if (!$this->main->check('otp_check', ['mobile' => $post['phone']], 'mobile'))
                $id = $this->main->add($otp, 'otp_check');
            else
                $id = $this->main->update(['mobile' => $post['phone']], $otp, 'otp_check');
            
            if ($id) {

                $sms = $this->config->item('otp_sms')['sms'];
                $sms = str_replace('{var}', $otp['otp'], $sms);
                send_sms($post['phone'], $sms, $this->config->item('otp_sms')['temp']);
                $this->session->set_flashdata($post);
                return redirect('checkOtp');
            }else{
                $this->session->set_flashdata('error', 'OTP not send. Try again.');
                return redirect('registration');
            }
        }
	}

    public function checkOtp()
    {
        $post = $this->session->flashdata();
        $this->session->set_flashdata($post);
        if (!$post['phone']) return redirect('login');
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
                      'mobile'         => $post['phone'],
                      'otp'            => $this->input->post('otp'),
                      'created_at <= ' => date("Y-m-d H:i:s", strtotime('+5 minutes'))
                   ];

            if ($this->main->check('otp_check', $otp, 'mobile')){
                $add = [
                    'fname'   => $post['fname'],
                    'lname'   => $post['lname'],
                    'phone'   => $post['phone'],
                    'password'=> $post['password'],
                    'app_no'  => $post['app_no'],
                    'society' => $post['society'],
                    'nearby'  => $post['nearby'],
                    'area'    => $post['area'],
                ];
                $user = $this->main->get('users', 'id user_id, fname, lname, phone', ['phone' => $add['phone']]);
                if (!$user) {
                    $add['user_id'] = $this->main->add($add, 'users');
                    $this->session->set_userdata($add);
                }else
                    $this->session->set_userdata($user);
                $this->main->delete('otp_check', $otp);
                return redirect('');
            }else{
                $this->session->set_flashdata('error', 'Invalid OTP. Try again.');
                return redirect('checkOtp');
            }
        }
    }

	public function terms()
	{
		$data['name'] = 'terms';
        $data['title'] = 'terms & conditions';
        return $this->template->load('auth/template', 'terms', $data);
	}

    public function privacy()
    {
        $data['name'] = 'privacy';
        $data['title'] = 'privacy policy';
        return $this->template->load('auth/template', 'privacy', $data);
    }

    public function error_404()
    {
        return $this->load->view('error_404');
    }

	protected $validate = [
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
            'rules' => 'required|numeric|exact_length[10]',
            'errors' => [
                'required' => "%s is Required"
            ]
        ],
        [
            'field' => 'password',
            'label' => 'Password',
            'rules' => 'required',
            'errors' => [
                'required' => "%s is Required"
            ]
        ],
        [
            'field' => 'app_no',
            'label' => 'Flat no. / Appartment no.',
            'rules' => 'required',
            'errors' => [
            'required' => "%s is Required"
            ]
        ],
        [
            'field' => 'society',
            'label' => 'Society',
            'rules' => 'required',
            'errors' => [
            'required' => "%s is Required"
            ]
        ],
        [
            'field' => 'nearby',
            'label' => 'Nearby Area',
            'rules' => 'required',
            'errors' => [
            'required' => "%s is Required"
            ]
        ],
        [
            'field' => 'area',
            'label' => 'Area',
            'rules' => 'required',
            'errors' => [
            'required' => "%s is Required"
            ]
        ]
    ];
}