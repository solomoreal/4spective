<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ref extends CI_Controller {
	function __construct()
	{
		parent::__construct();
		$this->load->model('sc_m_model');
	}

	public function index()
	{
		$data['page_title']  = lang('menu_ref');
		$data['ref_ls'] = $this->sc_m_model->get_ref_list('2008-01-01','9999-12-31'); 
		$this->load->view('admin/setting/ref/main_view',$data);
	}

}

/* End of file ref.php */
/* Location: ./application/controllers/admin/ref.php */