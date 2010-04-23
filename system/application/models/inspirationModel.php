<?php
class InspirationModel extends Model 
{
  public $width = 0;
  public $height = 0;
  public $type = "file";
  public $url = "";
  
  
  private $id;

  function InspirationModel()
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
    $this->type               = $type;
    $this->url                = $url;
    
    $result = $this->db->insert('inspiration', $this);
    
    if ($result !== FALSE)
    {
      $query = $this->db->select('id')->from('inspiration')->order_by('id DESC')->limit(1)->get();
      return $query->first_row()->id;
    }
    else
    {
      return "-1";
    }
  }
  
  function setUploaded($id, $hash)
  {
    $data = array(
              'uploaded' => 1,
              'filehash' => $hash
            );
            
    $this->db->where('id', $id);
    $this->db->update("inspiration", $data);
  }
}