<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Report_struc extends CI_Controller {

  function __construct()
  {
    parent::__construct();
    if ($this->session->userdata('login_user') == FALSE) {
      redirect('account/login');
    }
    $this->load->model('om_model');
  }
  public function index()
  {
    $date_range = $this->session->userdata('timeframe');
    if ($date_range=='') {
      $date_range = date('Y').'/01/01 - '.date('Y').'/12/31';
    }
    $data['page_title']     = lang('menu_report_struc');
    $data['filter_date']    = $date_range;
    $data['link_edit_post'] = 'admin/post/edit_attr/';
    $data['link_add_post']  = 'admin/post/add/';
    $data['parent_id']      = $this->config->item('root_chief');;
    $this->load->view('admin/report_struc/main_view',$data);
  }

  public function show_current()
  {
    $date_range = $this->input->post('date_range');
    $post_id     = $this->input->post('obj_id');
    
    $this->session->set_userdata('timeframe', $date_range );

    list($begin,$end) = explode(' - ', $date_range);

    $begin = str_replace('/', '-', $begin);
    $end   = str_replace('/', '-', $end);

    $row = $this->om_model->get_post_row($post_id,$begin,$end);
    echo $row->post_code .' - '.$row->post_name;

  }

  public function show_breadcrumb()
  {
    $date_range = $this->input->post('date_range');
    $post_id     = $this->input->post('obj_id');
    list($begin,$end) = explode(' - ', $date_range);

    $begin = str_replace('/', '-', $begin);
    $end   = str_replace('/', '-', $end);

    $cur_post = $this->om_model->get_post_row($post_id,$begin,$end);
    $t_org    = $cur_post;
    $temp     = array();
    while ($t_org->post_id > 2) {
      $parent_id = $this->om_model->get_obj_rel_last($t_org->post_id,'A','002',$begin,$end)->obj_from; 
      $t_org     = $this->om_model->get_post_row($parent_id,$begin,$end);
      $temp[]    = $t_org;
    }
    $max    = count($temp)-1;
    $result = '<ol class="breadcrumb">';

    for ($i=$max; $i>=0; $i--) { 
      $row = $temp[$i];
      $result .= '<li >';
      $result .= '<a href="#" class="link-org" data-org="'.$row->post_id.'">'.$row->post_name.'</a>';
      $result .= '</li>';
    }
    $result .= '<li class="active">'.$cur_post->post_name.'</li>';
    $result .= '</ol>';

    echo $result;
  
  }

  public function show_child()
  {

    $date_range = $this->input->post('date_range');
    $chief      = $this->input->post('parent');

    if (!is_numeric($chief) OR $chief < 2 ) {
      $chief = 2;
    }

    list($begin,$end) = explode(' - ', $date_range);

    $begin   = str_replace('/', '-', $begin);
    $end     = str_replace('/', '-', $end);
      
    $chief_ls = $this->om_model->get_sub_post_list($chief,$begin,$end,1);
    $post_ls  = $this->om_model->get_sub_post_list($chief,$begin,$end,0);

    $data['chief_ls'] = $chief_ls;
    $data['post_ls']  = $post_ls;

    echo $this->load->view('admin/report_struc/list_view', $data, TRUE);
      
  }




}

/* End of file report_struc.php */
/* Location: ./application/controllers/admin/report_struc.php */