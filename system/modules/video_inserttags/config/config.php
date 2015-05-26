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
 * Register hooks
 */
$GLOBALS['TL_HOOKS']['replaceInsertTags'][] = array('numero2\VideoInsertTags\VideoInsertTags', 'replaceInsertTags');