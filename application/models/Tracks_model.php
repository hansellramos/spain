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
     * This method is used to get all tracks from database
     * 
     * @return Array
     */
    public function one($id) {
        $this->db->where('id',$id);
        $query = $this->db->get('tracks');
        return $query->row();
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
    
    /**
     * This method is used to insert an account in database 
     * 
     * @param int $id
     * @param Array $data
     */
    public function update($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('tracks',$data);
    }
    
    /**
     * THis method return last opened track for an account
     * 
     * @param string $name
     * @param string $lastname
     * @return Array
     */
    public function get_last_track_open($name, $lastname) {
        $this->db->where('name',$name);
        $this->db->where('lastname',$lastname);
        $this->db->where('exit_datetime IS NULL');
        $this->db->order_by('id DESC');
        $this->db->limit(1);
        $query = $this->db->get('tracks');
        return $query->row();
    }
    
}

