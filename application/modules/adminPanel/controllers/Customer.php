<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Customer extends Admin_controller {

	protected $redirect = 'customer';
	protected $name = 'customer';
	protected $title = 'customer';
	protected $table = 'customers';
    public $uploadPath = "assets/images/article/";
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
        $this->load->model('customers_model', 'data');
        $fetch_data = $this->data->make_datatables();
        $sr = $_POST['start'] + 1;
        $data = [];
        foreach($fetch_data as $row)
        {  
            $sub_array = [];
            $sub_array[] = $sr;
            $sub_array[] = img(['src' => $this->uploadPath.$row->image, 'height' => 50, 'width' => 50]);

            $action = '<div style="display: flex;">';

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

    public function upload()
    {
        $img = $this->uploadImage();
        if ($img['error']) {
            flashMsg(0, '', $img['message'], $this->redirect);
        }else{
            $post = [
                        'image'    => $img['message'],
                    ];
            
            $id = $this->main->add($post, $this->table);
            
            flashMsg($id, ucwords($this->title)." added successfully.", ucwords($this->title)." not added. Try again.", $this->redirect);
        }
        
    }

    public function delete()
    {
        $id = $this->main->update(['id' => d_id($this->input->post('id'))], ['is_deleted' => 1], $this->table);

        flashMsg($id, ucwords($this->title)." deleted successfully.", ucwords($this->title)." not deleted. Try again.", $this->redirect);
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
                        'width' => 300,
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
}
