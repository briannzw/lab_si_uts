<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Homepage extends CI_Controller {
	public function __construct()
	{
      parent:: __construct();
      $this->load->model('post_model');
      $this->load->model('auth_model');
      if(!$this->auth_model->current_user()){
        redirect('auth/login');
      }
	}
	
	public function index()
	{
        $data['posts'] = $this->post_model->get_posts();

        if(count($data['posts']) > 0){
            $this->load->view('homepage', $data);
        }
	}

    public function show($user = null)
    {
      // jika gak ada user di URL tampilkan 404
      if (!$user) {
        show_404();
      }
  
      // ambil post dengan user yang diberikan
      $data['posts'] = $this->post_model->find_by_user($user);
  
      // jika post tidak ditemukan di database tampilkan 404
      if (!$data['posts']) {
        show_404();
      }
  
      // tampilkan post
      $this->load->view('show_post.php', $data);
    }
}
