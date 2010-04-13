<?php
class StructureModel extends Model 
{
  public $width = 0;
  public $height = 0;
  
  private $__id;

  function StructureModel()
  {
    // Call the Model constructor
    parent::Model();
    $this->load->database();
  }

  function insert_entry($data)
  {
    extract($data);
    
    $this->width              = $width;
    $this->height             = $height;
    $this->patternCount       = $patternCount;
    
    $result = $this->db->insert('structure', $this);
    
    if ($result !== FALSE)
    {
      $query = $this->db->select('id')->from('structure')->order_by('id DESC')->limit(1)->get();
      return $query->first_row()->id;
    }
    else
    {
      return "-1";
    }
  }
  
  function getLatest()
  {
    $query = $this->db->select('*')->from('structure')->order_by('id DESC')->limit(1)->get();
    return $query->first_row();
  }
}