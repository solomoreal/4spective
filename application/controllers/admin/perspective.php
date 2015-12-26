<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Perspective extends CI_Controller {
	function __construct()
	{
		parent::__construct();
		$this->load->model('sc_m_model');
	}

	public function index()
	{
		$data['page_title']  = lang('menu_perspective');
		// $data['link_add']    = 'admin/perspective/add/';
		// $data['link_edit']   = 'admin/perspective/edit/';
		// $data['link_remove'] = 'admin/perspective/remove/';
		$data['perspective_ls'] = $this->sc_m_model->get_perspective_list('2008-01-01','9999-12-31'); 
		$this->load->view('admin/setting/perspective/main_view',$data);
	}

	// public function add()
	// {
	// 	$data['process'] = 'admin/perspective/add_process';
	// 	$data['code']    = '';
	// 	$data['name']    = '';
	// 	$this->load->view('admin/setting/perspective/form', $data, FALSE);
	// }

	// public function add_process()
	// {
	// 	$this->form_validation->set_rules('txt_code', lang('basic_code'), 'trim|required|min_length[4]|max_length[6]|xss_clean');
	// 	$this->form_validation->set_rules('txt_name', lang('basic_name'), 'trim|required|xss_clean');
	// 	if ($this->form_validation->run()) {
	// 		$code = $this->input->post('txt_code');
	// 		$name = $this->input->post('txt_name');

	// 		$this->sc_m_model->add_perspective($code,$name);
	// 		$this->load->view('_notif/success');

	// 	} else {
	// 		$data['e'] = validation_errors();

	// 		$this->load->view('_notif/error', $data);
	// 	}

	// }

	// public function edit()
	// {
	// 	$code  = $this->input->post('code');
	// 	$perspective = $this->sc_m_model->get_perspective_row($code);
	// 	$data['code']    = $code;
	// 	$data['name']    = $perspective->description;
	// 	$data['process'] = 'admin/perspective/edit_process';
	// 	$this->load->view('admin/setting/perspective/form', $data, FALSE);
	// }

	// public function edit_process()
	// {
	// 	$this->form_validation->set_rules('txt_name', lang('basic_name'), 'trim|required|xss_clean');
	// 	if ($this->form_validation->run()) {
	// 		$code  = $this->input->post('hdn_code');
	// 		$name = $this->input->post('txt_name');
	// 		$this->sc_m_model->edit_perspective($code,$name);
	// 		$this->load->view('_notif/success');

	// 	} else {
	// 		$data['e'] = validation_errors();

	// 		$this->load->view('_notif/error', $data);
	// 	}

	// }

	// public function remove()
	// {
	// 	$code  = $this->input->post('code');
	// 	$perspective = $this->sc_m_model->get_perspective_row($code);
	// 	$data['code']    = $code;

	// 	$data['process'] = 'admin/perspective/remove_process';
	// 	$this->load->view('_template/remove_form', $data);

	// }

	// public function remove_process()
	// {
	// 	$code = $this->input->post('hdn_code');
	// 	$pass = $this->input->post('txt_code');
	// 	if (strtoupper($pass)=='DELETE' ) {
	// 		$this->sc_m_model->remove_perspective($code);
	// 		$this->load->view('_notif/success');
			
	// 	} else {
	// 		$data['e'] = 'Please type DELETE to confirm action';
	// 		$this->load->view('_notif/error', $data);
	// 	}
	// }

}

/* End of file perspective.php */
/* Location: ./application/controllers/admin/perspective.php */