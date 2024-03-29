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
		$date_range = $this->session->userdata('timeframe');
		$data['link_edit_org'] = 'admin/org/edit_attr/';
		$data['page_title']    = lang('om_org');
		$data['filter_date']   = $date_range;
		$data['org_id']        = $org_id;

		$this->load->view('admin/org/main_view',$data);
	}

	public function get_child()
	{
		$org_id = $this->input->post('org_id');
		
		$begin = $this->input->post('begin');
		$end = $this->input->post('end');
		$ls = $this->om_model->get_org_list($org_id,$begin,$end);
		$respond = '';
		foreach ($ls as $row) {
			$respond .= '<tr class="opt-org " data-org-id="'.$row->org_id.'" ><td class="info">'.$row->org_code .'</td><td class="org_name">'.$row->org_name.'</td></tr>';
		}
		echo $respond;
	}

	public function show_last()
	{
		$org_id     = $this->input->post('org_id');
		$date_range = $this->input->post('date_range');
		$this->session->set_userdata('timeframe',$date_range);
		list($begin,$end) = explode(' - ', $date_range);
		$data['org'] = $this->om_model->get_org_row($org_id,$begin,$end);
		echo $this->load->view('admin/org/detail_view', $data, TRUE);
	}

	public function show_attr()
	{
		$org_id     = $this->input->post('org_id');
		$date_range = $this->input->post('date_range');
		list($begin,$end) = explode(' - ', $date_range);
		
		$data['attr_ls'] = $this->om_model->get_obj_attr_list($org_id,$begin,$end);
		echo $this->load->view('admin/org/attribute_list', $data, TRUE);
		
	}

	public function show_rel()
	{
		$org_id     = $this->input->post('org_id');
		$date_range = $this->input->post('date_range');
		list($begin,$end) = explode(' - ', $date_range);
		$data['add_rel'] = 'admin/org/add_rel';
		$data['rel_ls']  = $this->om_model->get_obj_rel_list($org_id,'all','',$begin,$end);
		echo $this->load->view('admin/org/relation_list', $data, TRUE);
	}

	public function add()
	{
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

	public function add_rel()
	{
		$org_id = $this->input->post('org_id');
		$date_range = $this->input->post('date_range');
		list($begin,$end) = explode(' - ', $date_range);
		$begin     = str_replace('/', '-', $begin);
		$end       = str_replace('/', '-', $end);
		$data['process'] = 'admin/org/add_rel_process';
		$data['org_id']  = $org_id;
		$data['begin']   = $begin;
		$data['end']     = $end;
		$data['rel_obj'] = '';
		$this->load->view('admin/org/relation_add_form', $data, FALSE);
	}

	public function add_rel_process()
	{
		$this->form_validation->set_rules('slc_type', 'Type', 'trim|required|xss_clean');
		$this->form_validation->set_rules('txt_obj', 'rel obj', 'trim|integer|greater_than[0]|required||xss_clean');
		$this->form_validation->set_rules('dt_begin', 'Begin Date', 'trim|required|xss_clean');
		$this->form_validation->set_rules('dt_end', 'End Date', 'trim|required|xss_clean');

		if ($this->form_validation->run()) {
			$org_id   = $this->input->post('org_id');
			$type_dir = $this->input->post('slc_type');
			$rel_obj  = $this->input->post('txt_obj');
			$begin    = $this->input->post('dt_begin');
			$end      = $this->input->post('dt_end');
			$type     = substr($type_dir, 0,3);
			$dir      = substr($type_dir, 3,1);

			switch ($dir) {
				case 'A':
					$obj_from = $rel_obj;
					$obj_to 	= $org_id;
					break;
				case 'B':
					$obj_from = $org_id;
					$obj_to 	= $rel_obj;
					break;
			}

			$obj_type = $this->om_model->get_obj_row($rel_obj)->obj_type;

			switch ($type) {
				case '002':
					if ($obj_type == 'O') {
						$flag = TRUE;
					} else {
						$flag = FALSE;
					}
					break;
				
				case '003':
				case '012':
					if ($obj_type == 'S') {
						$flag = TRUE;
					} else {
						$flag = FALSE;
					}
					break;
			}

			if ($flag) {
				$this->om_model->add_obj_rel($type,$obj_from,$obj_to,$begin,$end);
				$this->load->view('_notif/success');
			} else {
				$data['e'] = 'Object not Valid';
				$this->load->view('_notif/error', $data);
			}

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
		$data['org_begin']  = $org->org_begin;
		$data['org_end']    = $org->org_end;
		$data['process']    = 'admin/org/edit_attr_process';

		$this->load->view('admin/org/attribute_form', $data, FALSE);
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
					$this->om_model->update_org($org_id,$code,$name,$attr_begin,$attr_end);
					break;
				case 'corect':
					$this->om_model->correct_org($org_id,$code,$name,$attr_begin,$attr_end);
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
		$org_id     = $this->input->post('obj_id');
		$date_range = $this->input->post('date_range');
		list($begin,$end) = explode(' - ', $date_range);
		$begin = str_replace('/', '-', $begin);
		$end   = str_replace('/', '-', $end);
		$org   = $this->om_model->get_org_row($org_id,$begin,$end);
		$data['header_view'] = 'admin/org/org_header';
		$data['process']     = 'admin/org/delete_process';
		$data['org_id']      = $org_id;
		$data['org']         = $org;
		$data['end']         = $org->org_end;
		$this->load->view('admin/org/delete_form', $data, FALSE);
	}

	public function delete_process()
	{
		$org_id = $this->input->post('org_id');
		$end    = $this->input->post('dt_end');
		$mode   = $this->input->post('slc_mode');

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
				$this->om_model->remove_org($org_id);
				
				$this->load->view('_notif/success');
				break;
		}
	}

	public function delete_rel()
	{
		$rel_id     = $this->input->post('rel_id');
		$org_id     = $this->input->post('org_id');
		$date_range = $this->input->post('date_range');
		list($begin,$end) = explode(' - ', $date_range);

		$begin = str_replace('/', '-', $begin);
		$end   = str_replace('/', '-', $end);
		$rel   = $this->om_model->get_obj_rel_row($rel_id);
		
		$data['header_view'] = 'admin/org/relation_header';
		$data['process']     = 'admin/org/delete_rel_process';
		$data['rel_id']      = $rel_id;
		$data['rel']         = $rel;
		$data['end']         = $rel->end;
		echo $this->load->view('admin/org/relation_delete_form', $data, TRUE);
	}

	public function delete_rel_process()
	{
		$rel_id =  $this->input->post('rel_id');
		$end  = $this->input->post('dt_end');
		$mode = $this->input->post('slc_mode');

		switch ($mode) {
			case 'delimit':
				$this->form_validation->set_rules('dt_end', lang('basic_end'), 'trim|required|xss_clean');
				if ($this->form_validation->run()) {
					// DO delimit relation
					$this->om_model->delimit_obj_rel($org_id,$end);
					$this->load->view('_notif/success'); 
				} else {
					// DO Notif Error
					$data['e'] = validation_errors();
					$this->load->view('_notif/error', $data);
				}
				
				break;
			case 'remove':
				// DO remove relation
				$this->om_model->remove_obj_rel($org_id);
				
				$this->load->view('_notif/success');
				break;
		}
	}

}

/* End of file org.php */
/* Location: ./application/controllers/admin/org.php */