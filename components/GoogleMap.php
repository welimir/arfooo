<?php
/**
 * Arfooo
 *
 * @package    Arfooo
 * @copyright  Copyright (c) Arfooo Annuaire (fr) and Arfooo Directory (en)
 *             by Guillaume Hocine (c) 2007 - 2010
 *             http://www.arfooo.com/ (fr) and http://www.arfooo.net/ (en)
 * @author     Guillaume Hocine & Adrian Galewski
 * @license    http://creativecommons.org/licenses/by/2.0/fr/ Creative Commons
 */


class GoogleMap
{
    const API_URL = 'http://maps.google.com/maps/api/js';
    const GEO_URL = 'http://maps.google.com/maps/geo';

    private $_points = array();
    private $_zoomLevel;

    public function setZoomLevel($zoomLevel)
    {
        $this->_zoomLevel = $zoomLevel;
    }

    public function addGeoPoint($lat, $lng, $description = '')
    {
        $point = array(
            'lat'         => $lat,
            'lng'         => $lng,
            'address'     => '',
            'description' => $description
        );

        array_push($this->_points, $point);
    }

    public function addAddress($address, $description = '')
    {
        $url = self::GEO_URL . '?&output=json&q=' . urlencode($address);

        if (@ini_get('allow_url_fopen')) {
            $buff = @file_get_contents($url);
        } else {
            $httpClient = new HttpClient();
            $buff = $httpClient->getSiteContent($url, false);
        }

        $response = json_decode(utf8_encode($buff), true);

        if (empty($response['Status']['code'])) {
            throw new Google_Map_ServiceException('Invalid status code');
        }

        if (empty($response['Placemark'][0]['Point']['coordinates'])) {
            throw new Google_Map_AddressNotFoundException('Point can NOT be found');
        }

        $coords = $response['Placemark'][0]['Point']['coordinates'];

        $point = array(
            'lat'         => $coords[1],
            'lng'         => $coords[0],
            'address'     => $address,
            'description' => $description
        );

        array_push($this->_points, $point);
        return array(
            'lat' => $coords[1],
            'lng' => $coords[0]
        );
    }

    public function getScriptCode()
    {
        return "\n<script src=\"" . self::API_URL. "?sensor=false\" type=\"text/javascript\"></script>\n";
    }

    public function getMapCode()
    {
        $html = "<script type=\"text/javascript\">\n
        function showGoogleMap()
        {
        //<![CDATA[

        var myOptions = {
            zoom: " . $this->_zoomLevel . ",
            center: new google.maps.LatLng(" . $this->_points[0]['lat'] . ", " . $this->_points[0]['lng'] . "),
            mapTypeId: google.maps.MapTypeId.ROADMAP
        };
        var map = new google.maps.Map(document.getElementById(\"map\"), myOptions);
        ";

        $i = 0;

        foreach ($this->_points as $point) {
            $i++;

            $infoText = ($point['description']) ? $point['description'] : $point['address'];

            $html .= "
            var point{$i} = new google.maps.LatLng({$point['lat']}, {$point['lng']});
            var marker{$i} = new google.maps.Marker({position: point{$i}, title: \"{$infoText}\"});
            marker{$i}.setMap(map);
            ";
        }

        $html .= "//]]>
        }
        \$(window).load(showGoogleMap);
        </script>
        ";

        return $html;
    }

    public function getUserSideMapCode($address, $description = "")
    {
        $point = array("address" => $address, "description" => $description);
        $infoText = ($point['description']) ? $point['description'] : $point['address'];

        $this->_points = array($point);

        $html = "<script type=\"text/javascript\">\n
        function showGoogleMap()
        {
            var myOptions = {
                zoom: " . $this->_zoomLevel . ",
                mapTypeId: google.maps.MapTypeId.ROADMAP
            };
            var map = new google.maps.Map(document.getElementById(\"map\"), myOptions);
            var geocoder = new google.maps.Geocoder();
        ";

        $i = 0;

        foreach ($this->_points as $point) {
            $i++;

            $address = addslashes($point['address']);
            $html .= "
            geocoder.geocode(
                {
                    'address': \"{$address}\"
                },
                function(results, status)
                {
                    if (status == google.maps.GeocoderStatus.OK) {
                        map.setCenter(results[0].geometry.location);
                        var marker = new google.maps.Marker(
                            {
                                map: map,
                                position: results[0].geometry.location,
                                title: \"{$infoText}\"
                            }
                        );
                    }
                }
            );
            ";
        }

        $html .= "
        }
        \$(window).load(showGoogleMap);
        </script>
        ";

        return $html;
    }

}

class Google_Map_ServiceException extends Exception{}
class Google_Map_AddressNotFoundException extends Exception{}
