<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Period extends CI_Controller {
	function __construct()
	{
		parent::__construct();
		$this->load->model('sc_m_model');
	}

	public function index()
	{
		$data['page_title']  = lang('menu_period');
		$data['link_add']    = 'admin/period/add/';
		$data['link_edit']   = 'admin/period/edit/';
		$data['link_remove'] = 'admin/period/remove/';
		$data['period_ls'] = $this->sc_m_model->get_period_list('2008-01-01','9999-12-31'); 
		$this->load->view('admin/setting/period/main_view',$data);
	}

	public function add()
	{
		$data['process'] = 'admin/period/add_process';
		$data['code']    = date('Y');
		$data['begin']   = date('Y').'-01-01';
		$data['end']     = date('Y').'-12-31';
		$this->load->view('admin/setting/period/form', $data, FALSE);
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
			$this->sc_m_model->add_period($code,$begin,$end);
			$this->load->view('_notif/success');

		} else {
			$data['e'] = validation_errors();

			$this->load->view('_notif/error', $data);
		}

	}

	public function edit()
	{
		$code  = $this->input->post('code');
		$period = $this->sc_m_model->get_period_row($code);
		$data['code']    = $code;
		$data['begin']   = $period->begin;
		$data['end']     = $period->end;
		$data['process'] = 'admin/period/edit_process';
		$this->load->view('admin/setting/period/form', $data, FALSE);
	}

	public function edit_process()
	{
		$this->form_validation->set_rules('dt_begin', lang('basic_begin'), 'trim|required|xss_clean');
		$this->form_validation->set_rules('dt_end', lang('basic_end'), 'trim|required|xss_clean');
		if ($this->form_validation->run()) {
			$code  = $this->input->post('hdn_code');
			$begin = $this->input->post('dt_begin');
			$end   = $this->input->post('dt_end');
			$this->sc_m_model->edit_period($code,$begin,$end);
			$this->load->view('_notif/success');

		} else {
			$data['e'] = validation_errors();

			$this->load->view('_notif/error', $data);
		}

	}

	public function remove()
	{
		$code  = $this->input->post('code');
		$period = $this->sc_m_model->get_period_row($code);
		$data['code']    = $code;
		$data['begin']   = $period->begin;
		$data['end']     = $period->end;
		$data['process'] = 'admin/period/remove_process';
		$this->load->view('_template/remove_form', $data);

	}

	public function remove_process()
	{
		$code = $this->input->post('hdn_code');
		$pass = $this->input->post('txt_code');
		if (strtoupper($pass)=='DELETE' ) {
			$this->sc_m_model->remove_period($code);
			$this->load->view('_notif/success');
			
		} else {
			$data['e'] = 'Please type DELETE to confirm action';
			$this->load->view('_notif/error', $data);
		}
	}

}

/* End of file period.php */
/* Location: ./application/controllers/admin/period.php */