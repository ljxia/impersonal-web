<?php
class InterpolationModel extends Model 
{
  public $vector             = null;
  public $normalizedVector   = null;
  public $length = 0;
  public $orientation = 0;
  public $steps = 0;
  public $trail = null;
  public $deviation = 0;
  
  private $__id;

  function InterpolationModel()
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
    $this->deviation          = $deviation;
    
    return $this->db->insert('interpolation', $this);
  }
  
  function get($vector, $orientation, $length)
  {
    $quadrant = intval($orientation / 90) + 1;
    
    $query = $this->db->select('*')
                      ->from('interpolation')
                      ->where(array(
                        "orientation >= " => (($quadrant - 1) * 90),
                        "orientation < " => ($quadrant * 90),
                        "length < " => ($length * 1.5),
                        "length > " => ($length * 0.6)
                        ))
                      ->order_by("abs(orientation - $orientation) asc, abs(length - $length) asc, deviation asc")->limit(5)->get();
    
    $row_count = $query->num_rows();
    
    if ($row_count > 0)
    {
      $row = $query->first_row();
      $omit = rand(0, $row_count - 1);
      while ($omit > 0)
      {
          $omit--;
          $row = $query->next_row();
      }
      return $row;
    }
    else
    {
      return "{}";//$this->db->select('*')->from('interpolation')->order_by('id','random')->limit(1)->get()->first_row();
    }    
  }
}