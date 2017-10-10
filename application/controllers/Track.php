<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Track extends CI_Controller {
    
    public function index()
    {
        redirect_if_not_login();
        
        // get all sites
        $data['tracks'] = $this->tracks->get_all();
        
        // flush data to view
        $this->load->view('track_list', $data);
    }
    
    /**
     * Index Page for this controller
     */
    public function add()
    {
        redirect_if_not_login();
        
        if ($this->input->method() == 'post') { 
            $data['name'] = $name = $this->input->post('name');
            $data['lastname'] = $lastname = $this->input->post('lastname');
            $data['entrance_site'] = $site = $this->input->post('site');
            $data['entrance_datetime'] = date('YmdHis');
            $dateString = date('Y-m-d H:i:s');
            $this->tracks->add($data);
            $this->session->set_flashdata('redirect',true);
            $this->session->set_flashdata('message'
                    , "Entrada guardada, Nombre: {$name} {$lastname}, "
                    . "Sitio: {$site}, Fecha y Hora: {$dateString}");
        }
        
        //Current logged account
        $data['account'] = $this->session->userdata['logged_in'];
        $data['redirect_time'] = $this->config->item('redirect_time');
        
        // get all sites
        $data['sites'] = $this->sites->get_all();
        
        // get default location from server while browser data is retrieved
        $data['default_location'] = get_current_location();
        
        $data['min_distance'] = $this->config->item('min_distance');
        $data['max_distance'] = $this->config->item('max_distance');
        $data['max_closests_sites'] = $this->config->item('max_closests_sites');        
        
        // flush data to view
        $this->load->view('track_edit', $data);
    }
    
    public function edit($track_id, $type) {
        
        redirect_if_not_login();
        
        $data['track'] = $track = $this->tracks->one($track_id);
        $data['type'] = $type;
        
        //Current logged account
        $data['account'] = $this->session->userdata['logged_in'];
        $data['redirect_time'] = $this->config->item('redirect_time');
        
        // get all sites
        $data['sites'] = $this->sites->get_all();
        
        // get default location from server while browser data is retrieved
        $data['default_location'] = get_current_location();
        
        $data['min_distance'] = $this->config->item('min_distance');
        $data['max_distance'] = $this->config->item('max_distance');
        $data['max_closests_sites'] = $this->config->item('max_closests_sites');  
        
        // flush data to view
        $this->load->view('track_edit', $data);
        
    }
    
}
