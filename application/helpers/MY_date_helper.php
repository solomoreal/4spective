<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


if ( ! function_exists('count_diff'))
{
  /**
   * [menghitung perbedaan antara dua waktu]
   * @param  string  $time1     [tanggal / waktu pertama]
   * @param  string  $time2     [tanggal / waktu kedua]
   * @param  integer $precision [presisi waktu yang diinginkan]
   * @return [array]             [description]
   */
	function count_diff($time1='', $time2='',$precision=6)
	{
		// If not numeric then convert texts to unix timestamps
    if (!is_int($time1)) {
      $time1 = strtotime($time1);
    }
    if (!is_int($time2)) {
      $time2 = strtotime($time2);
    }
 
    // If time1 is bigger than time2
    // Then swap time1 and time2
    if ($time1 > $time2) {
      $ttime = $time1;
      $time1 = $time2;
      $time2 = $ttime;
    }
 
    // Set up intervals and diffs arrays
    $intervals = array('year','month','day','hour','minute','second');
    $diffs = array();
 		$result = array();
    // Loop thru all intervals
    foreach ($intervals as $interval) {
      // Create temp time from time1 and interval
      $ttime = strtotime('+1 ' . $interval, $time1);
      // Set initial values
      $add = 1;
      $looped = 0;
      // Loop until temp time is smaller than time2
      while ($time2 >= $ttime) {
        // Create new temp time from time1 and interval
        $add++;
        $ttime = strtotime("+" . $add . " " . $interval, $time1);
        $looped++;
      }
 
      $time1 = strtotime("+" . $looped . " " . $interval, $time1);
      $diffs[$interval] = $looped;
    }
 
    $count = 0;
    $times = array();
    // Loop thru all diffs
    foreach ($diffs as $interval => $value) {
      // Break if we have needed precission
      if ($count >= $precision) {
				break;
	    }   
		// Add value and interval to times array
			$times[] = $value . " " . $interval;
			$result[$interval] = $value;
			$count++;
	    
	  }
	 
	  // Return string with times
	  return $result;
	}
}

if ( ! function_exists('date_from_sap')) {
  /**
   * [merubah tanggal SAP kedalam format yyyy-mm-dd]
   * @param  string $sap_date     [yyyymmdd]
   * @param  string $date_format  [format date]
   * @return [type]               [description]
   */
  function date_from_sap($sap_date='',$date_format='Y-m-d')
  {
    $date = substr($sap_date, 0,4); //ambil tahun
    $date .= '-';
    $date .= substr($sap_date, 4,2); //ambil bulan
    $date .= '-';
    $date .= substr($sap_date, 6,2); //ambil tanggal
    return date($date_format,strtotime($date));
  }
}

if ( ! function_exists('date_to_sap')) {
  /**
   * [merubah tanggal menjadi format tanggal SAP]
   * @param  [string] $date [tanggal yyyy-mm-dd ]
   * @return [string]       [yyyymmdd]
   */
  function date_to_sap($date)
  {
    $search = array('-','/');
    $sap_date = str_replace($search, '', $date);

    return $sap_date;
  }
}
/* End of file MY_date_helper.php */
