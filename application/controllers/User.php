<?php
error_reporting(0);
class User extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('user_model');
        $this->load->library('upload');
    }

    function add()
    {


        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            if (!empty($_FILES['image']['name'])) {

                $config['upload_path'] = './uploads/';

                $config['allowed_types'] = 'jpg|jpeg|png|gif';
                $config['file_name'] = $_FILES['image']['name'];
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                if ($this->upload->do_upload('image')) {

                    $data['image'] = $this->upload->data('file_name');
                    $this->session->set_flashdata('message', '<div class="alert alert-success">Record has been saved successfully.</div>');
                } else {
                    $error = array('error' => $this->upload->display_errors());
                    $this->session->set_flashdata('message', '<div class="alert alert-danger">' . implode("", $error) . '</div>');
                }
                $image = $_FILES['image']['name'];
            } else {
                $image = '';
            }



            $username = $this->input->post('username');
            $email = $this->input->post('email');
            $phone = $this->input->post('phone');
            $address = $this->input->post('address');


            $data = array(
                'username' => $username,
                'email' => $email,
                'phone' => $phone,
                'address' => $address,
                'image' => $image,
            );


            // $status = $this->user_model->insertUser($data);
            $this->load->model('user_model');
            $status = $this->user_model->insertUser($data);
            if ($status == true) {
                $this->session->set_flashdata('success', 'successfully added');
                redirect(base_url('user/add'));
            } else {
                $this->session->set_flashdata('error', 'Error');
                $this->load->view('user/add_user');
            }


        } else {
            $this->load->view('user/add_user');
        }


    }
    function create()
    {
        $this->load->view('user/add_user');
    }
    function index()
    {

        $data['crud_ci'] = $this->user_model->getUsers();
        $this->load->view('user/index', $data);
    }
    function edit($id)
    {

        $data['user'] = $this->user_model->getUser($id);
        $data['id'] = $id;
        $this->load->view('user/edit_user', $data);

    }
    function update($id)
    {

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $old_filename = $this->input->post('old_image');

            if (!empty($_FILES['image']['name'])) {

                $config['upload_path'] = './uploads/';

                $config['allowed_types'] = 'jpg|jpeg|png|gif';
                $config['file_name'] = $_FILES['image']['name'];
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                if ($this->upload->do_upload('image')) {

                    if (file_exists("./uploads/" . $old_filename)) {
                        unlink("./uploads/" . $old_filename);
                    }
                    $this->session->set_flashdata('message', '<div class="alert alert-success">Record has been saved successfully.</div>');
                } else {
                    $error = array('error' => $this->upload->display_errors());
                    $this->session->set_flashdata('message', '<div class="alert alert-danger">' . implode("", $error) . '</div>');
                }
                $image = $_FILES['image']['name'];
            } else {
                $image = $old_filename;
            }

            // $username = $this->input->post('username');
            
            $username = $_POST['username'];
            $email = $_POST['email'];
            $phone = $_POST['phone'];
            $address = $_POST['address'];
            $data = [
                'username' => $username,
                'email' => $email,
                'phone' => $phone,
                'address' => $address,
                'image' => $image
            ];


            $status = $this->user_model->updateUser($data, $id);
            if ($status == true) {
                $this->session->set_flashdata('success', 'successfully updated');
                redirect(base_url('user/edit/' . $id));
            } else {
                $this->session->set_flashdata('error', 'Error');
                $this->load->view('user/edit_user');
            }

        }
        $this->load->view('user/edit_user', $data);
    }

    function delete($id)
    {
        if (is_numeric($id)) {
            $status = $this->user_model->deleteUser($id);
            if ($status == true) {
                $this->session->set_flashdata('success', 'Successfully Deleted');
                redirect(base_url('user/index/'));
            } else {
                $this->session->set_flashdata('error', 'Error');
                $this->load->view('user/index');
            }
        }
    }

    function updateajax()
    {
        $id = $_POST['id'];
        $username = $_POST['username'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $address = $_POST['address'];
        $old_filename = $_POST['old_image'];

        if (!empty($_FILES['image']['name'])) {

            $config['upload_path'] = './uploads/';
            $config['allowed_types'] = 'jpg|jpeg|png|gif';
            $config['file_name'] = $_FILES['image']['name'];
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if ($this->upload->do_upload('image')) {

                if (file_exists("./uploads/" . $old_filename)) {
                    unlink("./uploads/" . $old_filename);
                }
            } else {
                return $error = array('error' => $this->upload->display_errors());
            }
            $image = $_FILES['image']['name'];
        } else {
            $image = $old_filename;
        }


        $data = [
            'username' => $username,
            'email' => $email,
            'phone' => $phone,
            'address' => $address,
            'image' => $image
        ];

        $status = $this->user_model->updateUser($data, $id);
        if ($status == true) {
            return 'success';
        } else {
            return 'failed';
        }
    }

}