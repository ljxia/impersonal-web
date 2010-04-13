<?php
class Pattern extends Controller {

	function index()
	{
		echo 'pattern';
	}
	
	function get()
	{
	  extract($_POST);
	  if (isset($structure_id))
	  {
	    echo json_encode($this->patternModel->getByStructure($structure_id));
	  }
	  else
	  {
	    echo json_encode($this->patternModel->getLatest());
	  }
	}
	
	function get_by_structure($structure_id)
	{
	  echo json_encode($this->patternModel->getByStructure($structure_id));
	}
	
}