<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {
    
    /**
     * Index Page for this controller
     */
    public function index()
    {
        // get all sites
        $data['users'] = $this->users->get_all();
        
        // flush data to view
        $this->load->view('user_list', $data);
    }
}
