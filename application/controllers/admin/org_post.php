<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Org_post extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('om_model');
	}

	public function index()
	{
		$data['page_title']  = 'Organization';
		$data['filter_date'] = date('Y').'/01/01 - '.date('Y').'/12/31';
		$this->load->view('admin/org/main_view',$data);
	}

	public function show_root()
	{
		$date_range = $this->input->post('date_range');
		$parent     = 0;

		list($begin,$end) = explode(' - ', $date_range);

		$begin = str_replace('/', '-', $begin);
		$end   = str_replace('/', '-', $end);

		$org_row = $this->om_model->get_org_row(1,$begin,$end);

		$data['org_row'] = $org_row;
		echo $this->load->view('admin/org/list_view', $data, TRUE);

	}

	public function show_child()
	{
		$date_range = $this->input->post('date_range');
		$parent     = $this->input->post('parent');
		list($begin,$end) = explode(' - ', $date_range);

		$begin = str_replace('/', '-', $begin);
		$end   = str_replace('/', '-', $end);

		$org_ls  = $this->om_model->get_org_list($parent,$begin,$end);
		// $post_ls = $this->om_model->get_post_list($parent,$begin,$end);
		if (count($org_ls)) {
			foreach ($org_ls as $org_row) {
				$data['org_row'] = $org_row;
				echo $this->load->view('admin/org/list_view', $data, TRUE);
			}
		}
	}



}

/* End of file org.php */
/* Location: ./application/controllers/admin/org_post.php */