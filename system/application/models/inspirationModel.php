<?php
class InspirationModel extends Model 
{
  public $width = 0;
  public $height = 0;
  public $type = "file";
  public $url = "";
  public $filehash;
  
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
    if (isset($filehash))
    {
      $this->filehash         = $filehash;
      
      $check_query = $this->db->select('id')->from('inspiration')->where('filehash', $filehash)->get();
      if ($check_query->num_rows() > 0)
      {
        return -1 * $check_query->first_row()->id;
      }
    }
    
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
  
  function setUploaded($id, $file_name)
  {
    $data = array(
              'uploaded' => 1,
              'fileName' => $file_name
            );
            
    $this->db->where('id', $id);
    $this->db->update("inspiration", $data);
  }
}