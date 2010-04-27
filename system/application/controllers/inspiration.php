<?php
class Inspiration extends Controller {

	function index()
	{
		echo 'inspiration';
	}
	
	function download($id)
	{
	  $this->load->helper('download');
	  $data = file_get_contents("./uploads/inspiration/ins_$id.jpeg",FILE_USE_INCLUDE_PATH); // Read the file's contents
    $name = "ins_$id.jpeg";

    force_download($name, $data);
	}
}