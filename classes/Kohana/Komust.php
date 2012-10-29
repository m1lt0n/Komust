<?php defined('SYSPATH') or die('No direct script access.');

/**
 * The factory that holds the Mustache_Engine as its property.
 *
 * The default factory creates an engine with the default configuration
 * of Mustache, otherwise it can be overriden either by a $config array,
 * or by a config strings that corresponds to a config file group.
 * @author Pantelis Vratsalis
 * @copyright 2012 Pantelis Vratsalis
 * @licence MIT
 */
abstract class Kohana_Komust {
	
	// Holds the name of the default config group	
	const DEFAULT_CONFIG_GROUP = 'default';

	// Holds the Mustache_Engine instance
	protected $engine;

	/**
	 * The constructor sets engine to an instance of Mustache_Engine.
	 * It is better to use the factory method, as it allows $config to be
	 * a config group.
	 *
	 * @access public
	 */
	public function __construct($config)
	{
		$this->engine = new Mustache_Engine($config);
	}

	/**
	 * The factory creates an instance based on the configuration provided or
	 * on the default config group of the config file.
	 *
	 * @param $config mixed string or array containing config group or actual configuration
	 * @access public
	 * @static
	 * @return Komust instance
	 */
	public static function factory($config = NULL)
	{
		if ($config === NULL)
		{
			$config_group = self::DEFAULT_CONFIG_GROUP;
		}
		elseif (!is_array($config))
		{
			$config_group = $config;
		}

		$config = isset($config_group) ? Kohana::$config->load('komust')->get($config_group) : $config;
		return new Komust($config);
	}

	/**
	 * Returns the Mustache_Engine instance that was created by factory method
	 * 
	 * @access public
	 * @return Mustache_Engine instance
	 */
	public function engine()
	{
		return $this->engine;
	}

}