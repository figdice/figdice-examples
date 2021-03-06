<?php
/**
 * @author Gabriel Zerbib <gabriel@figdice.org>
 * @copyright 2004-2014, Gabriel Zerbib.
 * @version 2.0.3
 * @package FigDice
 *
 * This file is part of FigDice.
 */


/**
 * In this example we will learn to:
 *
 * - work with macros
 */


// Autoload the Figdice lib
require_once __DIR__.'/../vendor/autoload.php';

use figdice\View;

$view = new View();

// The template we are studying now, uses the Macro tool.
// A Macro is similar to a Function in PHP: it has a name,
// and accepts parameters.
// However it does not "return" a value: rather, it produces
// in-place output, at the location where it is invoked.

$view->loadFile(__DIR__.'/template.xml');

// We have learned, in example 4, how to use Feeds as data providers
// for our View. In this example we will get back to mounting direct
// data from our Controller into our View, for the sake of simplicity.
// But you know now that it is not the smartest way to go, in the
// FigDice paradigm.

// So let's mount some structured data.
$view->mount('countries', array(
    'France' => array(
        'capital' => 'Paris',
        'wiki' => 'http://en.wikipedia.org/wiki/France'
    ),
    'Germany' => array(
        'capital' => 'Berlin',
        'wiki' => 'http://en.wikipedia.org/wiki/Germany'
    )
));

$output = $view->render();


echo $output;
