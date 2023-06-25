<?php
class User_model extends CI_Model
{
   
    
    function insertUser($data)
    {
        $this->db->insert('crud_ci',$data);
        if($this->db->affected_rows() >= 0){
            return true;
        }
        else{
            return false;
        }
    }
    function getUsers()
    {
       $query = $this->db->get('crud_ci');
       return $query->result_array();
    }
    function getUser($id)
    {
        $this->db->where('id',$id);
       $query =  $this->db->get('crud_ci');
       return $query->row();
    }
    function updateUser($data,$id)
    {
        $this->db->where('id',$id);
        $this->db->update('crud_ci',$data);
        if($this->db->affected_rows() >= 0){
            return true;
        }
        else{
            return false;
        }
    }

    function deleteUser($id)
    {
        $this->db->where('id',$id);
        $this->db->delete('crud_ci');
        if($this->db->affected_rows() >= 0){
            return true;
        }
        else{
            return false;
        }
    }
}
