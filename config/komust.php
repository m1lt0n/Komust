<?php defined('SYSPATH') or die('No direct script access.');

return array(
	// uncomment to override the default Mustache_Engine configuration
	'default' => array(
		// The template folder (in case of filesystem loader)
		// 'templates_path' => array(APPPATH.'cache/mustache'),

		// The class prefix for compiled templates
		// 'template_class_prefix' => '__Mustache_',

		// A cache directory for compiled templates.
		// 'cache' => NULL,
		
		// A Mustache template loader instance. Uses a StringLoader
		// 'loader' => '',

		// A Mustache loader instance for partials
		// 'partials_loader' => '',

		// An array of Mustache partials
		// 'partials' => '',

		// An array of 'helpers'. Helpers can be global variables or objects, closures (e.g. for higher order
        // sections), or any other valid Mustache context value. They will be prepended to the context stack
		// 'helpers' => '',

		// An 'escape' callback, responsible for escaping double-mustache variables
		// 'escape' => '',

		// character set for `htmlspecialchars`. Defaults to 'UTF-8'
		// 'charset' => 'UTF-8',
		),
	// Configuration used by Controller_Komust, using FilesystemLoader by default
	'filesystem' => array(
		'loader' => new Mustache_Loader_FilesystemLoader(APPPATH.'templates'),
		'partials_loader' => new Mustache_Loader_FilesystemLoader(APPPATH.'templates/partials'),
		),
);