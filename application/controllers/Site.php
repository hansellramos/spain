<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Site extends CI_Controller {
    
    /**
     * Index Page for this controller
     */
    public function index()
    {
        $this->map();
    }
    
    public function map() {
        
        // get all sites
        $data['sites'] = $this->sites->get_all();
        
        $data['google_maps_api_key'] = $this->config->item('google_maps_api_key');
        
        $this->load->view('sites_map', $data);
    }
}
