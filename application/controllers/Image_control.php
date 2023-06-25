<?php
class Image_control extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('image_model', 'model');

    }
    public function index()
    {
        $this->load->view('image_view/add_image');
    }
    public function addData()
    {

        $config = [
            'upload_path' => './uploads/',
            'allowed_types' => 'jpg|png|jpeg'
        ];
        $this->load->library('upload', $config);

        $this->upload->initialize($config);
        if ($this->upload->do_upload('image')) {
            $name = $this->input->post('name');
            $image =$_FILES['image']['name'];
            $data = array(
                'name' => $name,
                'image' => $image
            );
            $this->model->addData($data);

        } else {
            $error = $this->upload->display_errors();
            $data['img_error'] = $this->upload->display_errors('<p>', '</p>');
        }
        $this->load->view('image_view/add_image', $data);

    }
}