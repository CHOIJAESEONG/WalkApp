<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Router extends CI_Router
{
	/**
    * Constructor
    *
    * Runs the route mapping function.
    */
    function __construct()
    {
	    parent::__construct();
    }
    // --------------------------------------------------------------------

    /**
     * Validates the supplied segments.  Attempts to determine the path to
     * the controller.
     *
     * @access    private
     * @param    array
     * @return    array
     */

    function _validate_request($segments)
   	{
   		if (count($segments) == 0){
   			return $segments;
   		}

	   	// Does the requested controller exist in the root folder?
	   	if (file_exists(APPPATH.'controllers/'.$segments[0].EXT)){
	   			return $segments;
	   	}

	   	// Is the controller in a sub-folder?
	   	if (is_dir(APPPATH.'controllers/'.$segments[0])){
	   		// Set the directory and remove it from the segment array

		   	$this->set_directory($segments[0]);
		   	$segments = array_slice($segments, 1);
            /*
             * Updated for codefight cms
             * Added new code to allow multi-level sub-folder
             */

            $subfolder = false;
            if (((count($segments) > 0) && is_dir(APPPATH . 'controllers/' . $this->directory . $segments[0])) && (!file_exists(APPPATH . 'controllers/' . $this->directory . $segments[0] . EXT))) $subfolder = true;

            while ($subfolder){
                if (!isset($segments[0])) break;
                //Set the directory and remove it from the segment array
                $this->set_directory($this->directory . $segments[0]);
                $segments = array_slice($segments, 1);
                // Does the requested controller exist in the root folder?
                if ((count($segments) > 0) && file_exists(APPPATH . 'controllers/' . $this->directory . $segments[0] . EXT)) {
                    $subfolder = false;
                }
            }
            /*---END--Sub-folder--*/
		   	if (count($segments) > 0){
			   	// Does the requested controller exist in the sub-folder?
			   	if ( ! file_exists(APPPATH.'controllers/'.$this->fetch_directory().$segments[0].EXT)){
				   	show_404($this->fetch_directory().$segments[0]);
			   	}
	   		}else{
			   	// Is the method being specified in the route?
			   	if (strpos($this->default_controller, '/') !== FALSE){
				   	$x = explode('/', $this->default_controller);
				   	$this->set_class($x[0]);
				   	$this->set_method($x[1]);
			   	}else{
				   	$this->set_class($this->default_controller);
				   	$this->set_method('index');
			   	}
			   	// Does the default controller exist in the sub-folder?
			   	if ( ! file_exists(APPPATH.'controllers/'.$this->fetch_directory().$this->default_controller.EXT)){
				   	$this->directory = '';
				   	return array();
			   	}
		   	}
   			return $segments;
   		}
	   	// If we've gotten this far it means that the URI does not correlate to a valid
	   	// controller class.  We will now see if there is an override
	   	if ( ! empty($this->routes['404_override'])){
		   	$x = explode('/', $this->routes['404_override']);
		   	$this->set_class($x[0]);
		   	$this->set_method(isset($x[1]) ? $x[1] : 'index');
		   	return $x;
	   	}
	   	// Nothing else to do at this point but show a 404
	   	show_404($segments[0]);
   	}
    // --------------------------------------------------------------------
    /**
     *  Set the directory name
     *
     * @access    public
     * @param    string
     * @return    void
     */
    function set_directory($dir)
    {
        $this->directory = trim($dir, '/') . '/';
    }
    // --------------------------------------------------------------------
}
// END MY_Router Class