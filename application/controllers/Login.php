<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
    
    public function index()
    {
        redirect_if_not_login();
        redirect_if_not_admin();
        
        $data['user'] = $user = $this->session->userdata['logged_in'];
        
        // get all sites
        $data['accounts'] = $this->auth->get_all();        
        
        // flush data to view
        $this->load->view('login_list', $data);
    }
    
    /**
     * Index Page for this controller
     */
    public function add()
    {
        redirect_if_not_login();
        redirect_if_not_admin();
        
        $data = [];
        $data['user'] = $user = $this->session->userdata['logged_in'];        
        
        if ($this->input->method() == 'post') {             
            
            $this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[2]|max_length[200]');
            $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[2]|max_length[200]');
            $this->form_validation->set_rules('name', 'Name', 'trim|required|min_length[2]|max_length[200]');
            $this->form_validation->set_rules('lastname', 'Password', 'trim|required|min_length[2]|max_length[200]');
            
            if ($this->form_validation->run()) {
                
                $data['username'] = $this->input->post('username');
                $data['password'] = generate_password($this->input->post('password'));
                $data['name'] = $this->input->post('name');
                $data['lastname'] = $this->input->post('lastname');
                $data['is_admin'] = $user->is_admin && $this->input->post('is_admin') ? 1 : 0;
                $data['created'] = date('YmdHis');
                $this->auth->add($data);
                $this->session->set_flashdata('message'
                        , "Info saved");
                $data = ['user'=> $user];
            }
        }
        
        // flush data to view
        $this->load->view('login_new', $data);
    }
    
}
