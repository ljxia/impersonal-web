<?php
class PatternModel extends Model 
{
  public $density = 0;
  public $width = 0;
  public $height = 0;
  public $strokeCount = 0;
  public $structure_id = NULL;
  public $offset;
  public $updateTime;
  
  private $id;

  function PatternModel()
  {
    // Call the Model constructor
    parent::Model();
    $this->load->database();
  }

  function insert_entry($data)
  {
    extract($data);
    
    if (isset($structure_id))
    {
      $this->structure_id = $structure_id;
    }
    
    $this->density            = $density;
    $this->width              = $width;
    $this->height             = $height;
    $this->strokeCount        = $strokeCount;
    $this->offset             = $offset;
    
    $this->load->helper('date');
    $datestring = "%Y-%m-%d %h:%i:%s";
    $time = time();

    $this->updateTime = mdate($datestring, $time);
    
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
  
  function all()
  {
    $query = $this->db->select('pattern.*, contour.id as contour_id, contour.fileName as contour_fileName')->from('pattern')->join('contour', 'contour.pattern_id = pattern.id')->order_by('id DESC')->get();
    return $query->result();
  }
  
  
  function getLatest()
  {
    $query = $this->db->select('*')->from('pattern')->order_by('id DESC')->limit(1)->get();
    return $query->first_row();
  }
  
  function getRandom()
  {
    $query = $this->db->select('*')->from('pattern')->where("orientation is null")->order_by('id','RANDOM')->limit(1)->get();
    return $query->first_row();
  }
  
  function getByStructure($structure_id)
  {
    $query = $this->db->select('*')->from('pattern')->where("structure_id",$structure_id)->order_by('id ASC')->get();
    return $query->result();
  }
  
  function update($id, $params)
  {
    $this->db->where('id', $id);
    
    $this->load->helper('date');
    $datestring = "%Y-%m-%d %h:%i:%s";
    $time = time();

    $params["updateTime"] = mdate($datestring, $time);
    
    return $this->db->update("pattern", $params);
  }
  
  function test($id)
  {
    return $id;
    // $params = array("orientation" => 42);
    //     $this->db->where('id', $id);
    //     return $this->db->update("pattern", $params);
  }
}