<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Score extends CI_Controller {
	function __construct()
	{
		parent::__construct();
		$this->load->model('bsc_m_model');
	}

	public function index()
	{
		$data['page_title']  = lang('menu_score');
		$data['score_ls'] = $this->bsc_m_model->get_score_list(); 
		$this->load->view('admin/setting/score/main_view',$data);
	}

}

/* End of file score.php */
/* Location: ./application/controllers/admin/score.php */