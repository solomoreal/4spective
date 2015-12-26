<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Employee extends CI_Controller {
  
  public function __construct()
  {
    parent::__construct();
    if ($this->session->userdata('login_user') == FALSE) {
      redirect('account/login');
    }
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
    $data['hidden']      = array('emp_code' => $emp_code);

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
    $emp_code   = $this->input->post('emp_code');
    $date_range = $this->input->post('date_range');
    // $this->session->set_userdata('timeframe',$date_range);
    if ($date_range == '') {
      $date_range = date('Y').'/01/01 - '.date('Y').'/12/31';
    }
    list($begin,$end) = explode(' - ', $date_range);
    $emp = $this->om_model->get_emp_row($emp_code,$begin,$end);

    echo json_encode($emp);
  }

  public function show_post()
  {
    $emp_code   = $this->input->post('emp_code');
    $date_range = $this->input->post('date_range');
    if ($date_range == '') {
      $date_range = date('Y').'/01/01 - '.date('Y').'/12/31';
    }
    list($begin,$end) = explode(' - ', $date_range);
    $post_ls = $this->om_model->get_hold_list($emp_code,$begin,$end);
    $respond = '';
    foreach ($post_ls as $row) {
      $data['id']     = $row->post_id;
      $data['code']   = $row->post_code;
      $data['name']   = $row->post_name;
      $data['begin']  = $row->rel_begin;
      $data['end']    = $row->rel_end;
      $data['value']  = $row->rel_value;
      $data['rel_id'] = $row->rel_id;
      $respond .= $this->load->view('admin/emp/post_list', $data,TRUE);
    }
    echo $respond;

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

    $data['begin']     = date('Y-m-d');
    $data['end']       = '9999-12-31';
    $data['org_id']    = 1;
    $data['post_id']   = '';
    $data['post_name'] = '';
    $data['value']     = 1;

    $this->load->view('admin/emp/post_form', $data, FALSE);
  }

  public function add_post_process()
  {
    $begin    = $this->input->post('dt_begin');
    $end      = $this->input->post('dt_end');
    $post_id  = $this->input->post('post_id');
    $emp_code = $this->input->post('emp_code');
    $value    = $this->input->post('nm_value');

    $this->om_model->add_emp_post($emp_code,$post_id,$begin,$end,$value);
    redirect('admin/employee/detail/'.$emp_code);
  }

  public function edit_name()
  {
    $emp_code = $this->input->post('emp_code');
    $name     = $this->input->post('txt_name');
    $join     = $this->input->post('dt_start');
    $end      = $this->input->post('dt_end');
    $this->om_model->correct_emp_name($emp_code,$name);
    redirect('admin/employee/detail/'.$emp_code);
  }

  public function edit_contact()
  {
    $this->load->model('user_model');

    $emp_code = $this->input->post('emp_code');
    $email    = $this->input->post('txt_email');
    $phone    = $this->input->post('txt_phone');
    $user_id  = $this->user_model->get_username_row($emp_code)->user_id; 
    $this->user_model->edit_contact($user_id,$email,$phone);
    redirect('admin/employee/detail/'.$emp_code);

  }

  public function edit_pass()
  {
    $this->load->model('user_model');

    $emp_code = $this->input->post('emp_code');
    $password = $this->input->post('txt_pass');
    $confirm  = $this->input->post('txt_confrim');
    $user_id  = $this->user_model->get_username_row($emp_code)->user_id;
    if ($confirm == $password) {
      $this->user_model->edit_password($user_id,$password);
      // TODO send Email Employee password 
      // $this->load->library('email');
      
      // $this->email->from('email@email.com', 'Name');
      // $this->email->to($email);
      
      
      // $this->email->subject('4spective Changed Password');
      // $this->email->message('message');
      
      // $this->email->send();
      
      // echo $this->email->print_debugger();
    }
    redirect('admin/employee/detail/'.$emp_code);
    
  }

  public function edit_hold()
  {
    $emp_code = $this->input->post('emp_code');
    $rel      = $this->input->post('hdn_hold');
    $value    = $this->input->post('nm_value');
    $begin    = $this->input->post('dt_hold_begin');
    $end      = $this->input->post('dt_hold_end');

    $this->om_model->edit_obj_rel($rel,$begin,$end,$value);
    redirect('admin/employee/detail/'.$emp_code,'refresh');
  }

  public function remove_hold()
  {
    $rel_id = $this->input->post('rel_id');
    $this->om_model->remove_obj_rel($rel_id);
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

  public function dir_path()
  {
    $begin  = $this->input->post('begin');
    $end    = $this->input->post('end');
    $org_id = $this->input->post('org_id');

    $begin = str_replace('/', '-', $begin);
    $end   = str_replace('/', '-', $end);

    $cur_org = $this->om_model->get_org_row($org_id,$begin,$end);
    $t_org   = $cur_org;
    $temp    = array();
    while ($t_org->org_id > 1) {
      $parent_id = $this->om_model->get_obj_rel_last($t_org->org_id,'A','002',$begin,$end)->obj_from; 
      $t_org     = $this->om_model->get_org_row($parent_id,$begin,$end);
      $temp[]    = $t_org;
    }
    $max    = count($temp)-1;
    $result = '<ol class="breadcrumb">';

    for ($i=$max; $i>=0; $i--) { 
      $row = $temp[$i];
      $result .= '<li >';
      $result .= '<a href="#" class="link-org" data-org="'.$row->org_id.'">'.$row->org_name.'</a>';
      $result .= '</li>';
    }
    $result .= '<li class="active">'.$cur_org->org_name.'</li>';
    $result .= '</ol>';

    echo $result;
  }

  public function dir_ls()
  {
    $begin  = $this->input->post('begin');
    $end    = $this->input->post('end');
    $parent     = $this->input->post('parent');

    if (!is_numeric($parent) OR $parent < 1 ) {
      $parent = 1;
    }

    $begin   = str_replace('/', '-', $begin);
    $end     = str_replace('/', '-', $end);

    $org_ls  = $this->om_model->get_org_list($parent,$begin,$end);
    $post_ls = $this->om_model->get_post_vacant_ls($parent,$begin,$end);
      
    $data['org_ls']  = $org_ls;
    $data['post_ls'] = $post_ls;
    echo $this->load->view('admin/emp/om_list', $data, TRUE);
  }

  public function test()
  {
    $ls = $this->om_model->get_subordinate_filled_list(2,'2008-01-01','9999-12-31');

    foreach ($ls as $row) {
      echo '<br>'.var_dump($row);
    }

    echo '<hr>';
    $ls = $this->om_model->get_subordinate_vacant_list(2,'2008-01-01','9999-12-31');
    foreach ($ls as $row) {
      echo '<br>'.var_dump($row);
    }
    
    
  }

}

/* End of file employee.php */
/* Location: ./application/controllers/admin/employee.php */