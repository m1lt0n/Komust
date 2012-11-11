Komust
======

Komust is a module for [Kohana](http://github.com/kohana/), that integrates [Mustache](http://mustache.github.com) templates (using [mustache.php](http://github.com/bobthecow/mustache.php) implementation.

Examples
--------

There are 2 ways to use Komust:

Instead of extending the default Kohana Controller, extend Controller_Komust.

```php
<?php
class Controller_Welcome extends Controller_Komust {
	public function action_index()
	{
		$this->layout = 'main';
		$this->response->body($this->render('welcome/index',array('name' => 'World')));
	}
}
```

The render method in Controller_Komust, renders welcome/index with the provided data and adds the result back to the data as property/array element "content", so the rendered view can be accessed by the layout template by {{{content}}}.

Now, the only thing remaining is to create the layout and the actual view templates. Layout template (layout.mustache) could be something like:

```html+jinja
<!DOCTYPE html>
<html>
	<head>
	</head>
	<body>
		{{{content}}}
	</body>
</html>
```

And welcome/index(.mustache) could look like:
```html+jinja
<div>
	Hello {{name}}
</div>
```

That's it! Of course, in real world it is more efficient and the controller code is more readable if you use ViewModels. Let's refactor our code to do so:

```php
<?php
class Controller_Welcome extends Controller_Komust {
	public function action_index()
	{
		$this->layout = 'main';
		$this->response->body($this->render('welcome/index', View_Komust::factory('Welcome/Index')));
	}
}
```

Now, we can add the data we need to be available in our template in the View_Komust class. Let's see the class' contents:

```php
<?php
class View_Welcome_Index {
	public $name = 'World';
}
```

Our template remains the same, so no changes are needed there. That's it! The good thing about ViewModels is that you can add methods which are also available in your templates!

The second approach one may choose is to create a regular controller and render a template (without all the automagic) by using the render method of the Mustache_Engine:

```php
<?php
class Controller_Welcome extends Controller {
	public function action_index()
	{
		$mustache = Komust::factory()->engine();
		$this->response->body($mustache->render('{{message}}',array('message' => 'Hello World!')));
	}
}
```

The default factory call uses the default settings of Mustache_Engine (string loader), but you can customize that to use filesystem loader which can accomodate more complex needs. The factory method accepts a $config parameter, either an array (which holds the configuration settings) or a string, which is the config group of the komust.php config file (you can add your own configurations there). If $config is not provided, a Mustache_Engine instance with the default settings is created.


