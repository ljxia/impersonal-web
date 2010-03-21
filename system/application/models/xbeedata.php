<?php
class Xbeedata extends Model 
{
  var $address    = '';
  var $value      = '';
  var $lastUpdate = '';


  function Xbeedata()
  {
    // Call the Model constructor
    parent::Model();
    $this->load->database();
  }

  function insert_entry($address, $value)
  {
    $this->load->helper('date');
    
    $this->address  = $address;
    $this->value    = $value;
    
    $datestring = "%Y-%m-%d %h:%i:%s";
    $time = time();

    $this->lastUpdate = mdate($datestring, $time);
    
    
    $query = $this->db->select('value, lastUpdate')
                      ->from('xbeedata')
                      ->where('address',$address)
                      ->order_by('lastUpdate DESC')
                      ->limit(1)
                      ->get();
    
    if ($query->num_rows() > 0)                  
    {
      $data = $query->result();
      if ($data[0]->value == $value)
      {
        return -1;
      }
    }

    return $this->db->insert('xbeedata', $this);
  }

  function list_all()
  {
    $query = $this->db->query('SELECT id, address, value, lastUpdate FROM xbeedata ORDER BY lastUpdate DESC');

    return $query->result();
  }
  
  function list_by_address($address)
  {
    $query = $this->db->select('id, address, value, lastUpdate')
                      ->from('xbeedata')
                      ->where('address',$address)
                      ->order_by('lastUpdate DESC')
                      ->get();
                      
    
    return $query->result();
  }
  
  function find_by_day($address, $day)
  {
    $day = substr($day, 0, 4)."-".substr($day, 4, 2)."-".substr($day, 6, 2);
    
    // $from_format = 'Ymd';
    //     $to_format = 'Y-m-d';
    //     
    //     $dt = DateTime::createFromFormat($from_format, $day);
    //     $day = $dt->format($to_format);
    //     
    $query = $this->db->select('id, address, value, lastUpdate')
                      ->from('xbeedata')
                      ->where('address',$address)
                      ->where('lastUpdate >= ', $day." 00:00:00")
                      ->where('lastUpdate <= ', $day." 23:59:59")
                      ->order_by('lastUpdate DESC')
                      ->get();
    
    return $query->result();
  }
  
  function status_by_address($address,$timestamp)
  {
    $from_format = 'YmdHis';
    $to_format = 'Y-m-d H:i:s';
    
    $dt = DateTime::createFromFormat($from_format, $timestamp);
    $timestamp = $dt->format($to_format);
        
    $query = $this->db->select('value, lastUpdate')
                      ->from('xbeedata')
                      ->where('address',$address)
                      ->where('lastUpdate < ', $timestamp)
                      ->order_by('lastUpdate DESC')
                      ->limit(1)
                      ->get();
    
    if ($query->num_rows() > 0)                  
    {
      return $query->result();
    }
    else
    {
      return "unknown";
    }
  }
  
  function changes_by_address_and_day($address,$day = '')
  {
    $this->db->from('xbeedata')->where('address',$address);
    
    if ($day != '') //by day
    {
      $day = substr($day, 0, 4)."-".substr($day, 4, 2)."-".substr($day, 6, 2);
      
      $this->db->where('lastUpdate >= ', $day." 00:00:00")
               ->where('lastUpdate <= ', $day." 23:59:59");
    }
    
    $changes = $this->db->count_all_results() - 1;
    if ($changes < 0) $changes = 0;
    return $changes;
  }
  
  function stats_by_address_and_day($address, $day = '')
  {
    $openTime = 0;
    $closeTime = 0;
    
    $changes = 0;
    $firstTimestamp = 0;  
    $lastTimestamp = 0;
    
    $this->db->select('value, UNIX_TIMESTAMP(lastUpdate) AS lastUpdateTimestamp')
                      ->from('xbeedata')
                      ->where('address',$address)
                      ->order_by('lastUpdate ASC');
                    
    if (!empty($day)) //by day
    {
      $day = substr($day, 0, 4)."-".substr($day, 4, 2)."-".substr($day, 6, 2);

      $this->db->where('lastUpdate >= ', $day." 00:00:00")
               ->where('lastUpdate <= ', $day." 23:59:59");
    }             
    
    $query = $this->db->get();
                      
    foreach ($query->result() as $row) 
    {
      if ($changes > 0)
      {
        if ($row->value > 0)
        {
          $closeTime += $row->lastUpdateTimestamp - $lastTimestamp;
        }
        else
        {
          $openTime += $row->lastUpdateTimestamp - $lastTimestamp;
        }
      }
      else
      {
        $firstTimestamp = $row->lastUpdateTimestamp;
      }
      
      $lastTimestamp = $row->lastUpdateTimestamp;
      $changes++;
    }
    
    if ($changes > 0) $changes--;
    
    $sensorActiveTime = $lastTimestamp - $firstTimestamp;
    
    return compact('address','openTime','closeTime','changes','sensorActiveTime');
  }
  
  
}