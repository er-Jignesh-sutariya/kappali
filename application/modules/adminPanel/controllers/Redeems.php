<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Redeems extends Admin_controller {

	protected $redirect = 'redeems';
	protected $name = 'redeems';
	protected $title = 'redeems';
	protected $table = 'redeems';
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
        $this->load->model('redeems_model', 'data');
        $fetch_data = $this->data->make_datatables();
        $sr = $_POST['start'] + 1;
        $data = [];
        foreach($fetch_data as $row)
        {  
            $sub_array = [];
            $sub_array[] = $sr;
            $sub_array[] = $row->fname.' '.$row->lname;
            $sub_array[] = $row->phone;
            $sub_array[] = $row->points;
            // $sub_array[] = $row->green_donation;
            $sub_array[] = $row->payment_mode;
            /* $sub_array[] = $row->bank_acc;
            $sub_array[] = $row->bank_ifsc;
            $sub_array[] = $row->bank_mobile;
            $sub_array[] = $row->bank_name; */
            $sub_array[] = date("d-m-Y", strtotime($row->create_date));
            $sub_array[] = $row->status;
            $sub_array[] = $row->trans_id;

            $action = '<div style="display: flex;">';
            if ($row->status == 'Pending'):
            	$action .= anchor($this->redirect.'/status/'.e_id($row->id), '<i class="fa fa-thumbs-up"></i>', 'class="btn btn-primary btn-outline-primary btn-icon mr-1"');
            endif;

            /*$action .= form_open($this->redirect.'/delete', 'id="'.e_id($row->id).'"', ['id' => e_id($row->id)]).
                form_button([ 'content' => '<i class="fa fa-trash"></i>', 
                    'type'  => 'button',
                    'class' => 'btn btn-danger btn-outline-danger btn-icon', 
                    'onclick' => "script.delete(".e_id($row->id)."); return false;"]).
                form_close();*/

            $action .= '</div>';
            $sub_array[] = $action;

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
        $this->form_validation->set_rules("trans_id", "Transaction ID", 'required', ['required' => '%s is required.']);

        if ($this->form_validation->run() == FALSE)
        {
            $data['name'] = $this->name;
            $data['title'] = $this->title;
            $data['url'] = $this->redirect;
            $data['operation'] = 'status';

            return $this->template->load(admin('template'), $this->redirect.'/status', $data);
        }
        else
        {
            $post = [ 'status' => "Success", 'trans_id' => $this->input->post('trans_id') ];

            $uid = $this->main->update(['id' => d_id($id)], $post, $this->table);

            flashMsg($uid, ucwords($this->title)." updated successfully.", ucwords($this->title)." not updated. Try
            again.", $this->redirect);
        }
    }
}
