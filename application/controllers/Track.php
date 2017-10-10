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
            $track_data['name'] = $name = $this->input->post('name');
            $track_data['lastname'] = $lastname = $this->input->post('lastname');
            $track_data['entrance_site'] = $site = $this->input->post('entrance_site');
            $track_data['entrance_datetime'] = date('YmdHis');
            $dateString = date('Y-m-d H:i:s');
            $this->tracks->add($track_data);
            $this->session->set_flashdata('redirect',true);
            $this->session->set_flashdata('message'
                    , "Entrada guardada, Nombre: {$name} {$lastname}, "
                    . "Sitio de Entrada: {$site}, Fecha y Hora de Entrada: {$dateString}");
        }
        
        $data['type'] = 'entrada';
        
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
    
    public function edit($track_id, $type = 'entrada') {
        
        redirect_if_not_login();
        
        $data['track'] = $track = $this->tracks->one($track_id);
        $data['type'] = $type;
        
        if ($this->input->method() == 'post') { 
            $dateString = date('Y-m-d H:i:s');
            if ($type === 'doblaje') {
                $track_data['move_site'] = $site = $this->input->post('move_site');
                $track_data['move_datetime'] = date('YmdHis');
                $message = "Doblaje guardado, Nombre: {$track->name} {$track->lastname}, "
                    . "Sitio de Doblaje: {$site}, Fecha y Hora de doblaje: {$dateString}";
            } else if ($type === 'salida') {
                if ($this->input->post('type') === 'cierre') {
                    $track_data['close_site'] = $site = $this->input->post('exit_site');
                    $track_data['close_datetime'] = date('YmdHis');
                    $message = "Cierre guardado, Nombre: {$track->name} {$track->lastname}, "
                        . "Sitio de Cierre: {$site}, Fecha y Hora de salida: {$dateString}";
                } else {
                    $track_data['exit_site'] = $site = $this->input->post('exit_site');
                    $track_data['exit_datetime'] = date('YmdHis');
                    $message = "Salida guardada, Nombre: {$track->name} {$track->lastname}, "
                        . "Sitio de Salida: {$site}, Fecha y Hora de salida: {$dateString}";
                }
            }
            
            $this->tracks->update($track_id, $track_data);
            $this->session->set_flashdata('redirect',true);
            $this->session->set_flashdata('message'
                    , $message);
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
    
}
