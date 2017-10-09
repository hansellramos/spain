<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {
    
    public function index()
    {
        redirect_if_not_login();
        
        // get all sites
        $data['users'] = $this->users->get_all();
        
        // flush data to view
        $this->load->view('user_list', $data);
    }
    
    /**
     * Index Page for this controller
     */
    public function add($type = 'Entrada')
    {
        
        redirect_if_not_login();
        
        if ($this->input->method() == 'post') { 
            
            $this->form_validation->set_rules('name', 'Name', 'trim|required|min_length[2]|max_length[200]');
            $this->form_validation->set_rules('lastname', 'Password', 'trim|required|min_length[2]|max_length[200]');
            $this->form_validation->set_rules('site', 'Site', 'trim|required|min_length[2]|max_length[200]');
            
            if ($this->form_validation->run()) {
                $data['type'] = $type = $this->input->post('name');
                $data['name'] = $name = $this->input->post('name');
                $data['lastname'] = $lastname = $this->input->post('lastname');
                $data['site'] = $site = $this->input->post('site');
                $data['created'] = date('YmdHis');
                $dateString = date('Y-m-d H:i:s');
                $this->users->add($data);
                $this->session->set_flashdata('message'
                        , "Info saved, Name: {$name} {$lastname}, "
                        . "Site: {$site}, Created: {$dateString}");
                redirect('user/add');
            }
        }
        
        //Current logged user
        $data['user'] = $this->session->userdata['logged_in'];
        
        $data['type'] = get_entry_type($type);
        
        // get all sites
        $data['sites'] = $this->sites->get_all();
        
        // get default location from server while browser data is retrieved
        $data['default_location'] = get_current_location();
        
        $data['min_distance'] = $this->config->item('min_distance');
        $data['max_distance'] = $this->config->item('max_distance');
        $data['max_closests_sites'] = $this->config->item('max_closests_sites');        
        
        // flush data to view
        $this->load->view('user_new', $data);
    }
    
}
