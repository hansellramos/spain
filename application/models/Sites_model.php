<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sites_model extends CI_Model {
    
    public $id;
    public $name;
    public $latitude;
    public $longitude;
    public $created;
    
    /**
     * This method is used to get all sites from database
     * 
     * @return Array
     */
    public function get_all() {
        $query = $this->db->get('sites');
        return $query->result();
    }
    
}

