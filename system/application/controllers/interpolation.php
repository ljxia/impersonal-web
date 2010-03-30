<?php
class Interpolation extends Controller {

	function index()
	{
		echo 'interpolation';
	}
	
	function get()
	{
	  extract($_POST);
	  if (isset($vector) && isset($orientation) && isset($length))
	  {
	    $vector = str_replace(array('x','y','z'),array('"x"','"y"','"z"'),$vector);
	    $vector = json_decode($vector);
	    
	    //echo var_dump(json_decode($vector));
	    echo json_encode($this->lineInterpolation->get($vector, $orientation, $length));
	  }
    else
    {
      echo '{"message": "invalid param"}';
    }
	}
}