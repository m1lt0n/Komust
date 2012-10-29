<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Controller utilizing mustache templates
 *
 * By extending Controller_Komust, the only action needed by default is
 * to set Controller_Must::$template_data in the controller's action and
 * this will render a template located in templates/ControllerName/actionName.mustache,
 * which is aware of these data.
 *
 * @author Pantelis Vratsalis
 * @copyright 2012 Pantelis Vratsalis
 * @licence MIT
 */
class Controller_Komust extends Controller {

	// The instance of Komust, which holds the Mustach_Engine
	protected $komust;

	// The template file or string. When not set, the controller will look
	// in templates/ControllerName/actionName.mustache for a template
	protected $template = NULL;

	// The template data. They can be either an associative array or
	// an object
	protected $template_data = array();

	// By default, without any more code needed, the template is rendered
	// and populates the response body
	protected $auto_output = TRUE;

	// The default template extension, can be overriden
	protected $template_ext = '.mustache';

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
	 * After checks if auto_output is ON (default behaviour) and if so,
	 * checks if a template has been set, otherwise it tries to load following
	 * the naming convention templates/ControllerName/actionName.extension.
	 *
	 * @access public
	 * @return void
	 */
	public function after()
	{
		if ($this->auto_output)
		{
			if ($this->template === NULL AND ($this->komust->engine()->getLoader() instanceof Mustache_Loader_FilesystemLoader))
			{
				$this->template = $this->request->controller() . '/' . $this->request->action() . $this->template_ext;
			}

			$this->response->body($this->komust->engine()->render($this->template, $this->template_data));			
		}

		parent::after();
	}

}