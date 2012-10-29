<?php defined('SYSPATH') or die('No direct script access.');

/**
 * A factory for new (view) classes (used as ViewModels) in order
 * to have thinner controllers. template_data in controller actions
 * can be set to an instance of View classes.
 * @author Pantelis Vratsalis
 * @copyright 2012 Pantelis Vratsalis
 * @licence MIT 
 */
abstract class Kohana_View_Komust {
	
	/**
	 * Returns an instance of (view) class. Naming convention is to
	 * prepend View_ to the classes, in order to keep them in classes/View
	 * folder of the application. This can be set to the template data
	 * (when using the Komust Controller), and the properties and methods
	 * of it will be available in the template.
	 *
	 * Example: View_Komust::factory('Welcome/Index') returns
	 *          an instance of View_Welcome_Index class
	 *          (located in View/Welcome/Index.php)
	 *
	 * @param $file the name of the class
	 * @access public
	 * @static
	 * @return class the viewmodel class
	 * @throws Kohana_Exception
	 */
	public static function factory($file)
	{
		$class = 'View_' . strtr($file, '/', '_');

		if (class_exists($class))
		{
			return new $class;
		}
		else
		{
			throw new Kohana_Exception('View model class :class not found', array(
					':class'   => $class,
				));
		}
	}

}