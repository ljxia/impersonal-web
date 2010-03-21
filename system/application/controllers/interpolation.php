<?php
class Interpolation extends Controller {

	function index()
	{
		echo 'index';
	}
	
	function get()
	{
    echo json_encode($this->lineInterpolation->get($_POST));
	}
}