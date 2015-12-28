<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sc_org_model extends CI_Model {

  public function check_sc($org_id=0,$begin='',$end='')
  {
    if ($begin == '') {
      $begin = date('Y-m-d');
    }
    if ($end == '') {
      $end = $begin;
    }
    $this->db->select('sc.*');
    $this->db->from('sc_org sc');
    $this->db->join('sc_m_period p', 'p.period_code = sc.period');
    $this->db->where('sc.org_id', $org_id);
    $this->db->where("((p.begin >= '$begin' AND p.end <='$end') OR 
          (p.end >= '$begin' AND p.end <= '$end') OR 
          (p.begin >= '$begin' AND p.begin <='$end' ) OR
          (p.begin <= '$begin' AND p.end >= '$end'))");
    return $result = $this->db->count_all_results();
  }

  public function get_sc_row($org_id=0,$begin='',$end='')
  {
    if ($begin == '') {
      $begin = date('Y-m-d');
    }
    if ($end == '') {
      $end = $begin;
    }
    $this->db->select('sc.*');
    $this->db->from('sc_org sc');
    $this->db->join('sc_m_period p', 'p.period_code = sc.period');

    $this->db->where('sc.org_id', $org_id);
    $this->db->where("((p.begin >= '$begin' AND p.end <='$end') OR 
          (p.end >= '$begin' AND p.end <= '$end') OR 
          (p.begin >= '$begin' AND p.begin <='$end' ) OR
          (p.begin <= '$begin' AND p.end >= '$end'))");
    $result = $this->db->get()->row();
    if (count($result)) {
      return $result;
    } else {
      return false;
    }
  }

  public function get_sc_byid_row($sc_id=0)
  {

    $this->db->from('sc_org sc');
    $this->db->where('sc.sc_id', $sc_id);
   
          
    $result = $this->db->get()->row();
    if (count($result)) {
      return $result;
    } else {
      return false;
    }
  }

  public function get_pair_sc_ls($org_id=0,$begin='',$end='',$status='')
  {
    if ($begin == '') {
      $begin = date('Y-m-d');
    }
    if ($end == '') {
      $end = $begin;
    }
    // TODO get parent org
    $this->db->select('o.obj_id AS org_id');
    
    $this->db->from('om_obj o');
    $this->db->where('o.obj_type', 'O');
    $this->db->where("((o.begin >= '$begin' AND o.end <='$end') OR 
          (o.end >= '$begin' AND o.end <= '$end') OR 
          (o.begin >= '$begin' AND o.begin <='$end' ) OR
          (o.begin <= '$begin' AND o.end >= '$end'))");
    $this->db->where("((r.begin >= '$begin' AND r.end <='$end') OR 
          (r.end >= '$begin' AND r.end <= '$end') OR 
          (r.begin >= '$begin' AND r.begin <='$end' ) OR
          (r.begin <= '$begin' AND r.end >= '$end'))");
    $this->db->join('om_obj_attr a', 'a.obj_id = o.obj_id');
    
    
    $this->db->join('om_obj_rel r', 'o.obj_id = r.obj_from');
    $this->db->where('r.obj_to', $org_id);
    $this->db->where('r.rel_type', '002');

    $org_parent = $this->db->get()->row();
    if (count($org_parent)) {
      // TODO get pair org
      $this->db->select('o.obj_id AS org_id');
      $this->db->from('om_obj o');
      $this->db->join('om_obj_rel r', 'o.obj_id = r.obj_to');
      $this->db->where('o.obj_type', 'O');
      $this->db->where("((o.begin >= '$begin' AND o.end <='$end') OR 
            (o.end >= '$begin' AND o.end <= '$end') OR 
            (o.begin >= '$begin' AND o.begin <='$end' ) OR
            (o.begin <= '$begin' AND o.end >= '$end'))");
      $this->db->where("((r.begin >= '$begin' AND r.end <='$end') OR 
            (r.end >= '$begin' AND r.end <= '$end') OR 
            (r.begin >= '$begin' AND r.begin <='$end' ) OR
            (r.begin <= '$begin' AND r.end >= '$end'))");
      
      $this->db->where('r.obj_from', $org_parent->org_id);
      $this->db->where('r.rel_type', '002');
      $org_pair = $this->db->get()->result();

      if (count($org_pair)) {
        $temp = array();
        foreach ($org_pair as $row) {
          $temp[] = $row->org_id;
        }

        $this->db->select('sc.*');
        $this->db->select('a.short_name AS org_code');
        $this->db->select('a.long_name AS org_name');
        
        $this->db->from('sc_org sc');
        $this->db->join('sc_m_period p', 'p.period_code = sc.period');
        $this->db->join('om_obj_attr a', 'a.obj_id = sc.org_id');

        $this->db->where_in('sc.org_id', $temp);
        $this->db->where("((p.begin >= '$begin' AND p.end <='$end') OR 
              (p.end >= '$begin' AND p.end <= '$end') OR 
              (p.begin >= '$begin' AND p.begin <='$end' ) OR
              (p.begin <= '$begin' AND p.end >= '$end'))");
        $this->db->where("((a.begin >= '$begin' AND a.end <='$end') OR 
          (a.end >= '$begin' AND a.end <= '$end') OR 
          (a.begin >= '$begin' AND a.begin <='$end' ) OR
          (a.begin <= '$begin' AND a.end >= '$end'))");

        if (is_array($status)) {
          $this->db->where_in('sc.status', $status);

        } else if ($status !='') {
          $this->db->where('sc.status', $status);
        }
        $this->db->order_by('p.end', 'desc');
        $this->db->order_by('p.begin', 'desc');
        return $this->db->get()->result();

      } else {
        return FALSE;
      }
    
    } else {
      return FALSE;
    }

  }

  public function get_sc_ls($org_id=0,$begin='',$end='',$status='')
  {
    if ($begin == '') {
      $begin = date('Y-m-d');
    }
    if ($end == '') {
      $end = $begin;
    }
    $this->db->select('sc.*');

    $this->db->from('sc_org sc');
    $this->db->join('sc_m_period p', 'p.period_code = sc.period');

    $this->db->where('sc.org_id', $org_id);
    $this->db->where("((p.begin >= '$begin' AND p.end <='$end') OR 
          (p.end >= '$begin' AND p.end <= '$end') OR 
          (p.begin >= '$begin' AND p.begin <='$end' ) OR
          (p.begin <= '$begin' AND p.end >= '$end'))");
    if ($status !='') {
      $this->db->where('sc.status', $status);
    }
    $this->db->order_by('p.end', 'desc');
    $this->db->order_by('p.begin', 'desc');
    $result = $this->db->get()->result();

    return $result;
  }

  public function copy_sc($org_id=0,$new_period='',$old_sc_id=0)
  {    
    $new_sc_id = $this->add_sc($org_id,$new_period,$old_sc_id);
    // TODO Dapatkan SO dari SC lama 
    $old_so = $this->get_so_ls($old_sc_id);

    foreach ($old_so as $so) {
      // TODO Copy SO dari SC lama ke SC yang baru
      $new_so_id = $this->add_so($new_sc_id,$so->perspective_code,$so->short_text,$so->long_text,$so->desc,NULL,$so->so_id);
      // TODO Dapatkan KPI dari tiap SO yang lama
      $old_kpi = $this->get_kpi_byso_ls($so->so_id);
      
      foreach ($old_kpi as $kpi) {
        // TODO Copy KPI dari tiap SO lama ke SO yang baru
        $new_kpi_id = $this->add_kpi($new_sc_id,$new_so_id,$kpi->short_text,$kpi->long_text,$kpi->desc,$kpi->measure_id,$kpi->formula_id,$kpi->ytd_code,$kpi->weight,$kpi->kpi_gen,$kpi->kpi_id);

        // TODO dapatkan rel kpi dari tiap kpi yang lama ke KPI yang baru

        // TODO Dapatkan Target dari tiap KPI yang lama
        $target_ls = $this->get_target_ls($kpi->kpi_id);
        foreach ($target_ls as $target) {
          // TODO Copy Target dari tiap KPI lama ke KPI yang baru
          $this->add_target($new_kpi_id,$target->month,$target->target_value);
        }
      }

    }

    return $new_sc_id;
    

  }

  public function add_sc($org_id=0,$period,$copy_from=NULL, $ref_to=NULL)
  {
    $object = array(
      'org_id'    => $org_id,
      'status'    => 'draft',
      'period'    => $period,
      'copy_from' => $copy_from,
      'ref_to'    => $ref_to);
    $this->db->insert('sc_org', $object);
    return $this->db->insert_id();
  }

  public function edit_sc_status($sc_id=0,$status='draft')
  {
    $object = array(
      'status' => $status);
    $this->db->where('sc_id', $sc_id);
    $this->db->update('sc_org', $object);
  }

  public function remove_sc($sc_id=0)
  {
    $this->db->where('sc_id', $sc_id);
    $this->db->delete('sc_org');
  }

  /////////////////////////
  // Startegic Objective //
  /////////////////////////

  public function count_so_child($so_id=0)
  {
    $this->db->from('sc_org_so so');
    $this->db->where('so.so_parent', $so_id);
    return $this->db->count_all_results();
    
  }

  public function get_so_ls($sc_id=0)
  {
    $this->db->select('so.*');
    $this->db->select('p.description as persp_name');
    $this->db->from('sc_org_so so');
    $this->db->join('sc_m_perspective p', 'p.perspective_code = so.perspective_code');
    $this->db->where('so.sc_id', $sc_id);
    return $this->db->get()->result();
  }

  public function get_so_pers_ls($sc_id=0,$perspective_code='')
  {
    $this->db->select('so.*');
    $this->db->from('sc_org_so so');
    $this->db->where('so.sc_id', $sc_id);
    $this->db->where('so.perspective_code', $perspective_code);
    return $this->db->get()->result();
  }

  public function get_so_row($so_id=0)
  {
    $this->db->select('so.*');
    $this->db->select('p.description as persp_name');
    $this->db->select('p.perspective_code as persp_code');
    $this->db->from('sc_org_so so');
    $this->db->join('sc_m_perspective p', 'p.perspective_code = so.perspective_code');
    $this->db->where('so.so_id', $so_id);
    return $this->db->get()->row();
  }

  public function add_so($sc_id=0,$perspective_code='',$short_text='',$long_text='',$desc='',$so_parent=NULL,$copy_from=NULL)
  {
    $object = array(
      'sc_id'             => $sc_id,
      'perspective_code'  => $perspective_code,
      'short_text'        => $short_text,
      'long_text'         => $long_text,
      'so_parent'         => $so_parent,
      'copy_from'         => $copy_from,
      'description'       => $desc);
    $this->db->insert('sc_org_so', $object);
    return $this->db->insert_id();
  }

  public function edit_so($so_id=0,$perspective_code='',$short_text='',$long_text='',$desc='')
  {
    $object = array(
      'perspective_code'  => $perspective_code,
      'short_text'        => $short_text,
      'long_text'         => $long_text,
      'description'       => $desc);
    $this->db->where('so_id', $so_id);
    $this->db->update('sc_org_so', $object);

  }

  public function remove_so($so_id=0)
  {
    $this->db->where('so_id', $so_id);
    $this->db->delete('sc_org_so');
  }

  ///////////////////////////////
  // Key Performance Indicator //
  ///////////////////////////////
  
  public function count_kpi($sc_id=0,$so_id=0)
  {
    $this->db->from('sc_org_kpi k');
    $this->db->join('sc_org_so so', 'so.so_id = k.so_id');
    $this->db->where('so.sc_id', $sc_id);
    if ($so_id > 0) {
      $this->db->where('so.so_id', $so_id);
    }

    return $this->db->count_all_results();
  }

  public function sum_kpi_weight($sc_id=0,$so_id=0)
  {
    $this->db->select_sum('k.weight');
    $this->db->from('sc_org_kpi k');
    $this->db->join('sc_org_so so', 'so.so_id = k.so_id');
    $this->db->where('so.sc_id', $sc_id);
    if ($so_id > 0) {
      $this->db->where('so.so_id', $so_id);
    }
    $result = $this->db->get()->row()->weight;
    if (is_null($result)) {
      return 0;
    } else {
      return $result;
    }
  }

  public function get_kpi_byso_ls($so_id=0)
  {
    $this->db->select('kpi.*');
    $this->db->select('f.formula_name');
    $this->db->select('ytd.ytd_name');
    $this->db->select('m.short_name as msr_code');
    $this->db->select('m.long_name as msr_name');
    $this->db->from('sc_org_kpi kpi');
    $this->db->join('sc_m_ytd ytd', 'ytd.ytd_code = kpi.ytd_code');
    $this->db->join('sc_m_formula f', 'f.formula_id = kpi.formula_id');
    $this->db->join('sc_m_measure m', 'm.measure_id = kpi.measure_id');

    $this->db->where('kpi.so_id', $so_id);

    return $this->db->get()->result();

  }

  public function get_kpi_bysc_ls($sc_id=0)
  {
    $this->db->select('kpi.*');
    $this->db->select('f.formula_name');
    $this->db->select('ytd.ytd_name');
    $this->db->select('m.short_name as msr_code');
    $this->db->select('m.long_name as msr_name');

    $this->db->select('p.description as persp_name');
    $this->db->select('so.short_text as so_code');
    $this->db->select('so.long_text as so_name');

    $this->db->from('sc_org_kpi kpi');
    $this->db->join('sc_m_ytd ytd', 'ytd.ytd_code = kpi.ytd_code');
    $this->db->join('sc_m_formula f', 'f.formula_id = kpi.formula_id');
    $this->db->join('sc_m_measure m', 'm.measure_id = kpi.measure_id');
    
    $this->db->join('sc_org_so so', 'so.so_id = kpi.so_id');
    $this->db->join('sc_m_perspective p', 'p.perspective_code = so.perspective_code');


    $this->db->where('kpi.sc_id', $sc_id);

    return $this->db->get()->result();

  }

  public function get_kpi_row($kpi_id=0)
  {
    $this->db->select('kpi.*');
    $this->db->select('f.formula_name');
    $this->db->select('ytd.ytd_name');
    $this->db->select('m.short_name as msr_code');
    $this->db->select('m.long_name as msr_name');

    $this->db->select('p.description as persp_name');
    $this->db->select('p.perspective_code as persp_code');
    $this->db->select('so.so_id as so_id');
    $this->db->select('so.short_text as so_code');
    $this->db->select('so.long_text as so_name');

    $this->db->from('sc_org_kpi kpi');
    $this->db->join('sc_m_ytd ytd', 'ytd.ytd_code = kpi.ytd_code');
    $this->db->join('sc_m_formula f', 'f.formula_id = kpi.formula_id');
    $this->db->join('sc_m_measure m', 'm.measure_id = kpi.measure_id');
    
    $this->db->join('sc_org_so so', 'so.so_id = kpi.so_id');
    $this->db->join('sc_m_perspective p', 'p.perspective_code = so.perspective_code');


    $this->db->where('kpi.kpi_id', $kpi_id);

    return $this->db->get()->row();
  }

  public function add_kpi($sc_id=0,$so_id=0,$short_text='',$long_text='',$desc='',$measure_id=0,$formula_id=0,$ytd_code='',$weight=0,$kpi_gen=NULL,$copy_from=NULL)
  {
    $object = array(
      'sc_id'       => $sc_id,
      'so_id'       => $so_id,
      'short_text'  => $short_text,
      'long_text'   => $long_text,
      'description' => $desc,
      'measure_id'  => $measure_id,
      'formula_id'  => $formula_id,
      'ytd_code'    => $ytd_code,
      'weight'      => $weight,
      'copy_from'   => $copy_from,
      'kpi_gen'     => $kpi_gen);
    $this->db->insert('sc_org_kpi', $object);
    return $this->db->insert_id();
  }

  public function edit_kpi($kpi_id=0,$short_text='',$long_text='',$desc='',$measure_id=0,$formula_id=0,$ytd_code='',$weight=0)
  {
    $object = array(
      'short_text'  => $short_text,
      'long_text'   => $long_text,
      'description' => $desc,
      'measure_id'  => $measure_id,
      'formula_id'  => $formula_id,
      'ytd_code'    => $ytd_code,
      'weight'      => $weight);
    $this->db->where('kpi_id', $kpi_id);
    $this->db->update('sc_org_kpi', $object);
  }

  public function remove_kpi($kpi_id='')
  {
    $this->db->where('kpi_id', $kpi_id);
    $this->db->delete('sc_org_target');

    $this->db->where('kpi_id', $kpi_id);
    $this->db->delete('sc_org_kpi');
  }

  public function count_kpi_child($kpi_parent=0)
  {
    
    $this->db->from('sc_org_rel r');
    $this->db->join('sc_org_kpi k', 'r.kpi_child = k.kpi_id');
    $this->db->where('r.kpi_parent', $kpi_parent);

    return $this->db->count_all_results();
  }

  public function count_kpi_parent($kpi_child=0)
  {
    
    $this->db->from('sc_org_rel r');
    $this->db->join('sc_org_kpi k', 'r.kpi_parent = k.kpi_id');
    $this->db->where('r.kpi_child', $kpi_child);

    return $this->db->count_all_results();
  }

  public function get_kpi_child_ls($kpi_parent=0)
  {
    $this->db->select('k.*');
    $this->db->select('r.val');
    $this->db->select('r.rel_id');
    $this->db->from('sc_org_rel r');
    $this->db->join('sc_org_kpi k', 'r.kpi_child = k.kpi_id');
    $this->db->where('r.kpi_parent', $kpi_parent);

    return $this->db->get()->result();
  }

  public function get_kpi_parent_row($kpi_child=0)
  {
    $this->db->select('k.*');
    $this->db->select('r.val');
    $this->db->select('r.rel_id');
    $this->db->from('sc_org_rel r');
    $this->db->join('sc_org_kpi k', 'r.kpi_parent = k.kpi_id');
    $this->db->where('r.kpi_child', $kpi_child);

    return $this->db->get()->row();
  }

  public function add_rel($kpi_parent=0,$kpi_child=0,$val=0.00)
  {
    $object = array(
      'kpi_parent' => $kpi_parent ,      
      'kpi_child'  => $kpi_child ,
      'val'        => $val
    );
    $this->db->insert('sc_org_rel', $object);
    return $this->db->insert_id();
  }

  public function edit_rel($rel_id=0,$val=0.00)
  {
    $object = array(
      'val'        => $val
    );
    $this->db->where('rel_id', $rel_id);

    $this->db->update('sc_org_rel', $object);
    return $this->db->insert_id();
  }

  public function remove_rel($rel_id=0)
  {
    $this->db->where('rel_id', $rel_id);
    $this->db->delete('sc_org_rel');

  }

  ////////////
  // Target //
  ////////////
  
  public function count_target_kpimonth($kpi_id=0,$month=0)
  {
    $this->db->from('sc_org_target');
    $this->db->where('kpi_id', $kpi_id);
    $this->db->where('month', $month);
    return $this->db->count_all_results();
  }
  
  public function get_target_ls($kpi_id=0)
  {
    $this->db->from('sc_org_target');
    $this->db->where('kpi_id', $kpi_id);
    return $this->db->get()->result();
  }

  public function get_target_kpimonth_row($kpi_id=0,$month=0)
  {
    $this->db->from('sc_org_target');
    $this->db->where('kpi_id', $kpi_id);
    $this->db->where('month', $month);
    return $this->db->get()->row();
  }

  public function get_target_row($target_id='')
  {
    $this->db->from('sc_org_target');
    $this->db->where('target_id', $target_id);

    return $this->db->get()->row();
  }

  public function add_target($kpi_id=0,$month=0,$target_value=0.00)
  {
    $object = array(
      'kpi_id'       => $kpi_id,
      'month'        => $month,
      'target_value' => $target_value);
    $this->db->insert('sc_org_target', $object);
    return $this->db->insert_id();
  }

  public function edit_target($target_id=0,$target_value=0.00)
  {
    $object = array(
      'target_value' => $target_value);
    $this->db->where('target_id', $target_id);
    $this->db->update('sc_org_target', $object);

  }

  public function remove_target($target_id=0)
  {
    $this->db->where('target_id', $target_id);
    $this->db->delete('sc_org_target');
  }
}

/* End of file sc_org_model.php */
/* Location: ./application/models/sc_org_model.php */