<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Controller utilizing mustache templates
 *
 * By extending Controller_Komust, the only action needed by default is
 * to set Controller_Komust::$layout in the controller's action and then
 * call Controller_Komust::render with the partial view's data.
 *
 * @author Pantelis Vratsalis
 * @copyright 2012 Pantelis Vratsalis
 * @licence MIT
 */
class Controller_Komust extends Controller {

	// The instance of Komust, which holds the Mustach_Engine
	protected $komust;

	// The template file or string.
	protected $layout = NULL;
	
	// The extension of templates.
	protected $template_extension = '.mustache';

	/**
	 * Before sets the Komust instance, making it use the filesystem loader by default
	 *
	 * @access public
	 * @return void
	 */
	public function before()
	{
		parent::before();
		$this->komust = Komust::factory('filesystem');
	}
	
	/**
	 * Given a mustache template, it renders it with the data provided
	 * and adds the rendered result to the original data as content. 
	 * Then, it renders the mustache layout with the new data. 
	 * 
	 * @param string $view_file the template/view
	 * @param mixed $data (optional) array or object holding the template data
	 * @param boolean $with_layout (optional) renders layout with rendered view as content
	 * @access public
	 */
	public function render($view_file, $data = NULL, $with_layout = TRUE)
	{
		$data = ($data === NULL) ? array() : $data;

	    // render the view mustache template with the provided data
	    $content = $this->komust->engine()->render($view_file.$this->template_extension, $data);	     
	    
	    // if no layout has been set or $with_layout option is set to FALSE, 
	    // return the rendered view (kind of render partial)
	    if ($with_layout === FALSE OR $this->layout === NULL)
            return $content;
	     	     	    
	    // add the rendered view to the $data array or object
	    if (is_array($data))
	        $data['content'] = $content;
	    else if (is_object($data))
	        $data->content = $content;

	    return $this->komust->engine()->render($this->layout.$this->template_extension, $data);
	}
}