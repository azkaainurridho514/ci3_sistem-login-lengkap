<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {
	public function __construct(){
        parent::__construct();
        $this->load->library('form_validation');
	}
	public function index()
	{

      $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email',[ 'required' => 'Email harus di isi!', 'valid_email' => 'Email tidak valid!' ]);
      $this->form_validation->set_rules('password', 'Password', 'trim|required',[ 'required' => 'Password harus di isi!' ]);

      if($this->form_validation->run() == false){
         $data['title'] = "Login"; 
         $this->load->view('templates/auth_header', $data);
         $this->load->view('auth/login');
         $this->load->view('templates/auth_footer');
      }else{
         $this->_login();
      }
		
	}
	public function registration(){
    	$data['title'] = "Registration";

    	$this->form_validation->set_rules('name', 'Name', 'required|trim',[
              'required' => 'Harus di isi!'
    	]);
    	$this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[user.email]',[
              'required' => 'Harus di isi!',
              'valid_email' => 'Email tidak valid!',
              'is_unique' => 'Email sudah ada!'
    	]);
    	$this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[5]|matches[password2]',[
    		 'required' => 'Harus di isi!',
             'matches' => 'Password tidak sama!',
             'min_length' => 'Password terlalu pendek!',
    	]);
    	$this->form_validation->set_rules('password2', 'Confirm', 'required|trim|matches[password1]');
    
        if($this->form_validation->run() == false){
			$this->load->view('templates/auth_header', $data);
			$this->load->view('auth/registration');
			$this->load->view('templates/auth_footer');
        }else{
           $data = [
                'name' => htmlspecialchars($this->input->post('name', true)),
                'email' => htmlspecialchars($this->input->post('email', true)),
                'image' => 'image.jpg',
                'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
                'role_id' => 2,
                'is_active' => 1,
                'date_create' => time()
           ];

           $this->db->insert('user', $data);
           $this->session->set_flashdata('message', '<div class="alert alert-success text-center" role="alert">Success to registred!</div>');
              redirect('auth');
        }

	
	}

   private function _login(){
      $email = $this->input->post('email');
      $password = $this->input->post('password');

      $user = $this->db->get_where('user', ['email' => $email])->row_array();
       
       // kalau ada 
      if($user){
         if($user['is_active'] == 1){
            if(password_verify($password, $user['password'])){
               $data = [
                 'email' => $user['email'],
                 'role_id' => $user['role_id']
               ]; 

               // simpan ke sesion 
               $this->session->set_userdata($data);
               if($user['role_id'] == 1){
                  redirect('admin');
               }else{
                  redirect('user');
               }
               
            }else{
               $this->session->set_flashdata('message', '<div class="alert alert-danger text-center" role="alert">Wrong password!</div>');
                  redirect('auth'); 
            }
         }else{
         $this->session->set_flashdata('message', '<div class="alert alert-danger text-center" role="alert">Email has not be actived!</div>');
            redirect('auth'); 
         }
      }else{
         $this->session->set_flashdata('message', '<div class="alert alert-danger text-center" role="alert">Email is not registred!</div>');
            redirect('auth');
      }
   }

   public function logout(){
      $this->session->unset_userdata('email');
      $this->session->unset_userdata('role_id');

      $this->session->set_flashdata('message', '<div class="alert alert-success text-center" role="alert">You have bin logged out! </div>');
              redirect('auth');
   }


}
