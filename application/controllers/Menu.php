<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Menu extends CI_Controller {
    
    public function index(){
    $data['title'] = 'Menu management';
   	$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata['email']])->row_array();

    $data['getmenu'] = $this->db->get('user_menu')->result_array();
    
    $this->form_validation->set_rules('menu', 'Menu', 'required', ['required' => 'Field menu title tidak boleh kosong!']);

   	if($this->form_validation->run() == false){
	   	$this->load->view('templates/header', $data);
	   	$this->load->view('templates/sidebar', $data);
	   	$this->load->view('templates/top-bar', $data);
	   	$this->load->view('menu/index', $data);
	   	$this->load->view('templates/footer');
   	}else{
   		$this->db->insert('user_menu', ['menu' => $this->input->post('menu')]);
   		$this->session->set_flashdata('menu', '<div class="alert alert-warning alert-dismissible fade show" role="alert">
			  ', '<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			    <span aria-hidden="true">&times;</span>
			  </button>
			</div>');
            redirect('menu');
   	 }
    }

    public function submenu(){
        $data['title'] = 'Submenu management';
	   	$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata['email']])->row_array();

	   	$data['getmenu'] = $this->db->get('user_menu')->result_array();
        $this->load->model('Menu_model', 'menu');
	   	$data['getsubmenu'] = $this->menu->getSubmenu();

	   	$this->form_validation->set_rules('submenu', 'Title', 'required', ['required' => 'Field title tidak boleh kosong!']);
	   	$this->form_validation->set_rules('menu_id', 'Menu', 'required', ['required' => 'Field menu title tidak boleh kosong!']);
	   	$this->form_validation->set_rules('url', 'Url', 'required', ['required' => 'Field url tidak boleh kosong!']);
	   	$this->form_validation->set_rules('icon', 'Icon', 'required', ['required' => 'Field icon tidak boleh kosong!']);
	   

        if($this->form_validation->run() == false){
            $this->load->view('templates/header', $data);
		   	$this->load->view('templates/sidebar');
		   	$this->load->view('templates/top-bar', $data);
		   	$this->load->view('menu/submenu', $data);
		   	$this->load->view('templates/footer');
        }else{
            $data = [
             'menu_id' => $this->input->post('menu_id'),
             'title' => $this->input->post('submenu'),
             'url' => $this->input->post('url'),
             'icon' => $this->input->post('icon'),
             'is_active' => $this->input->post('active')
            ];

            $this->db->insert('user_sub_menu', $data);
            $this->session->set_flashdata('submenu', '<div class="alert alert-warning alert-dismissible fade show" role="alert">
			  ', '<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			    <span aria-hidden="true">&times;</span>
			  </button>
			</div>');
            redirect('menu/submenu');
        }
    }
}