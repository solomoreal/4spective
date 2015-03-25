<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Count_unit extends CI_Controller {
	function __construct()
	{
		parent::__construct();
		$this->load->model('bsc_m_model');
	}

	public function index()
	{
		$data['page_title']  = lang('menu_count_unit');
		$data['link_add']    = 'admin/count_unit/add/';
		$data['link_edit']   = 'admin/count_unit/edit/';
		$data['link_remove'] = 'admin/count_unit/remove/';
		$data['count_unit_ls'] = $this->bsc_m_model->get_measure_list(); 
		$this->load->view('admin/setting/count_unit/main_view',$data);
	}

	public function add()
	{
		$data['process'] = 'admin/count_unit/add_process';
		$data['hidden']  = array();
		$data['short']   = '';
		$data['long']    = '';
		$data['desc']    = '';
		$data['has_min'] = FALSE;
		$data['min_val'] = 0;
		$data['has_max'] = FALSE;
		$data['max_val'] = 0;
		$data['is_real'] = TRUE;

		$this->load->view('admin/setting/count_unit/form', $data, FALSE);
	}

	public function add_process()
	{
		$this->form_validation->set_rules('txt_code', lang('basic_code'), 'trim|required|min_length[4]|max_length[6]|xss_clean');
		$this->form_validation->set_rules('dt_begin', lang('basic_begin'), 'trim|required|xss_clean');
		$this->form_validation->set_rules('dt_end', lang('basic_end'), 'trim|required|xss_clean');
		if ($this->form_validation->run()) {
			$code  = $this->input->post('txt_code');
			$begin = $this->input->post('dt_begin');
			$end   = $this->input->post('dt_end');
			$this->bsc_m_model->add_count_unit($code,$begin,$end);
			$this->load->view('_notif/success');

		} else {
			$data['e'] = validation_errors();

			$this->load->view('_notif/error', $data);
		}

	}

	public function edit()
	{
		$code = $this->input->post('code');
		$old  = $this->bsc_m_model->get_measure_row($code);
		$data['hidden']  = array();
		$data['short']   = $old->short_name;
		$data['long']    = $old->long_name;
		$data['desc']    = $old->description;
		$data['has_min'] = $old->has_min;
		$data['min_val'] = $old->min_val;
		$data['has_max'] = $old->has_max;
		$data['max_val'] = $old->max_val;
		$data['is_real'] = $old->real_num;
		$data['process'] = 'admin/count_unit/edit_process';
		$this->load->view('admin/setting/count_unit/form', $data, FALSE);
	}

	public function edit_process()
	{
		$this->form_validation->set_rules('dt_begin', lang('basic_begin'), 'trim|required|xss_clean');
		$this->form_validation->set_rules('dt_end', lang('basic_end'), 'trim|required|xss_clean');
		if ($this->form_validation->run()) {
			$code  = $this->input->post('hdn_code');
			$begin = $this->input->post('dt_begin');
			$end   = $this->input->post('dt_end');
			$this->bsc_m_model->edit_count_unit($code,$begin,$end);
			$this->load->view('_notif/success');

		} else {
			$data['e'] = validation_errors();

			$this->load->view('_notif/error', $data);
		}

	}

	public function remove()
	{
		$code  = $this->input->post('code');
		$count_unit = $this->bsc_m_model->get_measure_row($code);
		$data['code']    = $code;
		$data['process'] = 'admin/count_unit/remove_process';
		$this->load->view('_template/remove_form', $data);

	}

	public function remove_process()
	{
		$code = $this->input->post('hdn_code');
		$pass = $this->input->post('txt_code');
		if (strtoupper($pass)=='DELETE' ) {
			$this->bsc_m_model->remove_count_unit($code);
			$this->load->view('_notif/success');
			
		} else {
			$data['e'] = 'Please type DELETE to confirm action';
			$this->load->view('_notif/error', $data);
		}
	}

}

/* End of file count_unit.php */
/* Location: ./application/controllers/admin/count_unit.php */