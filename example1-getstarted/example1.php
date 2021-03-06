<?php
/**
 * @author Gabriel Zerbib <gabriel@figdice.org> https://github.com/figdice/
 * @package FigDice
 */


/**
 * In this example we will learn to:
 *
 * - get started with the library
 * - load a template by its outer container file (This is not the recommended FigDice way!)
 * - push some data into the template
 * - pass objects to templates
 * - control the textual content of tags
 * - inline dynamic data into HTML attributes
 * - embed unparsed content
 */


// Autoload the Figdice lib
require_once __DIR__.'/../vendor/autoload.php';

// Create a Fig View object
$view = new \figdice\View();

// Load its main template file:
try {
	$view->loadFile(__DIR__.'/template-main.xml');
} catch (\figdice\exceptions\FileNotFoundException $ex) {
	die('template file not found');
}

// Mount some data into our View
//  these values will become available form within the template
//  as: /document/title
//      /document/css/textColor
// NB : THIS IS NOT the "FigDice" way for pushing data into a template.
//      The "mount" method is only given for those coming from the Twig-like template engines
//      (i.e. virtually any other engine except FigDice),
//      where the controller is expected to push the data to be displayed.
//      In FigDice, as you will learn in Example 4 (Feeds), the best practice pattern is to
//      supply for the View a set of Feed classes, which the template is free to pull (or not)
//      according to its own layout design.
//      But let's use the direct "mount" for now.
$view->mount('document', array(
	'title' => 'My first FigDice exercise',
	'css' => array(
		'textColor' => '#dd22aa'
	)
));

// Mount some more data into our View.
//  They could come from a database, for example.
//  NB:  You can mount Objects! provided that the properties you want to
//  expose, have a getter method (or are public).
class MyUser {
  // This public property is accessible from your template
  public $firstname;
  // This private property is automatically made accessible by the getTitle method.
  private $title;
  public function __construct($title, $firstname) {
    $this->title = $title;
    $this->firstname = $firstname;
  }
  public function getTitle() {
    return $this->title;
  }
}

$view->mount('userDetails', new MyUser('Mr', 'Gabriel') );


// Render the template!
try {
	$output = $view->render();
} catch (\figdice\exceptions\FileNotFoundException $ex) {
	die('some include went wrong at rendering-time: ' . PHP_EOL . $ex->getMessage());
}

echo $output;
// Typically to the browser, or into a file for caching purposes, etc.

