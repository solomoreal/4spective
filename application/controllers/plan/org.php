<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Org extends CI_Controller {
  
  public function __construct()
  {
    parent::__construct();
    $this->load->model('om_model');
    $this->load->model('sc_org_model');
    $this->load->model('sc_m_model');
  }

  public function index()
  {
    $period_ls = $this->sc_m_model->get_period_list('2000-01-01','9999-12-31');
    foreach ($period_ls as $row) {
      $period_opt[$row->period_code] = $row->period_code;
    }
    $data['period_opt'] = $period_opt;
    $data['period_def'] = date('Y');
    $data['page_title'] = 'Organization Plan';
    $data['page_subtitle'] = 'List';
    $this->load->view('plan/org/main_view',$data);
  }

  public function sc_list()
  {
    $code   = $this->input->post('period');
    $period = $this->sc_m_model->get_period_row($code);
    $begin  = $period->begin;
    $end    = $period->end;
    $data['period'] = $code;
    $org_ls = $this->om_model->get_org_chief_ls($this->session->userdata('username'),$begin,$end);
    // TODO cari begin dan end periode yang aktif
    foreach ($org_ls as $org) {
      $data['org_name'] = $org->org_name;
      $data['org_id']   = $org->org_id;

      $data['status'] = '';
      if ($this->sc_org_model->check_sc($org->org_id,$begin,$end)) {
        // ada Score Card
        // TODO Cari score card dan tampilkan datanya
        
        $sc = $this->sc_org_model->get_sc_row($org->org_id,$begin,$end);
        switch ($sc->status) {
          case 'draft':
            $data['status'] = '<span class="label label-default">Draft</span>';
            $view = 'plan/org/sc_list_edit';

            break;
          case 'rev':
            $data['status'] = '<span class="label label-info">Revision</span>';
            $view = 'plan/org/sc_list_edit';

            break;
          case 'rj';
            $data['status'] = '<span class="label label-danger">Reject</span>';
            $view = 'plan/org/sc_list_edit';

            break;
          case 'pend':
            $data['status'] = '<span class="label label-warning">Pending</span>';
            $view = 'plan/org/sc_list';
            
            break;
          case 'ok';
            $data['status'] = '<span class="label label-success">OK</span>';
            $view = 'plan/org/sc_list_done';

            break;
        }
        $data['sc_id']  = $sc->sc_id;
        

      } else {
        // tidak ada Score Card
        // TODO tampilkan data organisasi
        $data['status'] = '<span class="label label-default">N/A</span>';
        $data['sc_id']  = '';
        $view = 'plan/org/sc_list_blank';
      }
      echo $this->load->view($view, $data, TRUE);
    }
  }


  public function source_past()
  { 
    $period = $this->input->post('period');
    $org_id = $this->input->post('org_id');
    $year   = $period - 1;
    $endda  = $year.'-12-31';      
    $ls = $this->sc_org_model->get_sc_ls($org_id,'2000-01-01',$endda,'ok');

    $result = array();
    foreach ($ls as $row) {
      $result[] = array('value' => $row->sc_id,'text'=> $row->period);
    }

    echo json_encode($result);
  }

  public function source_other()
  {
    $period = $this->input->post('period');
    $org_id = $this->input->post('org_id');
    $begda  = $period .'-01-01';
    $endda  = $period .'-12-31';
    $ls = $this->sc_org_model->get_pair_sc_ls($org_id,$begda,$endda,'ok');

    $result = array();
    if ($ls) {
      foreach ($ls as $row) {
        $result[] = array('value' => $row->sc_id,'text'=> $row->org_name);
      }
    }

    echo json_encode($result);
  }
  
  public function copy_sc_process()
  {
    $from   = $this->input->post('slc_from');
    $source = $this->input->post('slc_source');
    $period = $this->input->post('hdn_period');
    $org_id = $this->input->post('hdn_org');
  }

  /**
   * [membuat Score Card yang benar benar baru]
   * @param  [type] $code   [description]
   * @param  [type] $org_id [description]
   * @return [type]         [description]
   */
  public function new_sc_process($code,$org_id)
  {
    $period = $this->sc_m_model->get_period_row($code);

    if($this->sc_org_model->check_sc($org_id,$period->begin,$period->end)){
      $sc = $this->sc_org_model->get_sc_row($row->org_id,$period->begin,$period->end);
      switch ($sc->status) {
        case 'draf':
        case 'rev':
        case 'rj';
          redirect('plan/org/edit_sc/'.$sc->sc_id);

          break;
        case 'pend':
        case 'ok';
          redirect('plan/org');

          break;
      }
    } else {
      $sc_id = $this->sc_org_model->add_sc($org_id,$code);
      redirect('plan/org/edit_sc/'.$sc_id);
    }

  }

  public function send_sc($sc_id=0)
  {
    $this->sc_org_model->edit_sc_status($sc_id,'pend');
  }

  public function approve_sc($sc_id=0)
  {
    $this->sc_org_model->edit_sc_status($sc_id,'ok');
  }

  public function reject_sc($sc_id=0)
  {
    $this->sc_org_model->edit_sc_status($sc_id,'rj');
  }

  public function rev_sc($sc_id=0)
  {
    $this->sc_org_model->edit_sc_status($sc_id,'rev');
  }

  public function edit_sc($sc_id=0)
  {
    $sc = $this->sc_org_model->get_sc_row($sc_id);
    switch ($sc->status) {
      case 'ok':
      case 'pend':
        redirect('plan/org');
        break;
      
    }
    $data['page_title']    = 'Organization Plan';
    $data['page_subtitle'] = 'Edit';
    $data['add_so']        = 'plan/org/add_so/'.$sc_id.'/';
    $data['send_sc']       = 'plan/org/send_sc/'.$sc_id.'/';
    $data['persp_ls']      = $this->sc_m_model->get_perspective_list();
    $data['ytd_ls']        = $this->sc_m_model->get_ytd_list();
    $data['measure_ls']    = $this->sc_m_model->get_measure_list();
    $data['formula_ls']    = $this->sc_m_model->get_formula_list();
    $data['sc']            = $sc;
    $data['sc_id']         = $sc->sc_id;
    $period                = $this->sc_m_model->get_period_row($sc->period);
    $data['period']        = $sc->period;
    // $data['sc_begin'] = date('d M Y', strtotime($sc->begin));
    // $data['sc_end']   = date('d M Y', strtotime($sc->end));
    $data['org_name'] = $this->om_model->get_org_row($sc->sc_id,$period->begin,$period->end)->org_name;
    switch ($sc->status) {
      case 'draft':
        $data['status'] = '<span class="label label-default">Draft</span>';
        break;
      case 'rev':
        $data['status'] = '<span class="label label-info">Revision</span>';
        break;
      case 'rj';
        $data['status'] = '<span class="label label-danger">Reject</span>';
        break;
      case 'pend':
        $data['status'] = '<span class="label label-warning">Pending</span>';
      
        break;
      case 'ok';
        $data['status'] = '<span class="label label-success">OK</span>';
        break;
    }
    $this->load->view('plan/org/sc_edit', $data, FALSE);
  }

  public function sc_weight()
  {
    $sc_id = $this->input->post('sc_id');
    $respond['weight'] = $this->sc_org_model->sum_kpi_weight($sc_id);
    echo json_encode($respond);

  }

  //////////////////////////////
  // SO / Strategic Objective //
  //////////////////////////////

  public function so_opt()
  {
    $sc_id = $this->input->post('sc_id');
    $persp = $this->input->post('persp');
    $so_ls = $this->sc_org_model->get_so_pers_ls($sc_id,$persp);

    $respond = '<option value=""></option>';
    foreach ($so_ls as $row) {
      $respond .= '<option value="'.$row->so_id.'"">'.$row->short_text . ' ' .$row->long_text.'</option>';
    }

    echo $respond;

  }
  public function so_list()
  {
    $sc_id = $this->input->post('sc_id');

    $sc = $this->sc_org_model->get_sc_row($sc_id);
    switch ($sc->status) {
      case 'draft':
      case 'rj':
      case 'pend':
        $view = 'plan/org/so_list_edit';
        break;
      
      default:
        $view = 'plan/org/so_list';
        break;
    }
    $so_ls = $this->sc_org_model->get_so_ls($sc_id);
    foreach ($so_ls as $so) {
      $data['persp']      = $so->persp_name;
      $data['so_id']      = $so->so_id;
      $data['so_code']    = $so->short_text;
      $data['so_text']    = $so->long_text;
      $data['so_desc']    = $so->description;
      $data['kpi_num']    = $this->sc_org_model->count_kpi($sc_id,$so->so_id);
      $data['kpi_weight'] = $this->sc_org_model->sum_kpi_weight($sc_id,$so->so_id);
      // $data['add_kpi']    = 'plan/org/add_kpi';
      // $data['remove_so']  = 'plan/org/remove_so';

      echo $this->load->view($view, $data, TRUE);
    }

  }

  public function add_so()
  {
    $persp_code         = $this->input->post('persp_code');
    $sc_id              = $this->input->post('sc_id');
    $respond['process'] = 'plan/org/add_so_process';
    $respond['sc_id']   = $sc_id;
    $respond['name']    = '';
    $respond['code']    = '';
    $respond['persp']   = '';
    $respond['desc']    = '';
    echo json_encode($respond);
  }

  public function add_so_process()
  {
    $sc_id = $this->input->post('sc_id');
    $persp = $this->input->post('slc_persp');
    $code  = $this->input->post('txt_code');
    $name  = $this->input->post('txt_name');
    $desc  = $this->input->post('txt_desc');

    $this->sc_org_model->add_so($sc_id,$persp,$code,$name,$desc);
    // redirect('plan/org/edit_sc/'.$sc_id);
  }

  public function edit_so()
  {
    $so_id = $this->input->post('so_id');
    $old   = $this->sc_org_model->get_so_row($so_id);
    $respond['process'] = 'plan/org/edit_so_process';
    $respond['sc_id']   = $old->sc_id;
    $respond['name']    = $old->long_text;
    $respond['code']    = $old->short_text;
    $respond['persp']   = $old->persp_code;
    $respond['desc']    = $old->description;
    echo json_encode($respond);
  }

  public function edit_so_process()
  {
    $sc_id = $this->input->post('sc_id');
    $so_id = $this->input->post('so_id');
    $persp = $this->input->post('slc_persp');
    $code  = $this->input->post('txt_code');
    $name  = $this->input->post('txt_name');
    $desc  = $this->input->post('txt_desc');

    $this->sc_org_model->edit_so($so_id,$persp,$code,$name,$desc);

    // redirect('plan/org/edit_sc/'.$sc_id);
  } 

  public function remove_so()
  {
    $so_id = $this->input->post('so_id');
    $this->sc_org_model->remove_so($so_id);
  }

  ////////////////////////////////////
  // KPI / Key Performace Indicator //
  ////////////////////////////////////

  public function kpi_list()
  {
    $sc_id  = $this->input->post('sc_id');
    $kpi_ls = $this->sc_org_model->get_kpi_bysc_ls($sc_id);
    $sc = $this->sc_org_model->get_sc_row($sc_id);
    switch ($sc->status) {
      case 'draft':
      case 'rj':
      case 'pend':
        $view = 'plan/org/kpi_list_edit';
        break;
      
      default:
        $view = 'plan/org/kpi_list';
        break;
    }
    foreach ($kpi_ls as $kpi) {
      $data['kpi_id']   = $kpi->kpi_id;
      $data['so']       = $kpi->so_code . ' '. $kpi->so_name;
      $data['kpi_code'] = $kpi->short_text;
      $data['kpi_name'] = $kpi->long_text;
      $data['weight']   = $kpi->weight;
      $data['formula']  = $kpi->formula_name;
      $data['ytd']      = $kpi->ytd_name;

      echo $this->load->view($view, $data, TRUE);

    }

  }

  public function kpi_detail($kpi_id=0)
  {
    $kpi = $this->sc_org_model->get_kpi_row($kpi_id);
    for ($i=1; $i <= 12; $i++) { 
      if ($this->sc_org_model->count_target_kpimonth($kpi_id,$i)) {
        $target[$i] = $this->sc_org_model->get_target_kpimonth_row($kpi_id,$i);
      } else {
        $target[$i] = '-';
      }

    }
  }

  public function add_kpi()
  {
    $sc_id              = $this->input->post('sc_id');
    $respond['process'] = 'plan/org/add_kpi_process';
    $respond['sc_id']   = $sc_id;
    $respond['persp']   = '';
    $respond['so']      = '';
    $respond['code']    = '';
    $respond['name']    = '';
    $respond['desc']    = '';
    $respond['weight']  = 0;
    $respond['ytd']     = '';
    $respond['formula'] = '';
    $respond['measure'] = '';
    echo json_encode($respond);
    
  }

  public function add_kpi_process()
  {
    $sc_id    = $this->input->post('sc_id');
    $persp_id = $this->input->post('persp_id');
    $so_id    = $this->input->post('slc_so');
    $code     = $this->input->post('txt_code');
    $name     = $this->input->post('txt_name');
    $desc     = $this->input->post('txt_desc');
    $weight   = $this->input->post('nm_weight');
    $ytd      = $this->input->post('slc_ytd');
    $formula  = $this->input->post('slc_formula');
    $measure  = $this->input->post('slc_measure');
    // TODO add KPI
    $kpi_id = $this->sc_org_model->add_kpi($sc_id,$so_id,$code,$name,$desc,$measure,$formula,$ytd,$weight);
    $trg_slc = $this->input->post('chk_target');
    foreach ($trg_slc as $index => $month) {
      $trg_val = $this->input->post('nm_target_'.$month);
      // TODO add target
      $this->sc_org_model->add_target($kpi_id,$month,$trg_val);
    }
  }

  public function edit_kpi()
  {
    $kpi_id = $this->input->post('kpi_id');
    $old    = $this->sc_org_model->get_kpi_row($kpi_id);
    $so_ls  = $this->sc_org_model->get_so_pers_ls($old->sc_id,$old->persp_code);
    $so_opt = array();
    foreach ($so_ls as $row) {
      $so_opt[] = array( 
        'value' => $row->so_id,
        'text'  => $row->short_text .' '. $row->long_text);
    }

    $respond['so_opt']  = $so_opt;
    $respond['process'] = 'plan/org/edit_kpi_process';

    $respond['sc_id']   = $old->sc_id;
    $respond['persp']   = $old->persp_code;
    $respond['so_id']   = $old->so_id;
    $respond['kpi_id']  = $old->kpi_id;
    $respond['code']    = $old->short_text;
    $respond['name']    = $old->long_text;
    $respond['desc']    = $old->description;
    $respond['weight']  = $old->weight;
    $respond['ytd']     = $old->ytd_code;
    $respond['formula'] = $old->formula_id;
    $respond['measure'] = $old->measure_id;

    $target = array();
    for ($month=1; $month <= 12 ; $month++) { 
      $trg = $this->sc_org_model->get_target_kpimonth_row($old->kpi_id,$month);
      if ($trg) {
        $target[$month] = array('chk' => TRUE, 'value' =>$trg->target_value);
        
      } else {
        $target[$month] = array('chk' => FALSE, 'value' =>'');
      }
    }

    $respond['target']  = $target;
    
    echo json_encode($respond);

  }

  public function edit_kpi_process()
  {
    $kpi_id   = $this->input->post('kpi_id');
    $sc_id    = $this->input->post('sc_id');
    $persp_id = $this->input->post('persp_id');
    $so       = $this->input->post('slc_so');
    $code     = $this->input->post('txt_code');
    $name     = $this->input->post('txt_name');
    $desc     = $this->input->post('txt_desc');
    $weight   = $this->input->post('nm_weight');
    $ytd      = $this->input->post('slc_ytd');
    $formula  = $this->input->post('slc_formula');
    $measure  = $this->input->post('slc_measure');
    // TODO edit KPI
    $this->sc_org_model->edit_kpi($kpi_id,$code,$name,$desc,$measure,$formula,$ytd,$weight);
    // TODO check old month target 
    $trg_slc = $this->input->post('chk_target');

    for ($month=1; $month <=12 ; $month++) { 
      $old     = $this->sc_org_model->count_target_kpimonth($kpi_id,$month);
      if (in_array($month, $trg_slc)){
        $new = 1;
      } else {
        $new = 0;
      }
      // $new     = $this->input->post('chk_target['.$month.']');
      $new_val = $this->input->post('nm_target_'.$month);
      if ($old == 0 && $new == 1) {
        // jika tidak ada dan sekarang ada, maka tambah
        $this->sc_org_model->add_target($kpi_id,$month,$new_val);
      } elseif ($old == 1 && $new == 0) {
        $target_id = $this->sc_org_model->get_target_kpimonth_row($kpi_id,$month)->target_id;
        // jika ada dan sekarang tidak ada, maka hapus
        $this->sc_org_model->remove_target($target_id);
      } elseif ($old == 1 && $new == 1) {
        $target_id = $this->sc_org_model->get_target_kpimonth_row($kpi_id,$month)->target_id;
        // jika ada dan sekarang ada, maka ubah
        $this->sc_org_model->edit_target($target_id,$new_val);

      
      }
    }
    
  }

  public function remove_kpi()
  {
    $kpi_id = $this->input->post('kpi_id');
    $this->sc_org_model->remove_kpi($kpi_id);
  }


}

/* End of file org.php */
/* Location: ./application/controllers/plan/org.php */