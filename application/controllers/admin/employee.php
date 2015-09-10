<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Employee extends CI_Controller {
  
  public function __construct()
  {
    parent::__construct();
  }

  public function index()
  {
    $date_range = $this->session->userdata('timeframe');
    if ($date_range=='') {
      $date_range = date('Y').'/01/01 - '.date('Y').'/12/31';
    }
    $data['page_title']    = lang('menu_emp');
    $data['filter_date']   = $date_range;
    
    $data['link_add']  = 'admin/employee/add/';
    $data['link_view'] = 'admin/employee/view/';

    $this->load->view('admin/emp/main_view',$data);
  }

  public function show_list()
  {
    # code...
  }

  public function view($emp_id=0)
  {
    # code...
  }

  public function add()
  {
    # code...
  }

  public function add_process()
  {
    # code...
  }

  public function edit($emp_id=0)
  {
    # code...
  }

  public function edit_process()
  {
    # code...
  }

}

/* End of file employee.php */
/* Location: ./application/controllers/admin/employee.php */