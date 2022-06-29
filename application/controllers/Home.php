<?php defined('BASEPATH') OR exit('No direct script access allowed');
// use Paykun\Checkout\Payment;

class Home extends Public_controller  {

	private $article = "assets/images/article/";

	public function index()
	{
		$data['name'] = 'home';
		$data['title'] = 'home';
		$data['articles'] = $this->main->getall('article', 'id, title, details, CONCAT("'.$this->article.'", image) image, created, slug', ['is_deleted' => 0], 'id DESC');
		$this->balance = $this->main->check('users', ['id' => $this->user_id], 'balance');
		$this->points = $this->main->check('redeems', ['user_id' => $this->user_id], 'SUM(green_donation)');
		$this->points = ($this->points) ? $this->points : 0;
		return $this->template->load('template', 'home', $data);
	}

	public function about()
	{
		$data['name'] = 'about';
		$data['title'] = 'about';
		
		return $this->template->load('template', 'about', $data);
	}

	public function how_it_works()
	{
		$data['name'] = 'how-it-works';
		$data['title'] = 'how-it-works';
		
		return $this->template->load('template', 'how_it_works', $data);
	}

	public function upcoming()
	{
		$data['name'] = 'upcoming';
		$data['title'] = 'upcoming';
		
		return $this->template->load('template', 'upcoming', $data);
	}

	public function ratelist()
	{
		$data['name'] = 'ratelist';
		$data['title'] = 'ratelist';
		$data['category'] = $this->main->getall('category', 'id, cat_name', ['is_deleted' => 0]);
		foreach ($data['category'] as $k => $v)
			$data['category'][$k]['rates'] = $this->main->getall('ratelist', 'item_name, item_rate', ['is_deleted' => 0, 'cat_id' => $v['id']]);
		
		return $this->template->load('template', 'ratelist', $data);
	}

	public function article($slug)
	{
		$data['name'] = 'article';
		$data['title'] = 'article';
		$data['article'] = $this->main->get('article', 'title, details, CONCAT("'.$this->article.'", image) image, created, slug', ['id' => my_crypt($slug, 'd'), 'is_deleted' => 0]);

		if ($data['article'])
			return $this->template->load('template', 'article', $data);
		else
			return $this->error_404();
	}

	public function add_point()
	{
		$this->balance = $this->main->check('users', ['id' => $this->user_id], 'balance');
		if ($this->input->is_ajax_request()) {
			$post = [
				'points' => $this->balance,
				'green_donation' => 0,
			    'payment_mode' => $this->input->post('payment'),
			    'bank_acc' => $this->input->post('bank_acc'),
			    'bank_ifsc' => $this->input->post('bank_ifsc'),
			    'bank_mobile' => $this->input->post('bank_mobile'),
			    'bank_name' => $this->input->post('bank_name'),
			    'user_id' => $this->user_id,
			    'create_date' => date("Y-m-d")
			];
			
			if ($post['points'] >= 0 && $this->main->add($post, 'redeems')):
				$this->main->update(['id' => $this->user_id], ['balance' => 0], 'users');
				$msg = "Your request is saved.";
			else:
				$msg = "Your request is not saved.";
			endif;
			echo $msg;
		}else{
			$data['name'] = 'add_point';
			$data['title'] = 'add point';
			
			return $this->template->load('template', 'add_point', $data);
		}
	}

	public function rate_list()
	{
		$validate = [
			[
				'field' => 'rate_id[]',
				'label' => 'Select car',
				'rules' => 'required',
				'errors' => [
					'required' => "%s"
				]
			],
			[
				'field' => 'coupon_code',
				'label' => 'Coupon code',
				'rules' => 'max_length[20]',
				'errors' => [
					'max_length' => "%s is invalid"
				]
			]
		];

		$this->form_validation->set_rules($validate);

		if ($this->form_validation->run() == FALSE)
		{
			$data['name'] = 'rate_list';
			$data['title'] = 'apply coupon code';
			$data['coupons'] = $this->main->getall('coupons', 'image', ['is_deleted' => 0]);
			$data['rates'] = $this->main->getall('car_ratelist', 'id, item_name, item_rate, exterior_rate', ['is_deleted' => 0], 'item_name ASC');
			
			return $this->template->load('template', 'rate-list', $data);
		}else{
			$coupon = $this->input->post('coupon_code');
			$rate = 0;
			foreach ($this->input->post('rate_id') as $v) {
				$rate_id = explode(' - ', $v);
				$wash = d_id(reset($rate_id));
				
				if (end($rate_id) == 'Exterior')
					$p = $this->main->get('car_ratelist', 'exterior_rate rate', ['id' => $wash])['rate'];
				else
					$p = $this->main->get('car_ratelist', 'item_rate rate', ['id' => $wash])['rate'];
				$sess[] = ['id' => $wash, 'rate' => $p, 'wash' => end($rate_id)];
				$rate += $p;
			}
			
			$postData = [
				'appId' => appID,
				'orderId' => round(microtime(true) * 1000).$this->session->user_id,
				/* 'orderAmount' => $price, */
				'orderCurrency' => 'INR',
				'orderNote' => 'Car wash booking',
				'customerName' => $this->session->fname." ".$this->session->lname,
				'customerEmail' => 'test@mail.com',
				'customerPhone' => $this->session->phone,
				'returnUrl' => base_url('payment-form'),
				'notifyUrl' => base_url(),
			];
			
			if ($coupon && $check = $this->main->get('coupons', 'discount', ['c_code' => $coupon, 'is_deleted' => 0])) {
				$price = $rate * (100 - $check['discount']) / 100;
				$discount = $rate * ($check['discount']) / 100;
				$postData['orderAmount'] = $price;

			}else if (! $coupon) {
				$postData['orderAmount'] = $rate;
			}else{
				$this->session->set_flashdata('error', "Invalid coupon code.");
				return redirect('rate-list');
			}

			$balance = $this->main->check('users', ['id' => $this->user_id], 'balance');

			if($postData['orderAmount'] - $balance <= 0){
				$user = $this->main->get('users', 'id user_id, fname, lname, phone, balance, app_no, society, nearby, area, vehicle_no, vehicle_company, vehicle_model, wash_date, wash_time', ['id' => $this->user_id]);
				$user['washes'] = json_encode($sess);
				
				$wallet['balance'] = $postData['orderAmount'] - $d['balance'];
				
				$user['discount'] = isset($discount) ? $discount + $postData['orderAmount'] : $postData['orderAmount'];

				$post = [
					'payment_id'      => "Wallet discount",
					'user_id'         => $d['user_id'],
					'vehicle_no'      => $d['vehicle_no'],
					'vehicle_company' => $d['vehicle_company'],
					'vehicle_model'   => $d['vehicle_model'],
					'wash_date'       => $d['wash_date'],
					'wash_time'       => $d['wash_time'],
					'washes'          => $d['washes'],
					'created_at'      => time(),
					'discount'		  => $d['discount'],
					'c_code'		  => $coupon
				];

				if ($this->main->addOrder($post, $wallet)) {
					$this->session->set_flashdata('success', "Your order recieved succesfully.");
					return redirect('');
				}else{
					$this->session->set_flashdata('error', "Some error occured.");
					return redirect('rate-list');
				}
			}else{
				$postData['orderAmount'] = $postData['orderAmount'] - $balance;
				$discount = isset($discount) ? $discount + $balance : $balance;

				ksort($postData);
				$signatureData = "";
				foreach ($postData as $key => $value){
					$signatureData .= $key.$value;
				}
				$signature = hash_hmac('sha256', $signatureData, SEC_KEY, true);

				if (PAY_MODE == "PROD") {
					$url = "https://www.cashfree.com/checkout/post/submit";
				} else {
					$url = "https://test.cashfree.com/billpay/checkout/post/submit";
				}
				
				$postData['signature'] = base64_encode($signature);
				$postData['url'] = $url;
				$temp = [
					'user_id'  => $this->session->user_id,
					'orderId'  => $postData['orderId'],
					'washes'   => json_encode($sess),
					'balance'  => $balance,
					'discount' => isset($discount) ? $discount : 0,
					'c_code'   => $coupon
				];
				
				$check = $this->main->add($temp, 'temp_orders');

				if ($check) {
					return $this->load->view('cashfree', $postData);
				}else{
					$this->session->set_flashdata('error', "Some error occured.");
					return redirect('rate-list');
				}
			}
		}
	}

	public function car_wash()
	{
		$validate = [
			[
				'field' => 'vehicle_no',
				'label' => 'Vehicle no',
				'rules' => 'required|exact_length[10]|alpha_numeric',
				'errors' => [
					'required' => "%s is Required",
					'exact_length' => "%s is invalid",
					'alpha_numeric' => "%s is invalid",
				]
			],
			[
				'field' => 'wash_date',
				'label' => 'Wash date',
				'rules' => 'required',
				'errors' => [
					'required' => "%s is Required",
				]
			],
			[
				'field' => 'wash_time',
				'label' => 'Wash time',
				'rules' => 'required',
				'errors' => [
					'required' => "%s is Required",
				]
			],
		];

		$this->form_validation->set_rules($validate);

		if ($this->form_validation->run() == FALSE)
		{
			$data['name'] = 'car_wash';
			$data['title'] = 'car wash booking';
			$data['data'] = $this->main->get('users', 'vehicle_no, vehicle_company, vehicle_model', ['id' => $this->user_id]);
			$data['custs'] = $this->main->getall('customers', "CONCAT('assets/images/article/', image) image", ['is_deleted' => 0]);
			$data['notes'] = $this->main->getall('notes', 'note_details', ['is_deleted' => 0]);
			
			return $this->template->load('template', 'car_wash', $data);
		}else{
			$post = [
				'vehicle_no'      => $this->input->post('vehicle_no'),
				'vehicle_company' => $this->input->post('vehicle_company'),
				'vehicle_model'   => $this->input->post('vehicle_model'),
				'wash_date'       => $this->input->post('wash_date'),
				'wash_time'       => $this->input->post('wash_time'),
			];

			if ($this->main->update(['id' => $this->user_id], $post, 'users')):
				$this->session->set_flashdata('success', "Your data saved successfully.");
				return redirect('rate-list');
				/* $obj = new Payment('544987822992243', '8E8CD7D9C1736E9470BA229839003677', '49DE0C22652D5FE8FA3F11F3437C0B28', false);
				$obj->initOrder(time(), 'Car wash booking', "120", base_url('payment-forms'),  base_url('payment-form'));
				$obj->addCustomer($this->session->fname.' '.$this->session->lname, "test@mail.com", $this->session->phone);
				$obj->addShippingAddress('India', 'Gujarat', 'Ahmedabad', '999999', 'NA');
				$obj->addBillingAddress('India', 'Gujarat', 'Ahmedabad', '999999', 'NA');
				
				echo $obj->submit(); */
			else:
				$this->session->set_flashdata('error', "Some error occurs. Please try again.");
				return redirect('car-wash');
			endif;
		}
	}

	public function paymentThankyou()
	{
		$data['name'] = 'thankyou';
		$data['title'] = 'thank you';
		$this->balance = $this->main->check('users', ['id' => $this->user_id], 'balance');
		return $this->template->load('template', 'payment-thankyou', $data);
	}

	public function thankyou()
	{
		$data['name'] = 'thankyou';
		$data['title'] = 'thank you';
		
		return $this->template->load('template', 'thankyou', $data);
	}

	public function continue_success()
	{
		$data['name'] = 'continue_success';
		$data['title'] = 'thank you';
		
		return $this->template->load('template', 'continue_success', $data);
	}

	public function continue_form()
	{
		if (!$this->session->prods) return redirect('');
		$this->session->set_flashdata('prods', $this->session->prods);
		$validate = [
                        [
                            'field' => 'name',
                            'label' => 'Name',
                            'rules' => 'required',
                            'errors' => [
                                'required' => "%s is Required"
                            ]
                        ],
                        [
                            'field' => 'phone',
                            'label' => 'Mobile No.',
                            'rules' => 'required|numeric|exact_length[10]',
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

        $this->form_validation->set_rules($validate);
        if ($this->form_validation->run() == FALSE)
        {
            $data['name'] = 'continue_form';
			$data['title'] = 'continue_form';
			$data['areas'] = $this->main->getall('areas', 'id, area, pincode', ['is_deleted' => 0], 'area ASC');
			
			return $this->template->load('template', 'continue_form', $data);
        }else{
        	$post = [
        		'name' => $this->input->post('name'),
        		'phone' => $this->input->post('phone'),
        		'app_no' => $this->input->post('app_no'),
        		'society' => $this->input->post('society'),
        		'nearby' => $this->input->post('nearby'),
        		'area' => my_crypt($this->input->post('area'), 'd'),
        		'user_id' => $this->user_id,
        		'prods' => ucwords(implode(', ', $this->session->prods)),
        		'create_date' => date("Y-m-d")
        	];
        	
        	if ($this->main->add($post, 'sellings')):
        		$this->session->unset_userdata('prods');
        		$this->session->set_flashdata('success', "Your data saved successfully.");
        		return redirect('continue-success');
        	else:
        		$this->session->set_flashdata('error', "Some error occurs. Please try again.");
        		return redirect('continue-form');
        	endif;
        }
	}

	public function mobile_check($str)
    {   
        if ($this->main->check('users', ['phone' => $str, 'id != ' => $this->user_id], 'id'))
        {
            $this->form_validation->set_message('mobile_check', 'The %s is already in use');
            return FALSE;
        } else
            return TRUE;
    }

	public function profile()
	{
		if (!$this->session->user_id) return redirect('');
		
		$validate = [
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
                            'label' => 'Mobile No.',
                            'rules' => 'required|numeric|exact_length[10]|callback_mobile_check',
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

        $this->form_validation->set_rules($validate);
        if ($this->form_validation->run() == FALSE)
        {
            $data['name'] = 'profile';
			$data['title'] = 'profile';
			/* $data['areas'] = $this->main->getall('areas', 'id, area, pincode', ['is_deleted' => 0], 'area ASC'); */
			$data['data'] = $this->main->get('users', 'fname, lname, phone, app_no, society, nearby, area', ['id' => $this->session->user_id]);
			
			return $this->template->load('template', 'profile', $data);
        }else{

			$area = $this->main->check('areas', ['area' => $this->input->post('area'), 'is_deleted' => 0], 'id');
            if (!$area)
                $area = $this->main->add(['area' => $this->input->post('area'), 'pincode' => 111111], 'areas');

        	$post = [
        		'fname' => $this->input->post('fname'),
        		'lname' => $this->input->post('lname'),
        		'phone' => $this->input->post('phone'),
        		'app_no' => $this->input->post('app_no'),
        		'society' => $this->input->post('society'),
        		'nearby' => $this->input->post('nearby'),
        		'area' => $area
        	];

			if ($this->input->post('password'))
				$post['password'] = md5($this->input->post('password'));
        	
        	if ($this->main->update(['id' => $this->session->user_id], $post, 'users')):
        		$this->session->set_flashdata('success', "Your data saved successfully.");
        		return redirect('profile');
        	else:
        		$this->session->set_flashdata('error', "Some error occurs. Please try again.");
        		return redirect('profile');
        	endif;
        }
	}

	public function saveProds()
	{
		/* if ($this->input->is_ajax_request()) {
			$prods = $this->input->post('prods');
			$this->session->set_flashdata('prods', $prods);
			echo "Product saved.";
		} */
		
		$user = $this->main->get('users', 'fname, lname, phone, app_no, society, nearby, area', ['id'
		=> $this->user_id]);
		
		$post = [
			'name' 		  => $user['fname'].' '.$user['lname'],
			'phone' 	  => $user['phone'],
			'app_no' 	  => $user['app_no'],
			'society' 	  => $user['society'],
			'nearby' 	  => $user['nearby'],
			'area' 	 	  => $user['area'],
			'user_id'     => $this->user_id,
			'prods'       => ucwords(implode(', ', $this->input->post('prods'))),
			'create_date' => date("Y-m-d")
		];

		if ($this->main->add($post, 'sellings')):
			die("Your data saved successfully.");
		else:
			die("Some error occurs. Please try again.");
		endif;
	}

	public function logout()
	{
		$this->session->sess_destroy();
		return redirect('login');
	}

	public function error_404()
	{
		return $this->load->view('error_404');
	}
}