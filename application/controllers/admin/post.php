<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Post extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('om_model');
	}

	public function index()
	{
		redirect('admin/post_struc');
	}

	public function detail($post_id=0)
	{
		$date_range = $this->session->userdata('timeframe');
		$data['link_edit_post'] = 'admin/post/edit_attr/';
		$data['page_title']    = lang('om_post');
		$data['filter_date']   = $date_range;
		$data['post_id']       = $post_id;

		$this->load->view('admin/post/main_view',$data);
	}

	public function show_last()
	{
		$post_id     = $this->input->post('post_id');
		$date_range = $this->input->post('date_range');
		$this->session->set_userdata('timeframe',$date_range);
		list($begin,$end) = explode(' - ', $date_range);
		$data['post'] = $this->om_model->get_post_row($post_id,$begin,$end);
		echo $this->load->view('admin/post/detail_view', $data, TRUE);
	}

	public function show_attr()
	{
		$post_id     = $this->input->post('post_id');
		$date_range = $this->input->post('date_range');
		list($begin,$end) = explode(' - ', $date_range);
		
		$data['attr_ls'] = $this->om_model->get_obj_attr_list($post_id,$begin,$end);
		echo $this->load->view('admin/org/attribute_list', $data, TRUE);
		
	}

	public function show_rel()
	{
		$post_id     = $this->input->post('post_id');
		$date_range = $this->input->post('date_range');
		list($begin,$end) = explode(' - ', $date_range);
		$data['add_rel'] = 'admin/post/add_rel';
		$data['rel_ls']  = $this->om_model->get_obj_rel_list($post_id,'all','',$begin,$end);
		echo $this->load->view('admin/org/relation_list', $data, TRUE);
	}

	public function add()
	{
		$parent_id  = $this->input->post('parent');
		$date_range = $this->input->post('date_range');
		list($begin,$end) = explode(' - ', $date_range);
		$begin     = str_replace('/', '-', $begin);
		$end       = str_replace('/', '-', $end);

		$type = $this->om_model->get_obj_row($parent_id)->obj_type;

		switch ($type) {
			case 'O':
				$parent = $this->om_model->get_org_row($parent_id,$begin,$end);
				$data['header'] = 'admin/org/parent_header';
				$data['parent'] = $parent;
				break;
			case 'S':
				$chief = $this->om_model->get_post_row($parent_id,$begin,$end);
				$data['header'] = 'admin/post/chief_header';
				$data['chief']  = $chief;
				
				break;
			
		}
		
		$post_code  = '';
		$post_name  = '';
		$post_begin = $begin;
		$post_end   = '9999-12-31';

		$data['process']    = 'admin/post/add_process';
		$data['post_code']  = $post_code;
		$data['post_name']  = $post_name;
		$data['post_begin'] = $post_begin;
		$data['post_end']   = $post_end;
		$data['parent_id']  = $parent_id;
		$data['process']    = 'admin/post/add_process';

		$this->load->view('admin/post/add_form', $data, FALSE);
	}

	public function add_process()
	{
		$this->form_validation->set_rules('txt_code', lang('om_post_code'), 'trim|required|min_length[3]|max_length[255]|xss_clean');
		$this->form_validation->set_rules('txt_name', lang('om_post_name'), 'trim|required|min_length[5]|max_length[255]|xss_clean');
		$this->form_validation->set_rules('dt_begin', 'Begin Date', 'trim|required|xss_clean');
		$this->form_validation->set_rules('dt_end', 'End Date', 'trim|required|xss_clean');
		if ($this->form_validation->run()) {
			$parent_id = $this->input->post('parent_id');
			$code 		 = $this->input->post('txt_code');
			$name 		 = $this->input->post('txt_name');
			$is_chief  = $this->input->post('slc_chief');
			$begin 		 = $this->input->post('dt_begin');
			$end  		 = $this->input->post('dt_end');
			$this->om_model->add_post($parent_id,$code,$name,$is_chief,$begin,$end);
			$this->load->view('_notif/success');

		} else {
			$data['e'] = validation_errors();

			$this->load->view('_notif/error', $data);

		}
	}

	public function add_rel()
	{
		$post_id = $this->input->post('post_id');
		$date_range = $this->input->post('date_range');
		list($begin,$end) = explode(' - ', $date_range);
		$begin     = str_replace('/', '-', $begin);
		$end       = str_replace('/', '-', $end);
		$data['process'] = 'admin/post/add_rel_process';
		$data['post_id']  = $post_id;
		$data['begin']   = $begin;
		$data['end']     = $end;
		$data['rel_obj'] = '';
		$this->load->view('admin/post/relation_add_form', $data, FALSE);
	}

	public function add_rel_process()
	{
		$this->form_validation->set_rules('slc_type', 'Type', 'trim|required|xss_clean');
		$this->form_validation->set_rules('txt_obj', 'rel obj', 'trim|integer|greater_than[0]|required||xss_clean');
		$this->form_validation->set_rules('dt_begin', 'Begin Date', 'trim|required|xss_clean');
		$this->form_validation->set_rules('dt_end', 'End Date', 'trim|required|xss_clean');

		if ($this->form_validation->run()) {
			$post_id   = $this->input->post('post_id');
			$type_dir = $this->input->post('slc_type');
			$rel_obj  = $this->input->post('txt_obj');
			$begin    = $this->input->post('dt_begin');
			$end      = $this->input->post('dt_end');
			$type     = substr($type_dir, 0,3);
			$dir      = substr($type_dir, 3,1);

			switch ($dir) {
				case 'A':
					$obj_from = $rel_obj;
					$obj_to 	= $post_id;
					break;
				case 'B':
					$obj_from = $post_id;
					$obj_to 	= $rel_obj;
					break;
			}

			$obj_type = $this->om_model->get_obj_row($rel_obj)->obj_type;

			switch ($type) {
				case '002':
					if ($obj_type == 'O') {
						$flag = TRUE;
					} else {
						$flag = FALSE;
					}
					break;
				
				case '003':
				case '012':
					if ($obj_type == 'S') {
						$flag = TRUE;
					} else {
						$flag = FALSE;
					}
					break;
			}

			if ($flag) {
				$this->om_model->add_obj_rel($type,$obj_from,$obj_to,$begin,$end);
				$this->load->view('_notif/success');
			} else {
				$data['e'] = 'Object not Valid';
				$this->load->view('_notif/error', $data);
			}

		} else {
			$data['e'] = validation_errors();
			$this->load->view('_notif/error', $data);
		}

	}

	public function edit_attr()
	{
		$post_id    = $this->input->post('obj_id');
		$date_range = $this->input->post('date_range');
		list($begin,$end) = explode(' - ', $date_range);
		$begin  = str_replace('/', '-', $begin);
		$end    = str_replace('/', '-', $end);
		$post   = $this->om_model->get_post_row($post_id,$begin,$end);

		$parent = $this->om_model->get_org_post_row($post_id,$begin,$end);

		if (count($parent)) {
			$data['parent']     = $parent;
		}
		$data['post_id']    = $post_id;
		$data['post_code']  = $post->post_code;
		$data['post_name']  = $post->post_name;
		$data['attr_begin'] = $post->attr_begin;
		$data['attr_end']   = $post->attr_end;
		$data['post_begin'] = $post->post_begin;
		$data['post_end']   = $post->post_end;
		$data['process']    = 'admin/post/edit_attr_process';

		$this->load->view('admin/post/attribute_form', $data, FALSE);
	}

	public function edit_attr_process()
	{
		$post_id     = $this->input->post('post_id');
		$code       = $this->input->post('txt_code');
		$name       = $this->input->post('txt_name');
		$attr_begin = $this->input->post('dt_begin');
		$attr_end   = $this->input->post('dt_end');
		$mode       = $this->input->post('slc_mode');

		$this->form_validation->set_rules('txt_code', lang('om_post_code'), 'trim|required|min_length[3]|max_length[255]|xss_clean');
		$this->form_validation->set_rules('txt_name', lang('om_post_name'), 'trim|required|min_length[5]|max_length[255]|xss_clean');
		$this->form_validation->set_rules('dt_begin', 'Begin Date', 'trim|required|xss_clean');
		$this->form_validation->set_rules('dt_end', 'End Date', 'trim|required|xss_clean');
		$this->form_validation->set_rules('slc_mode', 'Mode', 'trim|required|xss_clean');

		if ($this->form_validation->run()) {
			switch ($mode) {
				case 'update':
					$this->om_model->update_post($post_id,$code,$name,$attr_begin,$attr_end);
					break;
				case 'corect':
					$this->om_model->correct_post($post_id,$code,$name,$attr_begin,$attr_end);
					break;
			}
			$this->load->view('_notif/success');

			
		} else {
			$data['e'] = validation_errors();
			$this->load->view('_notif/error', $data);
		}

	}

	public function delete()
	{
		$post_id     = $this->input->post('obj_id');
		$date_range = $this->input->post('date_range');
		list($begin,$end) = explode(' - ', $date_range);
		$begin = str_replace('/', '-', $begin);
		$end   = str_replace('/', '-', $end);
		$post   = $this->om_model->get_post_row($post_id,$begin,$end);
		$data['header_view'] = 'admin/post/post_header';
		$data['process']     = 'admin/post/delete_process';
		$data['post_id']      = $post_id;
		$data['post']         = $post;
		$data['end']         = $post->post_end;
		$this->load->view('admin/post/delete_form', $data, FALSE);
	}

	public function delete_process()
	{
		$post_id = $this->input->post('post_id');
		$end     = $this->input->post('dt_end');
		$mode    = $this->input->post('slc_mode');

		switch ($mode) {
			case 'delimit':
				$this->form_validation->set_rules('dt_end', lang('basic_end'), 'trim|required|xss_clean');
				if ($this->form_validation->run()) {
					// DO delimit post
					$this->om_model->delimit_post($post_id,$end);
					$this->load->view('_notif/success'); 
				} else {
					// DO Notif Error
					$data['e'] = validation_errors();
					$this->load->view('_notif/error', $data);
				}
				
				break;
			case 'remove':
				// DO remove post
				$this->om_model->remove_post($post_id);
				
				$this->load->view('_notif/success');
				break;
		}
	}

	public function delete_rel()
	{
		$rel_id     = $this->input->post('rel_id');
		$post_id     = $this->input->post('post_id');
		$date_range = $this->input->post('date_range');
		list($begin,$end) = explode(' - ', $date_range);

		$begin = str_replace('/', '-', $begin);
		$end   = str_replace('/', '-', $end);
		$rel   = $this->om_model->get_obj_rel_row($rel_id);
		
		$data['header_view'] = 'admin/post/relation_header';
		$data['process']     = 'admin/post/delete_rel_process';
		$data['rel_id']      = $rel_id;
		$data['rel']         = $rel;
		$data['end']         = $rel->end;
		echo $this->load->view('admin/post/relation_delete_form', $data, TRUE);
	}

	public function delete_rel_process()
	{
		$rel_id =  $this->input->post('rel_id');
		$end  = $this->input->post('dt_end');
		$mode = $this->input->post('slc_mode');

		switch ($mode) {
			case 'delimit':
				$this->form_validation->set_rules('dt_end', lang('basic_end'), 'trim|required|xss_clean');
				if ($this->form_validation->run()) {
					// DO delimit relation
					$this->om_model->delimit_obj_rel($post_id,$end);
					$this->load->view('_notif/success'); 
				} else {
					// DO Notif Error
					$data['e'] = validation_errors();
					$this->load->view('_notif/error', $data);
				}
				
				break;
			case 'remove':
				// DO remove relation
				$this->om_model->remove_obj_rel($post_id);
				
				$this->load->view('_notif/success');
				break;
		}
	}

}

/* End of file post.php */
/* Location: ./application/controllers/admin/post.php */