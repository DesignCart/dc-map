<?php

/**
 * @package     Joomla.Site
 * @subpackage  mod_dcmap
 *
 * @copyright   Copyright (C) 2025 Design Cart. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;
if (!isset($moduleData) || !is_array($moduleData)) {
	return;
}

// Dane wejściowe z $params i zabezpieczenie
$useApi   = (int) $params->get('UseAPI', 0);
$apiKey   = htmlspecialchars($params->get('ApiKey'), ENT_QUOTES, 'UTF-8');
$latitude = (float) $Latitude;
$longitude = (float) $Longitude;
$zoom     = (int) $Zoom;
$style    = trim($Style);
$marker   = htmlspecialchars($Marker, ENT_QUOTES, 'UTF-8');
$mapId    = 'map_' . (int) $module->id;
$width    = htmlspecialchars($Width);
$height   = htmlspecialchars($Height);
?>

<?php if ($useApi === 0) : ?>
	<script src="https://maps.googleapis.com/maps/api/js"></script>
<?php else : ?>
	<script src="https://maps.googleapis.com/maps/api/js?key=<?php echo $apiKey; ?>"></script>
<?php endif; ?>

<script>
	document.addEventListener('DOMContentLoaded', function () {
		function initMap() {
			var mapOptions = {
				center: new google.maps.LatLng(<?php echo $latitude; ?>, <?php echo $longitude; ?>),
				zoom: <?php echo $zoom; ?>,
				zoomControl: true,
				disableDoubleClickZoom: true,
				mapTypeControl: false,
				scaleControl: false,
				scrollwheel: false,
				streetViewControl: false,
				draggable: true,
				overviewMapControl: false,
				mapTypeId: google.maps.MapTypeId.ROADMAP,
				styles: <?php echo $style ?: '[]'; ?>
			};

			var mapElement = document.getElementById('<?php echo $mapId; ?>');
			var map = new google.maps.Map(mapElement, mapOptions);

			new google.maps.Marker({
				icon: '<?php echo $marker; ?>',
				position: new google.maps.LatLng(<?php echo $latitude; ?>, <?php echo $longitude; ?>),
				map: map
			});
		}

		initMap();
	});
</script>

<style>
	#<?php echo $mapId; ?> {
		width: <?php echo $width; ?>;
		height: <?php echo $height; ?>;
		opacity: 0.5;
	}
	.gm-style-iw * {
		display: block;
		width: 100%;
	}
	.gm-style-iw h4, .gm-style-iw p {
		margin: 0;
		padding: 0;
	}
	.gm-style-iw a {
		color: #4272db;
	}
</style>

<div id="<?php echo $mapId; ?>"></div>
