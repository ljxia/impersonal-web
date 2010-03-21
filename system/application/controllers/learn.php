<?php
class Learn extends Controller {

	function index()
	{
		echo 'Hello World!';
	}
	
	function interpolation()
	{
	  echo "Page OK\r\n";

    echo count($_POST)." POST params\r\n";
    echo json_encode($_POST)."\r\n";
    
    // echo "\r\n";
    // 
    // echo count($_GET)." GET params\r\n";
    // echo json_encode($this->input->get());
    echo $this->lineInterpolation->insert_entry($_POST);
	}
}