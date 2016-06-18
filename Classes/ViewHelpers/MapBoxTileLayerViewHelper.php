<?php
namespace Eike\Ride\ViewHelpers;

use TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper;
class MapBoxTileLayerViewHelper extends AbstractViewHelper {
  
    /**
     * 
     * @param string $id
     * @param string $accesssToken
     * @param integer $maxZoom
     * @param string $attribution
     */
    public function render($id, $accesssToken, $maxZoom = 16, $attribution = "") {
        $result = "
              L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token={accessToken}', {
	     	  attribution: '$attribution',
	     	  maxZoom: $maxZoom,
	     	  id: '$id',
	     	  accessToken: '$accesssToken'
	     	}).addTo(map);
            ";
        return $result;
    }
}
?>