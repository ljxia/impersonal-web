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
	  else if (isset($random))
	  {
	    echo json_encode($this->patternModel->getRandom());
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
	
	function update($id)
	{
	  echo json_encode($this->patternModel->update($id, $_POST));
	}
	
	function test($id)
	{
	  echo json_encode($this->patternModel->test($id));
	}
}