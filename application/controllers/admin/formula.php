<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Formula extends CI_Controller {
	function __construct()
	{
		parent::__construct();
		$this->load->model('bsc_m_model');
	}

	public function index()
	{
		$data['page_title']  = lang('menu_formula');
		$data['link_add']    = 'admin/formula/add/';
		$this->load->view('admin/setting/formula/main_view',$data);
	}

	public function show_formula()
	{
		$formula_ls = $this->bsc_m_model->get_formula_list('2008-01-01','9999-12-31'); 
		$data['link_edit']   = 'admin/formula/edit/';
		$data['link_remove'] = 'admin/formula/remove/';
		$data['link_add']    = 'admin/formula/add_score/';
		$data['type_ls'] = array(
			0 => 'None',
			1 => 'Maximize',
			2 => 'Minimize',
			3 => 'Stablize'); 
		foreach ($formula_ls as $row) {
			$data['row'] = $row;
			echo $this->load->view('admin/setting/formula/formula_list', $data, TRUE);
		}

	}

	public function show_score()
	{
		$formula_id = $this->input->post('formula_id');
		$score_ls = $this->bsc_m_model->get_formula_score_list($formula_id);

		$data['link_edit']   = 'admin/formula/edit_score/';
		$data['link_remove'] = 'admin/formula/remove_score/';

		foreach ($score_ls as $row) {
			$data['row'] = $row;
			echo $this->load->view('admin/setting/formula/score_list', $data, TRUE);
		}
	}

	public function add()
	{
		$data['process'] = 'admin/formula/add_process';
		$data['id']    = 0;
		$data['name']  = '';
		$data['desc']  = '';
		$data['type']  = 0;
		$data['begin'] = '2008-01-01';
		$data['end']   = '9999-12-31';
		$this->load->view('admin/setting/formula/form', $data, FALSE);
	}

	public function add_process()
	{
		$this->form_validation->set_rules('txt_name', lang('basic_name'), 'trim|required|min_length[4]|max_length[125]|xss_clean');
		$this->form_validation->set_rules('dt_begin', lang('basic_begin'), 'trim|required|xss_clean');
		$this->form_validation->set_rules('dt_end', lang('basic_end'), 'trim|required|xss_clean');
		if ($this->form_validation->run()) {
			$name  = $this->input->post('txt_name');
			$desc  = $this->input->post('txt_desc');
			$type  = $this->input->post('slc_type');
			$begin = $this->input->post('dt_begin');
			$end   = $this->input->post('dt_end');
			$this->bsc_m_model->add_formula($name,$desc,$type,$begin,$end);
			$this->load->view('_notif/success');

		} else {
			$data['e'] = validation_errors();

			$this->load->view('_notif/error', $data);
		}

	}

	public function edit()
	{
		$id  = $this->input->post('code');
		$formula = $this->bsc_m_model->get_formula_row($id);
		$data['id']    = $id;
		$data['name']  = $formula->name;
		$data['desc']  = $formula->description;
		$data['type']  = $formula->type;
		$data['begin'] = $formula->begin;
		$data['end']   = $formula->end;
		$data['process'] = 'admin/formula/edit_process';
		$this->load->view('admin/setting/formula/form', $data, FALSE);
	}

	public function edit_process()
	{
		$this->form_validation->set_rules('txt_name', lang('basic_name'), 'trim|required|min_length[4]|max_length[125]|xss_clean');
		$this->form_validation->set_rules('dt_begin', lang('basic_begin'), 'trim|required|xss_clean');
		$this->form_validation->set_rules('dt_end', lang('basic_end'), 'trim|required|xss_clean');
		if ($this->form_validation->run()) {
			$id    = $this->input->post('hdn_id');
			$name  = $this->input->post('txt_name');
			$desc  = $this->input->post('txt_desc');
			$type  = $this->input->post('slc_type');
			$begin = $this->input->post('dt_begin');
			$end   = $this->input->post('dt_end');
			$this->bsc_m_model->edit_formula($id,$name,$desc,$type,$begin,$end);
			$this->load->view('_notif/success');

		} else {
			$data['e'] = validation_errors();

			$this->load->view('_notif/error', $data);
		}

	}

	public function remove()
	{
		$code  = $this->input->post('code');
		$formula = $this->bsc_m_model->get_formula_row($code);
		$data['code']    = $code;
		$data['begin']   = $formula->begin;
		$data['end']     = $formula->end;
		$data['process'] = 'admin/formula/remove_process';
		$this->load->view('_template/remove_form', $data);

	}

	public function remove_process()
	{
		$code = $this->input->post('hdn_code');
		$pass = $this->input->post('txt_code');
		if (strtoupper($pass)=='DELETE' ) {
			$this->bsc_m_model->remove_formula($code);
			$this->load->view('_notif/success');
			
		} else {
			$data['e'] = 'Please type DELETE to confirm action';
			$this->load->view('_notif/error', $data);
		}
	}

	public function add_score()
	{
		$data['process'] = 'admin/formula/add_score_process';

		$this->load->view('admin/setting/formula/score_form', $data, FALSE);
	}

	public function add_score_process()
	{
		$this->form_validation->set_rules('txt_name', lang('basic_name'), 'trim|required|min_length[4]|max_length[6]|xss_clean');
		$this->form_validation->set_rules('dt_begin', lang('basic_begin'), 'trim|required|xss_clean');
		$this->form_validation->set_rules('dt_end', lang('basic_end'), 'trim|required|xss_clean');
		if ($this->form_validation->run_score()) {

			$this->bsc_m_model->add_formula_score();
			$this->load->view('_notif/success');

		} else {
			$data['e'] = validation_errors_score();

			$this->load->view('_notif/error', $data);
		}

	}

	public function edit_score()
	{
		$id  = $this->input->post('code');
		$formula = $this->bsc_m_model->get_formula_row($id);
		$data['id']    = $id;
		$data['name']  = $formula->name;
		$data['desc']  = $formula->description;
		$data['type']  = $formula->type;
		$data['begin'] = $formula->begin;
		$data['end']   = $formula->end;
		$data['process'] = 'admin/formula/edit_score_process';
		$this->load->view('admin/setting/formula/score_form', $data, FALSE);
	}

	public function edit_score_process()
	{
		$this->form_validation->set_rules('txt_name', lang('basic_name'), 'trim|required|min_length[4]|max_length[6]|xss_clean');
		$this->form_validation->set_rules('dt_begin', lang('basic_begin'), 'trim|required|xss_clean');
		$this->form_validation->set_rules('dt_end', lang('basic_end'), 'trim|required|xss_clean');
		if ($this->form_validation->run_score()) {
			$id    = $this->input->post('hdn_id');

			$this->bsc_m_model->edit_formula_score($id);
			$this->load->view('_notif/success');

		} else {
			$data['e'] = validation_errors_score();

			$this->load->view('_notif/error', $data);
		}

	}

	public function remove_score()
	{
		$code  = $this->input->post('code');
		$formula = $this->bsc_m_model->get_formula_row($code);
		$data['code']    = $code;
		$data['begin']   = $formula->begin;
		$data['end']     = $formula->end;
		$data['process'] = 'admin/formula/remove_score_process';
		$this->load->view('_template/remove_form', $data);

	}

	public function remove_score_process()
	{
		$code = $this->input->post('hdn_code');
		$pass = $this->input->post('txt_code');
		if (strtoupper($pass)=='DELETE' ) {
			$this->bsc_m_model->remove_formula_score($code);
			$this->load->view('_notif/success');
			
		} else {
			$data['e'] = 'Please type DELETE to confirm action';
			$this->load->view('_notif/error', $data);
		}
	}

}

/* End of file formula.php */
/* Location: ./application/controllers/admin/formula.php */