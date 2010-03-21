<?php
class LineInterpolation extends Model 
{
  public $vector             = null;
  public $normalizedVector   = null;
  public $length = 0;
  public $orientation = 0;
  public $steps = 0;
  public $trail = null;
  
  private $__id;

  function LineInterpolation()
  {
    // Call the Model constructor
    parent::Model();
    $this->load->database();
  }

  function insert_entry($data)
  {
    extract($data);
    
    $this->load->helper('date');
    
    $this->vector             = $vector;
    $this->normalizedVector   = $normalizedVector;
    $this->length             = $length;
    $this->orientation        = $orientation;
    $this->steps              = $steps;
    $this->steps              = $steps;
    $this->trail              = $trail;
    
    return $this->db->insert('interpolation', $this);
  }
  
  function get($vector)
  {
    return $this->db->select('*')->from('interpolation')->order_by('id','desc')->limit(1)->get()->first_row();
  }
}