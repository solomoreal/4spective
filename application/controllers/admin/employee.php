<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Employee extends CI_Controller {
  
  public function __construct()
  {
    parent::__construct();
    $this->load->model('om_model');
    $this->lang->load('pa');
    $this->lang->load('om');

  }

  public function index()
  {
    $date_range = $this->session->userdata('timeframe');
    if ($date_range=='') {
      $date_range = date('Y').'/01/01 - 9999/12/31';
    }
    $data['page_title']    = lang('menu_emp');
    $data['filter_date']   = $date_range;
    
    $data['link_add']  = 'admin/employee/add/';
    $data['link_view'] = 'admin/employee/view/';
    $data['begin']     = date('Y').'-01-01';
    $data['process']   = 'admin/employee/add_process';

    $this->load->view('admin/emp/main_view',$data);
  }

  public function detail($emp_code='')
  {
    $date_range = $this->session->userdata('timeframe');
    
    $data['page_title']  = lang('om_emp');
    $data['filter_date'] = $date_range;
    $data['emp_code']    = $emp_code;

    $this->load->view('admin/emp/detail_view',$data);
  }

  public function show_list()
  {
    $date_range = $this->input->post('date_range');
    $this->session->set_userdata('timeframe',$date_range);
    list($begin,$end) = explode(' - ', $date_range);

    $data['emp_ls'] = $this->om_model->get_emp_list($begin,$end);
    echo $this->load->view('admin/emp/list_view', $data, TRUE);
  }

  public function fetch_attr()
  {
    $emp_code     = $this->input->post('emp_code');

    $date_range = $this->input->post('date_range');
    $this->session->set_userdata('timeframe',$date_range);
    if ($date_range == '') {
      $date_range = date('Y').'/01/01 - '.date('Y').'/12/31';
    }
    list($begin,$end) = explode(' - ', $date_range);
    $emp = $this->om_model->get_emp_row($emp_code,$begin,$end);

    echo json_encode($emp);
  }

  public function show_post()
  {
    
  }

  public function show_history()
  {
    # code...
  }

  public function add_process()
  {
    $this->form_validation->set_rules('txt_code', lang('pa_emp_code'), 'trim|required|min_length[3]|max_length[20]|xss_clean');
    $this->form_validation->set_rules('txt_name', lang('pa_name'), 'trim|required|min_length[5]|max_length[255]|xss_clean');

    $this->form_validation->set_rules('dt_join', lang('pa_join_date'), 'trim|required|xss_clean');
    if ($this->form_validation->run()) {
      $this->load->model('user_model');
      $code  = $this->input->post('txt_code');
      $name  = $this->input->post('txt_name');
      $email = $this->input->post('txt_email');
      $phone = $this->input->post('txt_phone');
      $begin = $this->input->post('dt_join');
      $end   = '9999-12-31';
      
      // TODO check employee code , username(emp code) & email is used?
      if ($this->om_model->check_emp_code($code) == FALSE && $this->user_model->count_username($code) == FALSE && $this->user_model->count_email($email) == FALSE) {

        // TODO Add Employee Object an Atrribute
        $this->om_model->add_emp($name,$code,$begin,$end);

        // TODO Create Employee User login and privilege
        $this->load->helper('string');
        $password = strtolower(random_string('alnum', 6));
        $user_id = $this->user_model->add($code,$password,$email,$phone,1);
        $this->user_model->add_privilege($user_id,'USER',$begin,$end);

        // TODO send Email Employee username and password 
        // $this->load->library('email');
        
        // $this->email->from('email@email.com', 'Name');
        // $this->email->to($email);
        
        
        // $this->email->subject('Welcome to 4spective');
        // $this->email->message('message');
        
        // $this->email->send();
        
        // echo $this->email->print_debugger();


        // TODO create notif "Success"
        $this->load->view('_notif/success');
        
      } else {
        // TODO create alert, "Employee Code / email Used"
      }


    } else {
      $data['e'] = validation_errors();

      $this->load->view('_notif/error', $data);

    }

    redirect('admin/employee');
  }

  public function add_post($emp_code)
  {
    $data['emp_code'] = $emp_code;
    $data['date']     = $this->session->userdata('timeframe');
    $data['process']  = 'admin/employee/add_post_process';
    $data['hidden']   = array('emp_code' => $emp_code);

    $data['begin']    = date('Y-m-d');
    $data['end']      = '9999-12-31';
    $data['org_code'] = '';
    $data['org_name'] = '';

    $this->load->view('admin/emp/post_form', $data, FALSE);
  }

  public function edit_name()
  {
    $emp_code = $this->input->post('hdn_emp');
    $name     = $this->input->post('txt_name');
    $start    = $this->input->post('dt_begin');
  }

  public function edit_contact()
  {
    $emp_code = $this->input->post('hdn_emp');
    $email    = $this->input->post('txt_email');
    $phone    = $this->input->post('txt_phone');
  }

  public function edit_pass()
  {
    $emp_code = $this->input->post('hdn_emp');
   
  }

  public function delete()
  {
    $this->load->model('user_model');
    $emp_code  = $this->input->post('emp_code');
    
    // TODO Check apakah user ini telah memiliki achivement atau balance score card?
    // Jika ada, maka delimit object dan user employeenya
    // Jika tidak boleh dihapus  
    $this->user_model->remove_user($emp_code,'username');
    $this->om_model->remove_emp($emp_code,'code');

  }

}

/* End of file employee.php */
/* Location: ./application/controllers/admin/employee.php */