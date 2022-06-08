<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Sellings extends Admin_controller {

	protected $redirect = 'sellings';
	protected $name = 'sellings';
	protected $title = 'Orders';
	protected $table = 'sellings';
    protected $access = ['Super admin', 'Admin', 'Delivery boy'];

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
        $this->load->model('sellings_model', 'data');
        $fetch_data = $this->data->make_datatables();
        $sr = $_POST['start'] + 1;
        $data = [];
        foreach($fetch_data as $row)
        {  
            $sub_array = [];
            $sub_array[] = $sr;
            $action = '<div style="display: flex;">';
            if ($row->status == 'Pending'):
            	$action .= anchor($this->redirect.'/status/'.e_id($row->id), '<i class="fa fa-thumbs-up"></i>', 'class="btn btn-primary btn-outline-primary btn-icon mr-1"');
            else:
                $action .= anchor($this->redirect.'/invoice/'.e_id($row->id), '<i class="fa fa-print"></i>', 'class="btn btn-primary btn-outline-primary btn-icon mr-1"');
                if (in_array($this->role, ['Super admin'])) 
                $action .= anchor($this->redirect.'/update/'.e_id($row->id), '<i class="fa fa-edit"></i>', 'class="btn btn-primary btn-outline-primary btn-icon mr-1"');
            endif;

            $action .= '</div>';
            $sub_array[] = $action;
            $sub_array[] = $row->status;
            $sub_array[] = $row->order_type;
            $sub_array[] = "<span style='max-width: 250px;display: inline-block;width: 100%;white-space: normal;'>$row->name</span>";
            $sub_array[] = $row->phone;
            $sub_array[] = "<span style='max-width: 250px;display: inline-block;width: 100%;white-space: normal;'>$row->app_no, $row->society, $row->nearby, $row->area</span>";
            $sub_array[] = $row->prods;
            $sub_array[] = date("d-m-Y", strtotime($row->create_date));


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
        if ($this->input->server('REQUEST_METHOD') === 'GET')
        {
            $data['name'] = $this->name;
            $data['id'] = $id;
            $data['title'] = $this->title;
            $data['url'] = $this->redirect;
            $data['operation'] = 'update';
            $data['rates'] = $this->main->getall('ratelist', 'id, UCASE(item_name) item_name, item_rate', ['is_deleted' => 0]);
            $data['data'] = $this->main->get($this->table, 'name, phone, CONCAT(app_no,", ", society,", ", nearby) address, area, status', ['id' => d_id($id)]);

            if ($data['rates'] && $data['data']){
                if ($data['data']['status'] === 'Completed')
                    return redirect("$this->redirect/invoice/$id");
                return $this->template->load(admin('template'), $this->redirect.'/status', $data);
            }
            else
                return $this->error_404();
        }
        else
        { 
            if (!array_sum($this->input->post('prods'))) {
                $this->session->set_flashdata('error', 'Enter at least one Item KG.');
                return redirect("$this->redirect/status/$id");
            }
            $this->load->model('sellings_model');
            $uid = $this->sellings_model->saveSelling($id);
            if ($uid)
                $this->redirect = "$this->redirect/invoice/$id";
            flashMsg($uid, ucwords($this->title)." updated successfully.", ucwords($this->title)." not updated. Try again.", $this->redirect);
        }
    }

    public function invoice($id)
    {
        $data['name'] = $this->name;
        $data['id'] = $id;
        $data['title'] = $this->title;
        $data['url'] = $this->redirect;
        $data['operation'] = 'invoice';
        $this->load->model('sellings_model');
        $data['recieved_items'] = $this->sellings_model->getSelling(d_id($id));
        $data['data'] = $this->main->get($this->table, 'name, phone, CONCAT(app_no,", ", society,", ", nearby) address, area', ['id' => d_id($id)]);
        if ($data['data'] && $data['recieved_items'])
            return $this->template->load(admin('template'), $this->redirect.'/invoice_view', $data);
        else
            return $this->error_404();
    }

    public function update($id)
    {
        $this->form_validation->set_rules($this->update);
        if ($this->form_validation->run() == FALSE) {
            $data['name'] = $this->name;
            $data['id'] = $id;
            $data['title'] = $this->title;
            $data['url'] = $this->redirect;
            $data['operation'] = 'update';
            $this->load->model('sellings_model');
            $data['recieved_items'] = $this->sellings_model->getSelling(d_id($id));
            $data['data'] = $this->main->get($this->table, 'name, phone, CONCAT(app_no,", ", society,", ", nearby) address, area', ['id' => d_id($id)]);
            if ($data['data'] && $data['recieved_items'])
                return $this->template->load(admin('template'), $this->redirect.'/update', $data);
            else
                return $this->error_404();
        }else{
            $post = [
                        'rec_kg'   => $this->input->post('itemkg')
                    ];
                            
            $uid = $this->main->update(['id' => $this->input->post('id')], $post, "recieved_items");

            flashMsg($uid, ucwords($this->title)." updated successfully.", ucwords($this->title)." not updated. Try again.", "$this->redirect/update/$id");
        }
    }

    public function download($id)
    {
        $this->load->model('sellings_model');
        $data['recieved_items'] = $this->sellings_model->getSelling(d_id($id));
        $data['id'] = $id;
        $data['data'] = $this->main->get($this->table, 'name, phone, vendor_name, CONCAT(app_no,", ", society,", ", nearby) address, area, prods, received_by', ['id' => d_id($id)]);
        
        if ($data['data'] && $data['recieved_items']) {
            $data['data']['vendor'] = $this->main->get('admins', 'name', ['id' => $data['data']['received_by']]);
            $mpdf = new \Mpdf\Mpdf();
            $mpdf->WriteHTML($this->load->view($this->redirect.'/invoice', $data, true), \Mpdf\HTMLParserMode::HTML_BODY);
            // to view in browser
            $mpdf->Output();
            // to save in server
            // $mpdf->Output('./assets/invoices/'.$id, "F");
            // to download client
            /* $mpdf->Output("$id.pdf", 'D');
            return redirect($this->redirect); */
        }else
            return $this->error_404();
    }

    public function print()
    {
        $data['name'] = $this->name;
        $data['title'] = $this->title;
        $data['url'] = $this->redirect;
        $this->load->model('sellings_model', 'sellings');
        $data['data'] = $this->sellings->getPrint();

        $mpdf = new \Mpdf\Mpdf();
        $mpdf->WriteHTML($this->load->view($this->redirect.'/print', $data, true), \Mpdf\HTMLParserMode::HTML_BODY);
        $mpdf->Output();

        // return $this->template->load('template', $this->redirect.'/print', $data);
    }

    public function add()
    {
        $this->form_validation->set_rules($this->validate);
        if ($this->form_validation->run() == FALSE)
        {
            $data['name'] = $this->name;
            $data['title'] = $this->title;
            $data['url'] = $this->redirect;
            $data['operation'] = 'add';
            $data['areas'] = $this->main->getall('areas', 'id, area, pincode', ['is_deleted' => 0], 'area ASC');
            $data['users'] = $this->main->getall('users', 'id, phone, CONCAT(fname, " ", lname) name', ['id != ' => 0]);
            
            return $this->template->load(admin('template'), $this->redirect.'/add', $data);
        }
        else
        { 
            $userId = $this->main->check("users", ['phone' => $this->input->post('phone')], 'id');

            if (!$userId) {
                $user = [
                        'fname' => $this->input->post('name'),
                        'lname' => $this->input->post('name'),
                        'phone' => $this->input->post('phone')
                    ];
                $userId = $this->main->add($user, "users");
            }

            $post = [
                'name'        => $this->input->post('name'),
                'phone'       => $this->input->post('phone'),
                'app_no'      => $this->input->post('app_no'),
                'society'     => $this->input->post('society'),
                'nearby'      => $this->input->post('nearby'),
                'area'        => $this->input->post('area'),
                'user_id'     => $userId,
                'prods'       => ucwords(implode(', ', $this->input->post('prods'))),
                'create_date' => date("Y-m-d"),
                'order_type'  => "Offline"
            ];
            
            $id = $this->main->add($post, $this->table);

            flashMsg($id, ucwords($this->title)." added successfully.", ucwords($this->title)." not added. Try again.", $this->redirect);
        }
    }

    protected $status = [
                            [
                            'field' => 'prods[]',
                            'label' => 'User',
                            'rules' => 'required',
                            'errors' => [
                                'required' => "%s is Required"
                            ]
                        ],
                    ];

    protected $update = [
                            [
                            'field' => 'itemkg',
                            'label' => 'Item KG',
                            'rules' => 'required',
                            'errors' => [
                                'required' => "%s is Required"
                            ]
                        ],
                    ];

    protected $validate = [
                        [
                            'field' => 'name',
                            'label' => 'User name',
                            'rules' => 'required',
                            'errors' => [
                                'required' => "%s is Required",
                                'numeric' => "%s is invalid"
                            ]
                        ],
                        [
                            'field' => 'phone',
                            'label' => 'User phone',
                            'rules' => 'required|numeric|exact_length[10]',
                            'errors' => [
                                'required' => "%s is Required",
                                'numeric' => "%s is not valid",
                                'exact_length' => "%s is not valid"
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
                            'rules' => 'required|numeric',
                            'errors' => [
                                'required' => "%s is Required",
                                'numeric' => "%s is invalid"
                            ]
                        ],
                        [
                            'field' => 'prods[]',
                            'label' => 'products(s)',
                            'rules' => 'required',
                            'errors' => [
                                'required' => "%s is Required"
                            ]
                        ]
                    ];
}
