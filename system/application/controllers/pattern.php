<?php
class Pattern extends Controller {

	function index()
	{
		echo 'pattern';
	}
	
	function get()
	{
	  echo json_encode($this->patternModel->getLatest());
	}
}