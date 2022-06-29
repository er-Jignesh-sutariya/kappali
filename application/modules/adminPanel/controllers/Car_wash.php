<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Car_wash extends Admin_controller {

	protected $redirect = 'car_wash';
	protected $name = 'car_wash';
	protected $title = 'car wash';
	protected $table = 'car_washes';
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
        $this->load->model('car_wash_model', 'data');
        $fetch_data = $this->data->make_datatables();
        $sr = $_POST['start'] + 1;
        $data = [];
        foreach($fetch_data as $row)
        {  
            $sub_array = [];
            $sub_array[] = $sr;
            $sub_array[] = $row->vehicle_no;
            $sub_array[] = $row->payment_id;
            $sub_array[] = $row->vehicle_company;
            $sub_array[] = $row->vehicle_model;
            $sub_array[] = date("d-m-Y", $row->created_at);
            $sub_array[] = date("h:i A", $row->created_at);
            $sub_array[] = $row->discount;
            $sub_array[] = $row->c_code ? $row->c_code : "NA";
            $sub_array[] = $row->address;
            
            $sub_array[] = anchor($this->redirect.'/invoice/'.e_id($row->id), '<i class="fa fa-print"></i>',
            'class="btn btn-primary btn-outline-primary btn-icon mr-1"');
            /*if ($row->status == 'Pending'):*/
            	$sub_array[] = anchor($this->redirect.'/status/'.e_id($row->id), '<i class="fa fa-thumbs-up"></i>',
            	'class="btn btn-primary btn-outline-primary btn-icon mr-1"').
                anchor(admin('/users/balance/'.e_id($row->user_id)), '<i class="fa fa-rupee"></i>',
            	'class="btn btn-primary btn-outline-primary btn-icon mr-1"');
            // else:
                // $sub_array[] = $row->status;
            // endif;

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

    public function status($id)
    {
        $post = [ 'status' => "Success" ];

        // sms sending start
        $user_id = $this->main->check($this->table, ['id' => d_id($id)], 'user_id');
        $phone = $this->main->check('users', ['id' => $user_id], 'phone');
        $sms = $this->config->item('car_wash')['sms'];
        send_sms($phone, $sms, $this->config->item('car_wash')['temp']);
        // sms sending end

        $uid = $this->main->update(['id' => d_id($id)], $post, $this->table);

        flashMsg($uid, "Status updated successfully.", "Status not updated. Try again.", $this->redirect);
    }

    public function invoice($id)
    {
        $data['id'] = $id;
        $data['data'] = $this->main->get($this->table, '*', ['id' => d_id($id)]);
        
        if ($data['data']) {
            $data['data']['user'] = $this->main->get('users', '*, CONCAT(fname, " ", lname) name, CONCAT(app_no, " ", society, "", nearby) AS address', ['id' =>
            $data['data']['user_id']]);
            /*re($data);*/
            $mpdf = new \Mpdf\Mpdf();
            $mpdf->WriteHTML($this->load->view($this->redirect.'/invoice', $data, true), \Mpdf\HTMLParserMode::HTML_BODY);
            // to view in browser
            $mpdf->Output();
        }else
            return $this->error_404();
    }
}
