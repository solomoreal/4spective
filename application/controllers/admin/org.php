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

	public function detail($org_id=0)
	{
		$begin = '2008-01-01';
		$end   = '9999-12-31';
		$last_attr = $this->om_model->get_org_row($org_id,$begin,$end);
		$attr_ls = $this->om_model->get_obj_attr_list($org_id,$begin,$end);
		$rel_ls = $this->om_model->get_obj_rel_list($org_id,'all','',$begin,$end);
	}

	public function add()
	{
		$this->load->library('form_builder');
		$parent_id  = $this->input->post('parent');
		$date_range = $this->input->post('date_range');
		list($begin,$end) = explode(' - ', $date_range);
		$begin     = str_replace('/', '-', $begin);
		$end       = str_replace('/', '-', $end);
		
		$parent    = $this->om_model->get_org_row($parent_id,$begin,$end);
		$org_code  = '';
		$org_name  = '';
		$org_begin = $begin;
		$org_end   = '9999-12-31';

		$data['process']   = 'admin/org/add_process';
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
		try {
			$this->form_validation->set_rules('txt_code', lang('om_org_code'), 'trim|required|min_length[3]|max_length[255]|xss_clean');
			$this->form_validation->set_rules('txt_name', lang('om_org_name'), 'trim|required|min_length[5]|max_length[255]|xss_clean');
			$this->form_validation->set_rules('dt_begin', 'Begin Date', 'trim|required|xss_clean');
			$this->form_validation->set_rules('dt_end', 'End Date', 'trim|required|xss_clean');
			if ($this->form_validation->run()) {
				$parent_id = $this->input->post('parent_id');
				$code 		 = $this->input->post('txt_code');
				$name 		 = $this->input->post('txt_name');
				$begin 		 = $this->input->post('dt_begin');
				$end  		 = $this->input->post('dt_end');
				$this->om_model->add_org($code,$name,$parent_id,$begin,$end);
				$this->load->view('_notif/success');

			} else {
				$data['e'] = validation_errors();

				$this->load->view('_notif/error', $data);

			}
			
		} catch (Exception $e) {
			$data['e'] = $e;
			$this->load->view('_notif/error', $data);

		}	
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
		$this->load->library('form_builder');
		$org_id     = $this->input->post('obj_id');
		$date_range = $this->input->post('date_range');
		list($begin,$end) = explode(' - ', $date_range);
		$begin = str_replace('/', '-', $begin);
		$end   = str_replace('/', '-', $end);
		$data['process'] = 'admin/org/delete_process';
		$data['org_id']  = $org_id;
		$data['org']     = $this->om_model->get_org_row($org_id,$begin,$end);
		$this->load->view('admin/org/delete_form', $data, FALSE);
	}

	public function delete_process()
	{
		$org_id =  $this->input->post('org_id');
		$end  = $this->input->post('dt_end');
		$mode = $this->input->post('slc_mode');

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