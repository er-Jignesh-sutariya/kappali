<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Collector_form extends Admin_controller {

	protected $redirect = 'collector_form';
	protected $name = 'collector_form';
	protected $title = 'Employees';
	protected $table = 'collector_form';
    public $uploadPath = "assets/images/collector_form/";
    protected $access = ['Super admin'];

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
        $this->load->model('collector_form_model', 'data');
        $fetch_data = $this->data->make_datatables();
        $sr = $_POST['start'] + 1;
        $data = [];
        foreach($fetch_data as $row)
        {  
            $sub_array = [];
            $sub_array[] = $sr;
            $sub_array[] = $row->name;
            $sub_array[] = $row->area;
            $sub_array[] = $row->contact;

            $action = '<div style="display: flex;">';

            $action .= anchor($this->redirect.'/update/'.e_id($row->id), '<i class="fa fa-edit"></i>', 'class="btn btn-primary btn-outline-primary btn-icon mr-1"');

            $action .= form_open($this->redirect.'/delete', 'id="'.e_id($row->id).'"', ['id' => e_id($row->id)]).
                form_button([ 'content' => '<i class="fa fa-trash"></i>', 
                    'type'  => 'button',
                    'class' => 'btn btn-danger btn-outline-danger btn-icon', 
                    'onclick' => "script.delete(".e_id($row->id)."); return false;"]).
                form_close();

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

    public function add()
    {
        $this->form_validation->set_rules($this->validate);
        if ($this->form_validation->run() == FALSE)
        {
            $data['name'] = $this->name;
            $data['title'] = $this->title;
            $data['url'] = $this->redirect;
            $data['operation'] = 'add';
            
            return $this->template->load(admin('template'), $this->redirect.'/add', $data);
        }
        else
        { 
            $img = $this->uploadImage();
            if ($img['error']) {
                $data['name'] = $this->name;
                $data['title'] = $this->title;
                $data['url'] = $this->redirect;
                $data['operation'] = 'add';
                $this->session->set_flashdata('error', $img['message']);
                
                return $this->template->load(admin('template'), $this->redirect.'/add', $data);
            }else{
                
                $post = [
                            'name'    => $this->input->post('name'),
                            'area'    => $this->input->post('area'),
                            'contact'    => $this->input->post('contact'),
                            'details' => $this->input->post('details'),
                            'image'   => $img['message']
                        ];
                
                $id = $this->main->add($post, $this->table);

                if (!$id)
                    unlink($this->uploadPath.$img['message']);

                flashMsg($id, ucwords($this->title)." added successfully.", ucwords($this->title)." not added. Try again.", $this->redirect);
            }
        }
    }

    public function update($id)
    {
        $this->form_validation->set_rules($this->validate);
        if ($this->form_validation->run() == FALSE)
        {
            $data['id'] = $id;
            $data['name'] = $this->name;
            $data['title'] = $this->title;
            $data['url'] = $this->redirect;
            $data['operation'] = 'update';
            $data['data'] = $this->main->get($this->table, 'name, area, details, contact, CONCAT("'.$this->uploadPath.'", image) image, image img', ['id' => d_id($id)]);

            if ($data['data'])
                return $this->template->load(admin('template'), $this->redirect.'/update', $data);
            else
                return $this->error_404();
        }
        else
        { 
            $img = $this->uploadImage($this->input->post('image'));
            if ($img['error']) {
                $data['id'] = $id;
                $data['name'] = $this->name;
                $data['title'] = $this->title;
                $data['url'] = $this->redirect;
                $data['operation'] = 'update';
                $this->session->set_flashdata('error', $img['message']);
                $data['data'] = $this->main->get($this->table, 'title, details, contact, CONCAT("'.$this->uploadPath.'", image) image, image img', ['id' => d_id($id)]);

                if ($data['data'])
                    return $this->template->load(admin('template'), $this->redirect.'/update', $data);
                else
                    return $this->error_404();
            }else{
                $post = [
                            'name'    => $this->input->post('name'),
                            'area'    => $this->input->post('area'),
                            'contact'    => $this->input->post('contact'),
                            'details' => $this->input->post('details'),
                            'image'   => $img['message']
                        ];

                $uid = $this->main->update(['id' => d_id($id)], $post, $this->table);

                flashMsg($uid, ucwords($this->title)." updated successfully.", ucwords($this->title)." not updated. Try again.", $this->redirect);
            }
        }
    }

    public function delete()
    {
        $id = $this->main->update(['id' => d_id($this->input->post('id'))], ['is_deleted' => 1], $this->table);

        flashMsg($id, ucwords($this->title)." deleted successfully.", ucwords($this->title)." not deleted. Try again.", $this->redirect);
    }

    private function clean($string) {
        $this->load->helper(array('text', 'string'));
        $string = strtolower(url_title(convert_accented_characters($string), '-'));
        return reduce_multiples($string, '-', TRUE);
    }

    private function uploadImage($unlink='')
    {
        if (!empty($_FILES['image']['name'])) {
            $config = [
                'upload_path'      => $this->uploadPath,
                'allowed_types'    => 'jpg|jpeg|png',
                'file_name'        => ($unlink) ? $unlink : time(),
                'file_ext_tolower' => TRUE,
                'overwrite'        => TRUE
            ];

            $this->load->library('upload');
            $this->upload->initialize($config);

            if (!$this->upload->do_upload("image"))
                $return = ['error' => true, 'message' => strip_tags($this->upload->display_errors())];
            else{
                $config_manip = [
                        'image_library' => 'gd2',
                        'source_image' => $this->upload->data('full_path'),
                        'new_image' => $this->upload->data('file_path'),
                        'maintain_ratio' => TRUE,
                        'width' => 1400,
                        'height' => 300
                    ];
               
                $this->load->library('image_lib', $config_manip);
                $this->image_lib->resize();
           
                $this->image_lib->clear();

                $return = ['error' => false, 'message' => $this->upload->data("file_name")];
            }
        }else
            if (!$unlink)
                $return = ['error' => true, 'message' => "Select file to upload."];
            else
                $return = ['error' => false, 'message' => $unlink];

        return $return;
    }

    protected $validate = [
        [
            'field' => 'name',
            'label' => 'Name',
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
