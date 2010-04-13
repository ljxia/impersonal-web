<?php
class Structure extends Controller {

	function index()
	{
		echo 'structure';
	}
	
	function get()
	{
	  echo json_encode($this->structureModel->getLatest());
	}
}