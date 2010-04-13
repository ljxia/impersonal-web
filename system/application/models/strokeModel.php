<?php
class StrokeModel extends Model 
{
  public $trail = null;
  public $brushSize = 0;
  public $brushColor = 0;
  public $pattern_id = 0;
  
  private $__id;

  function StrokeModel()
  {
    // Call the Model constructor
    parent::Model();
    $this->load->database();
  }

  function insert_entry($data)
  {
    extract($data);
    
    $this->pattern_id         = $pattern_id;
    $this->brushSize          = $brushSize;
    $this->brushColor         = $brushColor;
    $this->trail              = $trail;
    
    $result = $this->db->insert('stroke', $this);
    
    if ($result !== FALSE)
    {
      $query = $this->db->select('id')->from('stroke')->order_by('id DESC')->limit(1)->get();
      return $query->first_row()->id;
    }
    else
    {
      return "-1";
    }
  }
  
  function getLatest()
  {
    $query = $this->db->select('*')->from('stroke')->order_by('id DESC')->limit(1)->get();
    return $query->first_row();
  }
  
  function getByPattern($pattern_id)
  {
    $query = $this->db->select('*')->from('stroke')->where("pattern_id",$pattern_id)->order_by('id ASC')->get();
    return $query->result();
  }
  
}