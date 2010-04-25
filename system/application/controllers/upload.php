<?php
class Upload extends Controller {

  function Upload()
  {
    parent::Controller();
    $this->load->helper(array('form', 'url'));
  }

  function index()
  {

  }

  function interpolation()
  {
    //echo $this->interpolationModel->insert_entry($_POST);
  }

  function pattern()
  {
    //echo $this->patternModel->insert_entry($_POST);
  }

  function stroke()
  {
    //echo $this->strokeModel->insert_entry($_POST);
  }

  function structure()
  {
    //echo $this->structureModel->insert_entry($_POST);
  }

  function image()
  {
    $this->load->view('upload_form', array('error' => ' ' ));
  }

  function inspiration($id)
  {
    $config = array();
    $config['upload_path'] = './uploads/inspiration/';
    $config['allowed_types'] = 'gif|jpg|png|bmp';
    $config['file_name'] = 'ins_'.$id;
    $config['max_size']	= '10240';

    $this->load->library('upload', $config);

    if ($this->upload->do_upload())
    {
      $data = $this->upload->data();
      
      $hash = sha1_file($data["full_path"]);
      $this->inspirationModel->setUploaded($id, $hash);
      
      echo "upload ok; ".$data["full_path"]. " - ".$hash;
    }
    else
    {
      echo "error: ".var_dump($this->upload->display_errors(".","."));
    }
  }
  
  function contour($id)
  {
    $config = array();
    $config['upload_path'] = './uploads/contour/';
    $config['allowed_types'] = 'gif|jpg|png|bmp';
    $config['file_name'] = 'ctr_'.$id;
    $config['max_size']	= '10240';

    $this->load->library('upload', $config);

    if ($this->upload->do_upload())
    {
      $data = $this->upload->data();
      
      $hash = sha1_file($data["full_path"]);
      $this->contourModel->setUploaded($id, $hash);
      
      echo "upload ok; ".$data["full_path"]. " - ".$hash;
    }
    else
    {
      echo "error: ".var_dump($this->upload->display_errors(".","."));
    }
  }
  
  
  

  function do_upload()
  {
    $buffer = $_POST;

    $config['upload_path'] = './uploads/';
    $config['allowed_types'] = 'gif|jpg|png';
    $config['max_size']	= '10240';

    $this->load->library('upload', $config);

    if ( ! $this->upload->do_upload())
    {
      $error = array('error' => $this->upload->display_errors());

      $this->load->view('upload_form', $error);
    }	
    else
    {
      $data = array('upload_data' => $this->upload->data(), "post" => $buffer);

      $this->load->view('upload_success', $data);
    }
  }

}