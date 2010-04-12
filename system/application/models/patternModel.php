<?php
class PatternModel extends Model 
{
  public $density = 0;
  public $width = 0;
  public $height = 0;
  public $strokeCount = 0;
  
  private $__id;

  function PatternModel()
  {
    // Call the Model constructor
    parent::Model();
    $this->load->database();
  }

  function insert_entry($data)
  {
    extract($data);
    
    $this->load->helper('date');
    
    $this->density            = $density;
    $this->width              = $width;
    $this->height             = $height;
    
    $result = $this->db->insert('pattern', $this);
    
    if ($result !== FALSE)
    {
      $query = $this->db->select('id')->from('pattern')->order_by('id DESC')->limit(1)->get();
      return $query->first_row()->id;
    }
    else
    {
      return "-1";
    }
  }
  
  function getLatest()
  {
    $query = $this->db->select('*')->from('pattern')->order_by('id DESC')->limit(1)->get();
    return $query->first_row();
  }
}