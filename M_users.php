<?php 

class M_users extends CI_Model {

    public function loginUser ($username, $pass)
    {
        $username = set_value ('username');
        $password = set_value ('password');

        $result = $this->db->where('username', $username)
                            ->where('password', $password)
                            ->limit(1)
                            ->get('tb00_admin');
        if($result->num_rows() > 0){
            return $result->row();
        }else{
            return array();
        }
    }

    //cek username dan password staff TU
    public function loginstaff ($username, $pass)
    {
        $username = set_value ('username');
        $password = set_value ('password');

        $result = $this->db->where('username', $username)
                            ->where('password', $pass)
                            ->limit(1)
                            ->get('tb00_admin');
        if($result->num_rows() > 0){
            return $result->row();
        }else{
            return array();
        }
    }


}