<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pa_model extends CI_Model {

  public function count_emp($begin='',$end='')
  {
    if ($begin == '') {
      $begin = date('Y-m-d');
    }

    if ($end == '') {
      $end = date('Y-m-d');
    }

    $this->db->select('COUNT(*) as val');
    $this->db->from('pa_employee e');
    return $this->db->get()->row()->val;
  }

  public function get_emp_list($begin='',$end='')
  {
    if ($begin == '') {
      $begin = date('Y-m-d');
    }

    if ($end == '') {
      $end = date('Y-m-d');
    }

    $this->db->from('pa_employee e');
    return $this->db->get()->result();
  }

  public function get_emp_row($emp_id=0)
  {
    $this->db->from('pa_employee e');
    $this->db->where('e.emp_id', $emp_id);
    return $this->db->get()->result();
  }

  public function add_emp($firstname='', $middlename='', $lastname='', $fullname='', $nickname='', $birthplace='', $birthdate='', $join_date='', $status_code='',$status_end='9999-12-31')
  {
    $object = array(
      'firstname'  => $firstname,
      'middlename' => $middlename,
      'lastname'   => $lastname,
      'nickname'   => $nickname,
      'fullname'   => $fullname
      'birthplace' => $birthplace,
      'birthdate'  => $birthdate,
      'begin'      => $join_date,
      'end'        => $status_end);
    $this->db->insert('pa_employee', $object);

    $emp_id = $this->db->insert_id();

    // Add Status 
    $this->add_status($emp_id,$status_code,$join_date,$status_end);

    // Add Status

  }

  public function edit_emp($emp_id=0,$firstname='', $middlename='', $lastname='', $fullname='', $nickname='', $birthplace='', $birthdate='',$begin='',$end='')
  {
    $object = array(
      'firstname'  => $firstname,
      'middlename' => $middlename,
      'lastname'   => $lastname,
      'nickname'   => $nickname,
      'fullname'   => $fullname
      'birthplace' => $birthplace,
      'birthdate'  => $birthdate,
      'begin'      => $begin,
      'end'        => $end);
    $this->db->where('emp_id', $emp_id);
    $this->db->insert('pa_employee', $object);
  }

  public function terminate_emp($emp_id=0,$date='')
  {
    $prev_date = date('Y-m-d', strtotime($date .' -1 day'));
    $object = array(
      'end' => $prev_date);
    $this->db->where('emp_id', $emp_id);
    $this->db->update('pa_employee', $object);

    // Delimit last status
    $last = $this->get_status_last($emp_id,'','','9999-12-31');
    $this->delimit_status($last->status_id,$prev_date);

    // Ban Username
    
  }

  public function count_status($emp_id=0,$status_code='',$begin='',$end='')
  {
    if ($begin == '') {
      $begin = date('Y-m-d');
    }

    if ($end == '') {
      $end = date('Y-m-d');
    }

    $this->db->select('COUNT (*) as val');
    $this->db->from('pa_emp_status es');
    $this->db->where('es.emp_id',$emp_id);
    if (is_array($status_code)) {
      $this->db->where_in('es.status_code', $status_code);
    } else {
      if ($status_code !='') {
        $this->db->where('es.status_code', $status_code);
      }
    }
    $this->db->where("((es.begin >= '$begin' AND es.end <='$end') OR 
      (es.end >= '$begin' AND es.end <= '$end') OR 
      (es.begin >= '$begin' AND es.begin <='$end' ) OR
      (es.begin <= '$begin' AND es.end >= '$end'))");
    return $this->db->get()->row()->val;
  } 

  public function get_status_list($emp_id=0,$status_code='',$begin='',$end='')
  {
    if ($begin == '') {
      $begin = date('Y-m-d');
    }

    if ($end == '') {
      $end = date('Y-m-d');
    }

    $this->db->from('pa_emp_status es');
    $this->db->where('es.emp_id',$emp_id);
    if (is_array($status_code)) {
      $this->db->where_in('es.status_code', $status_code);
    } else {
      if ($status_code !='') {
        $this->db->where('es.status_code', $status_code);
      }
    }
    $this->db->where("((es.begin >= '$begin' AND es.end <='$end') OR 
      (es.end >= '$begin' AND es.end <= '$end') OR 
      (es.begin >= '$begin' AND es.begin <='$end' ) OR
      (es.begin <= '$begin' AND es.end >= '$end'))");
    return $this->db->get()->result();
  }

  public function get_status_row($status_id=0)
  {
    $this->db->from('pa_emp_status es');
    $this->db->where('es.status_id',$status_id);
    return $this->db->get()->row();
  }

  public function get_status_last($emp_id=0,$status_code='',$begin='',$end='')
  {
    if ($begin == '') {
      $begin = date('Y-m-d');
    }

    if ($end == '') {
      $end = date('Y-m-d');
    }

    $this->db->from('pa_emp_status es');
    $this->db->where('es.emp_id',$emp_id);
    if (is_array($status_code)) {
      $this->db->where_in('es.status_code', $status_code);
    } else {
      if ($status_code !='') {
        $this->db->where('es.status_code', $status_code);
      }
    }
    $this->db->where("((es.begin >= '$begin' AND es.end <='$end') OR 
      (es.end >= '$begin' AND es.end <= '$end') OR 
      (es.begin >= '$begin' AND es.begin <='$end' ) OR
      (es.begin <= '$begin' AND es.end >= '$end'))");
  }

  public function add_status($emp_id=0,$status_code='',$begin='',$end='9999-12-31')
  {
    $object = array(
      'emp_id'      => $emp_id,
      'status_code' => $status_code 
      'begin'       => $join_date,
      'end'         => '9999-12-31');
    $this->db->insert('pa_emp_status', $object);
  }

  public function edit_status($status_id=0,$begin='',$end='9999-12-31')
  {
    $object = array(
      'begin'       => $begin,
      'end'         => $end);
    $this->db->where('status_id', $status_id);
    $this->db->update('pa_emp_status', $object);
  }

  public function delimit_status($status_id=0,$end='9999-12-31')
  {
    $object = array(
      'end'         => $end);
    $this->db->where('status_id', $status_id);
    $this->db->update('pa_emp_status', $object);
  }

  public function remove_status($status_id=0)
  {
    $this->db->where('status_id', $status_id);
    $this->db->delete('pa_emp_status');

  }

}

/* End of file pa_model.php */
/* Location: ./application/models/pa_model.php */