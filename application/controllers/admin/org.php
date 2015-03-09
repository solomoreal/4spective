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
		$data['process']   = 'admin/org/add_process';

		$data['parent_id'] = $parent->org_id;

		$this->load->view('admin/org/add_form', $data, FALSE);
	}

	public function add_process()
	{
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
			
	}

	public function edit_attr()
	{
		$org_id     = $this->input->post('obj_id');
		$date_range = $this->input->post('date_range');
		list($begin,$end) = explode(' - ', $date_range);
		$begin  = str_replace('/', '-', $begin);
		$end    = str_replace('/', '-', $end);
		$org    = $this->om_model->get_org_row($org_id,$begin,$end);
		$parent = $this->om_model->get_org_parent_row($org_id,$begin,$end);

		if (count($parent)) {
			$data['parent']     = $parent;
		}
		$data['org_id']     = $org_id;
		$data['org_code']   = $org->org_code;
		$data['org_name']   = $org->org_name;
		$data['attr_begin'] = $org->attr_begin;
		$data['attr_end']   = $org->attr_end;
		$data['process']		= 'admin/org/edit_attr_process';

		$this->load->view('admin/org/attr_form', $data, FALSE);
	}

	public function edit_attr_process()
	{
		$org_id     = $this->input->post('org_id');
		$code       = $this->input->post('txt_code');
		$name       = $this->input->post('txt_name');
		$attr_begin = $this->input->post('dt_begin');
		$attr_end   = $this->input->post('dt_end');
		$mode       = $this->input->post('slc_mode');

		$this->form_validation->set_rules('txt_code', lang('om_org_code'), 'trim|required|min_length[3]|max_length[255]|xss_clean');
		$this->form_validation->set_rules('txt_name', lang('om_org_name'), 'trim|required|min_length[5]|max_length[255]|xss_clean');
		$this->form_validation->set_rules('dt_begin', 'Begin Date', 'trim|required|xss_clean');
		$this->form_validation->set_rules('dt_end', 'End Date', 'trim|required|xss_clean');
		$this->form_validation->set_rules('slc_mode', 'Mode', 'trim|required|xss_clean');

		if ($this->form_validation->run()) {
			switch ($mode) {
				case 'update':
					$this->om_model->update_org($org_id,$org_code,$org_name,$attr_begin,$attr_end);
					break;
				case 'corect':
					$this->om_model->correct_org($org_id,$org_code,$org_name,$attr_begin,$attr_end);
					break;
			}
			$this->load->view('_notif/success');

			
		} else {
			$data['e'] = validation_errors();
			$this->load->view('_notif/error', $data);
		}

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
				$this->form_validation->set_rules('dt_end', lang('basic_end'), 'trim|required|xss_clean');
				if ($this->form_validation->run()) {
					// DO delimit org
					$this->om_model->delimit_org($org_id,$end);
					$this->load->view('_notif/success'); 
				} else {
					// DO Notif Error
					$data['e'] = validation_errors();
					$this->load->view('_notif/error', $data);
				}
				
				break;
			case 'remove':
				// DO remove org
				$this->om_model->remove_org($org_id,$end);
				
				$this->load->view('_notif/success');
				break;
		}

	}

}

/* End of file org.php */
/* Location: ./application/controllers/admin/org.php */