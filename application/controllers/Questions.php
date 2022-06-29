<?php

class Questions extends CI_controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('main_model', 'main');
    }

    public function index()
    {
        $data['name'] = 'questions';
        $data['title'] = 'Questions Answers';
        $data['questions'] = $this->main->getall('question_answers', 'question, answer', ['is_deleted' => 0]);
        
        return $this->template->load('auth/template', 'questions', $data);
    }

    public function payment_form()
	{
		$order = $this->main->get('temp_orders', '*', ['orderId' => $this->input->post('orderId')]);
		$data = $this->main->get('users', 'id user_id, fname, lname, phone, (balance - '.$order['balance'].') AS balance, app_no, society, nearby, area, vehicle_no, vehicle_company, vehicle_model, wash_date, wash_time', ['id' => $order['user_id']]);

		$this->session->set_userdata($data);

        if($this->input->post('txStatus') === 'SUCCESS'):
			if(!$order) {
                $this->session->set_flashdata('error', "Some error occurs. Please try again.");
			    return redirect('');
            }
			
			$wallet['balance'] = $data['balance'];

			$post = [
				'payment_id'      => $this->input->post('orderId'),
				'user_id'         => $order['user_id'],
				'vehicle_no'      => $data['vehicle_no'],
				'vehicle_company' => $data['vehicle_company'],
				'vehicle_model'   => $data['vehicle_model'],
				'wash_date'       => $data['wash_date'],
				'wash_time'       => $data['wash_time'],
				'washes'          => $order['washes'],
				'created_at'      => time(),
				'discount'		  => $order['discount']
			];

			if ($this->main->addOrder($post, $wallet)):
				send_sms(8866679667, "ORDER ALERT : THIS CAR NUMBER ".$data['vehicle_no']." PAYMENT IS DONE BY 'KAPPALI'", '1307165537665948387');
				send_sms(8780331624, "ORDER ALERT : THIS CAR NUMBER ".$data['vehicle_no']." PAYMENT IS DONE BY 'KAPPALI'", '1307165537665948387');
				send_sms($data['phone'], "Dear customer, your payment of car wash is successfully received by 'KAPPALI', Services will be provide as per scheduled on dated ".date('d-m-Y', strtotime($data['wash_date']))." - ".$data['wash_time']." More info : 8866679667", '1307165443180013568');
				$this->main->update(['orderId' => $order['orderId']], ['status' => 'Completed'], 'temp_orders');
				$this->session->set_flashdata('success', "Your payment recieved succesfully.");
				return redirect('');
			else:
				$this->session->set_flashdata('error', "Some error occurs. Please try again.");
				return redirect('');
			endif;
		else:
			$this->session->set_flashdata('error', "Some error occurs. Please try again.");
			return redirect('');
		endif;

        // old code
		/* $validate = [
			[
				'field' => 'payment_id',
				'label' => 'Payment ID / Payment reference No.',
				'rules' => 'required|max_length[100]|alpha_numeric|is_unique[car_washes.payment_id]',
				'errors' => [
					'required' => "%s is Required",
					'max_length' => "Max 100 characters allowed.",
					'alpha_numeric' => "%s is invalid",
					'is_unique' => "%s already done.",
				]
			],
		];

		$this->form_validation->set_rules($validate);

		if ($this->form_validation->run() == FALSE)
		{
			$data['name'] = 'payment_form';
			$data['title'] = 'payment form';

			return $this->template->load('template', 'payment_form', $data);
		}else{ */
        
		/* if($this->input->post('txStatus') === 'SUCCESS' && !$this->main->get('car_washes', 'id', ['payment_id' => $this->input->post('orderId')])):
			$data = $this->main->get('users', 'vehicle_no, vehicle_company, vehicle_model, wash_date, wash_time', ['id' => $this->user_id]);
			
			$post = [
				'payment_id'      => $this->input->post('orderId'),
				'user_id'         => $this->user_id,
				'vehicle_no'      => $data['vehicle_no'],
				'vehicle_company' => $data['vehicle_company'],
				'vehicle_model'   => $data['vehicle_model'],
				'wash_date'       => $data['wash_date'],
				'wash_time'       => $data['wash_time'],
				'washes'          => json_encode($this->session->washes),
				'discount'		  => $this->session->discount ? $this->session->discount : 0
			];

			$this->session->unset_userdata('discount');

			if ($this->main->add($post, 'car_washes')):
				$this->session->set_flashdata('success', "Your payment recieved succesfully.");
				return redirect('');
			else:
				$this->session->set_flashdata('error', "Some error occurs. Please try again.");
				return redirect('');
			endif;
		else:
			$this->session->set_flashdata('error', "Some error occurs. Please try again.");
			return redirect('');
		endif; */
		/* if (! $this->main->get('car_washes', 'id', ['payment_id' => $this->input->get('payment-id')])):
			$data = $this->main->get('users', 'vehicle_no, vehicle_company, vehicle_model, wash_date, wash_time', ['id' => $this->user_id]);
			$post = [
				'payment_id'      => $this->input->get('payment-id'),
				'user_id'         => $this->user_id,
				'vehicle_no'      => $data['vehicle_no'],
				'vehicle_company' => $data['vehicle_company'],
				'vehicle_model'   => $data['vehicle_model'],
				'wash_date'       => $data['wash_date'],
				'wash_time'       => $data['wash_time'],
				'washes'          => json_encode($this->session->washes),
				'discount'		  => $this->session->discount ? $this->session->discount : 0
			];
			
			$this->session->unset_userdata('discount');

			if ($this->main->add($post, 'car_washes')):
				$this->session->set_flashdata('success', "Your data saved successfully.");
				return redirect('');
			else:
				$this->session->set_flashdata('error', "Some error occurs. Please try again.");
				return redirect('');
			endif;
		else:
			$this->session->set_flashdata('error', "Some error occurs. Please try again.");
			return redirect('');
		endif; */
		// }
	}
}
