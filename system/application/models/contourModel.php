<?php
class ContourModel extends Model 
{
  public $inspiration_id;
  public $pattern_id;
  public $threshold = -1;
  public $area = 0;
  public $isHole = 0;
  
  
  private $id;

  function ContourModel()
  {
    // Call the Model constructor
    parent::Model();
    $this->load->database();
  }

  function insert_entry($data)
  {
    extract($data);
    
    $this->inspiration_id     = $inspiration_id;
    $this->pattern_id         = $pattern_id;
    $this->threshold          = $threshold;
    $this->area               = $area;
    $this->isHole             = $isHole;
    
    // $this->load->helper('date');
    // $datestring = "%Y-%m-%d %h:%i:%s";
    // $time = time();
    // 
    // $this->updateTime = mdate($datestring, $time);
    
    $result = $this->db->insert('contour', $this);
    
    if ($result !== FALSE)
    {
      $query = $this->db->select('id')->from('contour')->order_by('id DESC')->limit(1)->get();
      return $query->first_row()->id;
    }
    else
    {
      return "-1";
    }
  }
  
  function setUploaded($id, $file_name)
  {
    $data = array(
              'uploaded' => 1,
              'fileName' => $file_name
            );
            
    $this->db->where('id', $id);
    $this->db->update("contour", $data);
  }
}