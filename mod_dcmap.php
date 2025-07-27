<?php

/**
 * @package     Joomla.Site
 * @subpackage  mod_dcmap
 *
 * @copyright   Copyright (C) 2025 Design Cart. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
**/

defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\Uri\Uri;
use Joomla\CMS\Helper\ModuleHelper;

require_once __DIR__ . '/helper.php';

$Marker     = Uri::root() . $params->get('Marker');
$Zoom       = $params->get('Zoom');
$Latitude   = $params->get('Latitude');
$Longitude  = $params->get('Longitude');
$Height     = $params->get('Height');
$Width      = $params->get('Width');
$Style      = $params->get('Style');

$moduleData = compact('Latitude', 'Longitude', 'Zoom', 'Style', 'Marker', 'Width', 'Height');

require ModuleHelper::getLayoutPath('mod_dcmap', $params->get('layout', 'default'));
