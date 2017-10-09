<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {
    
    /**
     * Index Page for this controller
     */
    public function index()
    {
        // get all sites
        $data['sites'] = $this->sites->get_all();
        
        // get default location from server while browser data is retrieved
        $data['default_location'] = get_current_location();
        
        $data['min_distance'] = $this->config->item('min_distance');
        $data['max_distance'] = $this->config->item('max_distance');
        $data['max_closests_sites'] = $this->config->item('max_closests_sites');
        
        
        // flush data to view
        $this->load->view('welcome_form', $data);
    }
    
    public function map() {
        
        // get all sites
        $data['sites'] = $this->sites->get_all();
        
        $data['google_maps_api_key'] = $this->config->item('google_maps_api_key');
        
        $this->load->view('show_map', $data);
    }
    
    public function save() {
        if ($this->input->method() == 'post') { 
            $data['name'] = $name = $this->input->post('name');
            $data['lastname'] = $lastname = $this->input->post('lastname');
            $data['site'] = $site = $this->input->post('site');
            $data['created'] = date('YmdHis');
            $dateString = date('Y-m-d H:i:s');
            $this->users->add($data);
            $this->session->set_flashdata('message'
                    , "Info saved, Name: {$name} {$lastname}, "
                    . "Site: {$site}, Created: {$dateString}");
        }
        redirect('welcome/index');
    }
}
