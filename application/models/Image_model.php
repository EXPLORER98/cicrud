<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Image_model extends CI_Model{

    public function addData($data){
       return  $this->db->insert('photo',$data);
    }
} 

