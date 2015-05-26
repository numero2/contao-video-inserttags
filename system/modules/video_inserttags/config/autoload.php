<?php

/**
 * Contao Open Source CMS
 *
 * Copyright (c) 2005-2015 Leo Feyer
 *
 * @package   video_inserttags
 * @author    numero2 - Agentur für Internetdienstleistungen
 * @license   LGPL
 * @copyright 2015
 */


/**
 * Register the namespaces
 */
ClassLoader::addNamespaces(array
(
    'numero2\VideoInsertTags',
));


/**
 * Register the classes
 */
ClassLoader::addClasses(array
(
	// Classes
	'numero2\VideoInsertTags\VideoInsertTags' => 'system/modules/video_inserttags/classes/VideoInsertTags.php',
));