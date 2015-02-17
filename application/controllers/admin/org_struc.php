<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Org_struc extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('om_model');
	}

	public function index()
	{
		$data['page_title']  = 'Organization';
		$data['filter_date'] = date('Y').'/01/01 - '.date('Y').'/12/31';
		$this->load->view('admin/org/main_view',$data);
	}

	public function show_current()
	{
		$date_range = $this->input->post('date_range');
		$org_id     = $this->input->post('org_id');

		list($begin,$end) = explode(' - ', $date_range);

		$begin = str_replace('/', '-', $begin);
		$end   = str_replace('/', '-', $end);

		$org_row = $this->om_model->get_org_row($org_id,$begin,$end);
		echo $org_row->org_code .' - '.$org_row->org_name;

	}

	public function show_breadcrumb()
	{
		$date_range = $this->input->post('date_range');
		$org_id     = $this->input->post('org_id');
		list($begin,$end) = explode(' - ', $date_range);

		$begin = str_replace('/', '-', $begin);
		$end   = str_replace('/', '-', $end);

		$cur_org = $this->om_model->get_org_row($org_id,$begin,$end);
		$t_org   = $cur_org;
		$temp    = array();
		while ($t_org->org_id > 1) {
			$parent_id = $this->om_model->get_obj_rel_last($t_org->org_id,'B','002',$begin,$end)->obj_to;
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

		$org_ls  = $this->om_model->get_org_list($parent,$begin,$end);
		$post_ls = $this->om_model->get_post_list($parent,$begin,$end,0);
		$chief   = $this->om_model->get_chief_row($parent,$begin,$end);
				
		$data['org_ls']  = $org_ls;
		$data['post_ls'] = $post_ls;
		$data['chief']   = $chief;
		echo $this->load->view('admin/org/list_view', $data, TRUE);
			
	}



}

/* End of file org_struc.php */
/* Location: ./application/controllers/admin/org_struc.php */