<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Report_struc extends CI_Controller {

  public function index()
  {
    $date_range = $this->session->userdata('timeframe');
    if ($date_range=='') {
      $date_range = date('Y').'/01/01 - '.date('Y').'/12/31';
    }
    $data['page_title']    = lang('menu_report_struc');
    $data['filter_date']   = $date_range;
    $data['link_edit_org'] = 'admin/org/edit_attr/';
    $data['link_add_org']  = 'admin/org/add/';
    $data['link_add_post'] = 'admin/post/add/';
    $data['parent_id']     = 1;
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

    $org_row = $this->om_model->get_org_row($post_id,$begin,$end);
    echo $org_row->org_code .' - '.$org_row->org_name;

  }

  public function show_breadcrumb()
  {
    $date_range = $this->input->post('date_range');
    $post_id     = $this->input->post('obj_id');
    list($begin,$end) = explode(' - ', $date_range);

    $begin = str_replace('/', '-', $begin);
    $end   = str_replace('/', '-', $end);

    $cur_org = $this->om_model->get_org_row($post_id,$begin,$end);
    $t_org   = $cur_org;
    $temp    = array();
    while ($t_org->post_id > 1) {
      $parent_id = $this->om_model->get_obj_rel_last($t_org->post_id,'A','002',$begin,$end)->obj_from; 
      $t_org     = $this->om_model->get_org_row($parent_id,$begin,$end);
      $temp[]    = $t_org;
    }
    $max    = count($temp)-1;
    $result = '<ol class="breadcrumb">';

    for ($i=$max; $i>=0; $i--) { 
      $row = $temp[$i];
      $result .= '<li >';
      $result .= '<a href="#" class="link-org" data-org="'.$row->post_id.'">'.$row->org_name.'</a>';
      $result .= '</li>';
    }
    $result .= '<li class="active">'.$cur_org->org_name.'</li>';
    $result .= '</ol>';

    echo $result;
  
  }

  public function show_child()
  {

    $date_range = $this->input->post('date_range');
    $parent     = $this->input->post('parent');

    if (!is_numeric($parent) OR $parent < 1 ) {
      $parent = 1;
    }

    list($begin,$end) = explode(' - ', $date_range);

    $begin   = str_replace('/', '-', $begin);
    $end     = str_replace('/', '-', $end);
      
    $data['org_ls']  = $org_ls;
    $data['post_ls'] = $post_ls;
    if ($chief) {
      $data['chief']   = $chief;
    }
    echo $this->load->view('admin/report_struc/list_view', $data, TRUE);
      
  }




}

/* End of file report_struc.php */
/* Location: ./application/controllers/admin/report_struc.php */