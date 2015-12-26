<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Account extends CI_Controller {
  
  public function __construct()
  {
    parent::__construct();
    // if ($this->session->userdata('login_user') == TRUE) {
    //   redirect('home');
    // }
    $this->load->model('user_model');
  }

  public function index()
  {
    if ($this->session->userdata('login_user') == TRUE) {
      redirect('home');
    } else {
      redirect('account/login');
    }
  }

  public function login()
  {
    if ($this->session->userdata('login_user') == TRUE) {
      redirect('home');
    } else {
      $this->load->view('login_form');
    }
  }

  public function login_process()
  {
    $user = strtolower($this->input->post('txt_user'));
    $pass = $this->input->post('txt_pass');

    // TODO check database user
    $flag = $this->user_model->login($user,$pass);
    if ($flag) {
      redirect('home');
    } else {
      redirect('account/login');

    }

  }

  public function forgot_pass()
  {
    $this->load->view('forgot_form');

  }

  public function forgot_process()
  {
    $user = $this->input->post('txt_user');

  }

  public function logout()
  {
    $this->session->sess_destroy();
    redirect('account/login','refresh');
  }

  public function switch_role()
  {
    $role = $this->input->post('role');
    switch ($role) {
      case 'admin':
        $this->session->set_userdata('sidemenu','admin_menu');

        break;
      case 'chief':
        $this->session->set_userdata('sidemenu','chief_menu');

        break;
      case 'spv':
        $this->session->set_userdata('sidemenu','spv_menu');

        break; 
      default:
        $this->session->set_userdata('sidemenu','emp_menu');

        break;
    }
  }



}

/* End of file account.php */
/* Location: ./application/controllers/account.php */