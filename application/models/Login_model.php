<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_model extends CI_Model {
    
    public $id;
    public $username;
    public $password;
    public $name;
    public $lastname;
    public $created;
    
    /**
     * This method is used check login credentials
     * 
     * @return Array
     */
    public function login($username, $password) {
        $this->db->select('id');
        $this->db->from('login');
        $this->db->where('UPPER(username)', strtoupper($username));
        $this->db->where('password', md5(md5($password)));
        $this->db->limit(1);
        $query = $this->db->get();
        if (!$query->num_rows() == 1){ return false; }
        return $query->row()->id;
    }
    
    public function one($id) {
        $this->db->select('id, name, lastname, username, is_admin');
        $this->db->from('login');
        $this->db->where('id', $id);
        $this->db->limit(1);
        return $this->db->get()->row();
    }
    
}

