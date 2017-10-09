<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tracks_model extends CI_Model {
    
    public $id;
    public $name;
    public $lastname;
    public $entrance_site;
    public $entrance_datetime;
    public $move_site;
    public $move_datetime;
    public $exit_site;
    public $exit_datetime;
    
    /**
     * This method is used to get all tracks from database
     * 
     * @return Array
     */
    public function get_all() {
        $query = $this->db->get('tracks');
        return $query->result();
    }
    
    /**
     * This method is used to insert an account in database 
     * 
     * @param Array $data
     */
    public function add($data) {
        $this->db->insert('tracks',$data);
        return $this->db->insert_id();
    }
    
}

