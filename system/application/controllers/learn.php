<?php
class Learn extends Controller {

	function index()
	{
		echo 'Impersonal';
	}
	
	function interpolation()
	{
    // echo "Page OK\r\n";
    // 
    //     echo count($_POST)." POST params\r\n";
    //     echo json_encode($_POST)."\r\n";
    
    // echo "\r\n";
    // 
    // echo count($_GET)." GET params\r\n";
    // echo json_encode($this->input->get());
    echo $this->interpolationModel->insert_entry($_POST);
	}
	
	function pattern()
	{
	  echo $this->patternModel->insert_entry($_POST);
	}
	
	function stroke()
	{
	  echo $this->strokeModel->insert_entry($_POST);
	}
	
	function structure()
	{
	  echo $this->structureModel->insert_entry($_POST);
	}
}