<?php
class PatternModel extends Model 
{
  public $density = 0;
  public $width = 0;
  public $height = 0;
  public $strokeCount = 0;
  public $pattern_id = NULL;
  
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
    
    if (isset($pattern_id))
    {
      $this->pattern_id = $pattern_id;
    }
    
    $this->density            = $density;
    $this->width              = $width;
    $this->height             = $height;
    $this->strokeCount        = $strokeCount;
    
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
  
  function getByStructure($structure_id)
  {
    $query = $this->db->select('*')->from('pattern')->where("structure_id",$structure_id)->order_by('id ASC')->get();
    return $query->result();
  }
}