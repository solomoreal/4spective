<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ytd extends CI_Controller {
	function __construct()
	{
		parent::__construct();
		$this->load->model('sc_m_model');
	}

	public function index()
	{
		$data['page_title']  = lang('menu_ytd');
		$data['ytd_ls'] = $this->sc_m_model->get_ytd_list('2008-01-01','9999-12-31'); 
		$this->load->view('admin/setting/ytd/main_view',$data);
	}

}

/* End of file ytd.php */
/* Location: ./application/controllers/admin/ytd.php */