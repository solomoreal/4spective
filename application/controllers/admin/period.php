<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Period extends CI_Controller {
	function __construct()
	{
		parent::__construct();
		$this->load->model('bsc_m_model');
	}

	public function index()
	{
		$data['page_title']  = lang('menu_period');
		$data['link_add']    = 'admin/period/add/';
		$data['link_edit']   = 'admin/period/edit/';
		$data['link_remove'] = 'admin/period/remove/';
		$data['period_ls'] = $this->bsc_m_model->get_perio_list('2008-01-01','9999-12-31'); 
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
		$code  = $this->input->post('txt_code');
		$begin = $this->input->post('dt_begin');
		$end   = $this->input->post('dt_end');
		$this->bsc_m_model->add_period($code,$begin,$end);

	}

	public function edit()
	{
		$code  = $this->input->post('code');
		$period = $this->bsc_m_model->get_period_row($code);
		$data['code']    = $code;
		$data['begin']   = $period->begin;
		$data['end']     = $period->end;
		$data['process'] = 'admin/period/edit_process';
		$this->load->view('admin/setting/period/form', $data, FALSE);
	}

	public function edit_process()
	{
		$code  = $this->input->post('hdn_code');
		$begin = $this->input->post('dt_begin');
		$end   = $this->input->post('dt_end');
		$this->bsc_m_model->edit_period($code,$begin,$end);
	}

	public function remove()
	{
		$code  = $this->input->post('code');
		$period = $this->bsc_m_model->get_period_row($code);
		$data['code']    = $code;
		$data['begin']   = $period->begin;
		$data['end']     = $period->end;
		$data['process'] = 'admin/period/remove_process';
		$this->load->view('admin/setting/period/remove_form', $data, FALSE);

	}

	public function remove_process()
	{
		$code = $this->input->post('hdn_code');
		$this->bsc_m_model->remove_period($code);
	}

}

/* End of file period.php */
/* Location: ./application/controllers/admin/period.php */