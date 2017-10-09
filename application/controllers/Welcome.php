<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {
    
    /**
     * Index Page for this controller
     */
    public function index()
    {
        redirect('user/add');
    }
    
    /**
     * Index Page for this controller
     */
    public function login() {
        $data = [];
        $this->load->view('welcome_login', $data);
    }
}
