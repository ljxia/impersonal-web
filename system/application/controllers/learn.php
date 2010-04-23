<?php
class Learn extends Controller {

	function index()
	{
		echo 'Impersonal';
	}
	
	function interpolation()
	{
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
	
	function inspiration()
	{
	  echo $this->inspirationModel->insert_entry($_POST);
	}
}