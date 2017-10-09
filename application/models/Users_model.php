<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users_model extends CI_Model {
    
    public $id;
    public $name;
    public $latitude;
    public $longitude;
    public $created;
    
    /**
     * This method is used to get all users from database
     * 
     * @return Array
     */
    public function get_all() {
        $query = $this->db->get('users');
        return $query->result();
    }
    
    /**
     * This method is used to insert an user in database 
     * 
     * @param Array $data
     */
    public function add($data) {
        $this->db->insert('users',$data);
    }
    
}

