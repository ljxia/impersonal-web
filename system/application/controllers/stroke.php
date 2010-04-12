<?php
class Stroke extends Controller {

	function index()
	{
		echo 'stroke';
	}
	
	function get()
	{
	  extract($_POST);
	  if (isset($pattern_id))
	  {
	    echo json_encode($this->strokeModel->getByPattern($pattern_id));
	  }
	  else
	  {
	    echo json_encode($this->strokeModel->getLatest());
	  }
	}
	
	function get_by_pattern($pattern_id)
	{
	  echo json_encode($this->strokeModel->getByPattern($pattern_id));
	}
}