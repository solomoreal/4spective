<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {
  function __construct()
  {
    parent::__construct();
    $this->load->model('user_model');
    $this->load->model('pa_model');
    $this->lang->load('pa');
  }

  public function index()
  {
    $data['page_title'] = lang('menu_user');
    $data['link_hire']  = 'admin/user/hire/';
    $this->load->view('admin/user/main_view',$data);
  }

  public function show_list()
  {
    $data['link_add']          = 'admin/user/add_privilege';
    $data['link_edit_status']  = 'admin/user/edit_status/';
    $data['link_edit_contact'] = 'admin/user/edit_contact/';
    $data['link_reset_pass']   = 'admin/user/reset_password/';
    $list = $this->user_model->get_list(2);
    foreach ($list as $row) {
      $data['user'] = $row;
      echo $this->load->view('admin/user/user_list', $data, TRUE);
    }
  }

  public function show_privilege()
  {
    $user_id = $this->input->post('user_id');
    $data['link_delete'] = 'admin/user/delete_privilege';
    $list    = $this->user_model->get_privilege_list($user_id);
    foreach ($list as $row) {
      $data['user'] = $row;
      echo $this->load->view('admin/user/privilege_list', $data, TRUE);

    }
    
  }

  public function add_spec()
  {
    # code...
  }

  public function add_spec_process()
  {
    # code...
  }

  public function hire()
  {

    $opt_status = array(''=>'');
    $stat = $this->pa_model->get_status_list();
    foreach ($stat as $row) {
      $opt_status[$row->status_code] = $row->status_name;
    }
    $data['begin']       = date('Y-m-d');
    $data['dob']         = (date('Y')-20).date('-m-d');
    $data['emp_id']      = '';
    $data['end']         = '9999-12-31';
    $data['gender']      = '';
    $data['name_first']  = '';
    $data['name_last']   = '';
    $data['name_middle'] = '';
    $data['name_nick']   = '';
    $data['opt_status']  = $opt_status;
    $data['page_title']  = lang('pa_hire');
    $data['pob']         = '';
    $data['process']     = 'admin/user/hire_process';
    $data['status']      = 'CONT1';

    $this->load->view('admin/user/hire_form', $data, FALSE);
  }

  public function hire_process()
  {
    $begin       = $this->input->post('dt_begin');
    $dob         = $this->input->post('dt_dob');
    $end         = $this->input->post('dt_end');
    $gender      = $this->input->post('slc_gender');
    $name_first  = $this->input->post('txt_name_first');
    $name_last   = $this->input->post('txt_name_last');
    $name_middle = $this->input->post('txt_name_middle');
    $name_nick   = $this->input->post('txt_name_nick');
    $pob         = $this->input->post('txt_pob');
    $status      = $this->input->post('txt_status');

    // $this->pa_model->add_emp($name_first,$name_middle,$name_last,$pob,$dob,$begin);
  }

  public function edit_pers_dat()
  {
    
  }

  public function edit_pers_dat_process()
  {
    # code...
  }

  public function add_privilege()
  {
    $data['process'] = 'admin/user/add_privilege_process';
  }

  public function add_privilege_process()
  {
    # code...
  }

  public function edit_status()
  {
    $data['process'] = 'admin/user/edit_status_process';
  }

  public function edit_status_process()
  {
    # code...
  }

  public function edit_contact()
  {
    $data['process'] = 'admin/user/edit_contact_process';
  }

  public function edit_contact_process()
  {
    
  }

  public function reset_password()
  {
    $data['process'] = 'admin/user/reset_password_process';
  }

  public function reset_password_process()
  {
    # code...
  }

  public function delete_privilege()
  {
    $data['process'] = 'admin/user/delete_privilege_process';
  }

  public function delete_privilege_process()
  {
    # code...
  }

}

/* End of file user.php */
/* Location: ./application/controllers/admin/user.php */