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
    
    /**
     * This method is used to insert a site in database 
     * 
     * @param Array $data
     */
    public function add($data) {
        $this->db->insert('sites',$data);
        $this->session->set_flashdata('message', 'Info saved');
        redirect('welcome/index');
    }
    
}

