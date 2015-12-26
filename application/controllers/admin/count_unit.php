<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Count_unit extends CI_Controller {
	function __construct()
	{
		parent::__construct();
		$this->load->model('sc_m_model');
	}

	public function index()
	{
		$data['page_title']  = lang('menu_count_unit');
		$data['link_add']    = 'admin/count_unit/add/';
		$data['link_edit']   = 'admin/count_unit/edit/';
		$data['link_remove'] = 'admin/count_unit/remove/';
		$data['count_unit_ls'] = $this->sc_m_model->get_measure_list(); 
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
		$this->form_validation->set_rules('txt_short', lang('basic_code'), 'trim|required|min_length[1]|max_length[20]|xss_clean');
		$this->form_validation->set_rules('txt_long', lang('basic_name'), 'trim|required|min_length[3]|max_length[125]|xss_clean');
		
		if ($this->form_validation->run()) {
			$short   = $this->input->post('txt_short');
			$long    = $this->input->post('txt_long');
			$desc    = $this->input->post('txt_desc');
			$has_min = $this->input->post('chk_min');
			$has_max = $this->input->post('chk_max');
			$is_real = $this->input->post('chk_real');

			if ($has_min) {
				$min_val = $this->input->post('nm_min');
			} else {
				$min_val = NULL;
			}

			if ($has_max) {
				$max_val = $this->input->post('nm_max');
			} else {
				$max_val = NULL;
			}

			if ($min_val>$max_val && $has_min && $has_max) {
				$temp    = $min_val;
				$min_val = $max_val;
				$max_val = $temp;
			}
			
			$this->sc_m_model->add_measure($short,$long,$desc,$is_real,$has_min,$min_val,$has_max,$max_val);
			echo $this->load->view('_notif/success');

		} else {
			$data['e'] = validation_errors();

			echo $this->load->view('_notif/error', $data,TRUE);
		}

	}

	public function edit()
	{
		$id  = $this->input->post('code');
		$old = $this->sc_m_model->get_measure_row($id);
		$data['hidden']  = array('hdn_id'=>$id);
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
		$this->form_validation->set_rules('txt_short', lang('basic_code'), 'trim|required|min_length[1]|max_length[20]|xss_clean');
		$this->form_validation->set_rules('txt_long', lang('basic_name'), 'trim|required|min_length[3]|max_length[125]|xss_clean');
		if ($this->form_validation->run()) {
			$id      = $this->input->post('hdn_id');
			$short   = $this->input->post('txt_short');
			$long    = $this->input->post('txt_long');
			$desc    = $this->input->post('txt_desc');
			$has_min = $this->input->post('chk_min');
			$has_max = $this->input->post('chk_max');
			$is_real = $this->input->post('chk_real');

			if ($has_min) {
				$min_val = $this->input->post('nm_min');
			} else {
				$min_val = NULL;
			}

			if ($has_max) {
				$max_val = $this->input->post('nm_max');
			} else {
				$max_val = NULL;
			}

			if ($min_val>$max_val && $has_min && $has_max) {
				$temp    = $min_val;
				$min_val = $max_val;
				$max_val = $temp;
			}
			$this->sc_m_model->edit_measure($id,$short,$long,$desc,$is_real,$has_min,$min_val,$has_max,$max_val);
			echo $this->load->view('_notif/success');

		} else {
			$data['e'] = validation_errors();

			echo $this->load->view('_notif/error', $data);
		}

	}

	public function remove()
	{
		$code  = $this->input->post('code');
		$count_unit = $this->sc_m_model->get_measure_row($code);
		$data['code']    = $code;
		$data['process'] = 'admin/count_unit/remove_process';
		$this->load->view('_template/remove_form', $data);

	}

	public function remove_process()
	{
		$code = $this->input->post('hdn_code');
		$pass = $this->input->post('txt_code');
		if (strtoupper($pass)=='DELETE' ) {
			$this->sc_m_model->remove_measure($code);
			$this->load->view('_notif/success');
			
		} else {
			$data['e'] = 'Please type DELETE to confirm action';
			$this->load->view('_notif/error', $data);
		}
	}

}

/* End of file count_unit.php */
/* Location: ./application/controllers/admin/count_unit.php */