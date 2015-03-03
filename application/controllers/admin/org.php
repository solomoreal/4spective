<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Org extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('om_model');
	}

	public function index()
	{
		redirect('admin/org_struc');
	}

	public function add()
	{
		$this->load->library('form_builder');
		// $parent_id  = $this->input->post('parent');
		// $date_range = $this->input->post('date_range');
		// list($begin,$end) = explode(' - ', $date_range);
		// $begin     = str_replace('/', '-', $begin);
		// $end       = str_replace('/', '-', $end);
		$parent_id = 1;
		$begin = '2014-01-01';
		$end   = '9999-12-31';
		$data['process'] = '';
		
		$parent    = $this->om_model->get_org_row($parent_id,$begin,$end);
		$org_code  = '';
		$org_name  = '';
		$org_begin = $begin;
		$org_end   = '9999-12-31';

		// $hidden    = array(
		// 	'parent_id' => $parent->org_id);
		$data['parent']    = $parent;
		$data['org_code']  = $org_code;
		$data['org_name']  = $org_name;
		$data['org_begin'] = $org_begin;
		$data['org_end']   = $org_end;
		$data['parent_id'] = $parent->org_id;

		$this->load->view('admin/org/add_form', $data, FALSE);
	}

	public function add_process()
	{
		$parent_id = $this->input->post('parent_id');
		$code 		 = $this->input->post('txt_code');
		$name 		 = $this->input->post('txt_name');
		$begin 		 = $this->input->post('dt_begin');
		$end  		 = $this->input->post('dt_end');

		$this->om_model->add_org($code,$name,$parent_id,$begin,$end);
		$this->load->view('_template/notif_view', $data, FALSE);
		
	}

	public function edit_attr()
	{
		$org_id     = $this->input->post('org_id');
		$date_range = $this->input->post('date_range');
		list($begin,$end) = explode(' - ', $date_range);
		$begin  = str_replace('/', '-', $begin);
		$end    = str_replace('/', '-', $end);
		$org    = 		$this->om_model->get_org_row($org_id,$begin,$end);
		$parent = $this->om_model->get_org_parent_row($org_id,$begin,$end);

		$org_code   = $org->org_code;
		$org_name   = $org->org_name;
		$attr_begin = $org->attr_begin;
		$attr_end   = $org->attr_end;
		$hidden     = array(
			'parent_id' => $parent->org_id,
			'org_id'    => $org->org_id);

		$data['parent']     = $parent;
		$data['org_code']   = $org_code;
		$data['org_name']   = $org_name;
		$data['attr_begin'] = $org_begin;
		$data['attr_end']   = $org_end;
		$data['hidden']     = $hidden;

		$this->load->view('admin/org/attr_form', $data, FALSE);
	}

	public function edit_attr_process()
	{
		$org_id     = $this->input->post('org_id');
		$code       = $this->input->post('txt_code');
		$name       = $this->input->post('txt_name');
		$attr_begin = $this->input->post('dt_begin');
		$attr_end   = $this->input->post('dt_end');
		$mode       = $this->input->post('rd_mode');

		switch ($mode) {
			case 'update':
				
				break;
			case 'corection':
				
				break;
		}

		$this->load->view('_template/notif_view', $data, FALSE);

	}

	public function delete()
	{
		$org_id = $this->input->post('org_id');
		
		$data['org'] = $this->om_model->get_org_row($org_id,$begin,$end);
		$this->load->view('admin/org/delete_form', $data, FALSE);
	}

	public function delete_process()
	{
		$end  = $this->input->post('dt_end');
		$mode = $this->input->post('rd_mode');

		switch ($mode) {
			case 'delimit':
				
				break;
			case 'remove':
				
				break;
		}
	}

}

/* End of file org.php */
/* Location: ./application/controllers/admin/org.php */