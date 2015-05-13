<?php namespace findMyIsp\model;

use findMyIsp\lib\Model;

/**
 * Class Isp
 *
 * The ISP class model contains methods for retrieving ISP data.
 *
 * All ISP data in this model is retrieved via the Google Maps Web Service API and Google Places Web Service API.
 * This class was created as part of an experimental project to show consumers the available ISPs in their geographic area.
 *
 * PHP Version 5.6
 *
 * License: Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 *
 * @package findMyIsp
 * @author Justin Christenson <info@justinc.me>
 * @version 1.0.0
 * @license http://opensource.org/licenses/mit-license.php
 * @link http://findmyisp.demos.justinc.me
 *
 */

class Isp extends Model {

    protected $_location;

    public function __construct($location)
    {
        $this->_location = $location;
    }

    /**
     * Repackage the Full ISP list.
     * Return only required attributes for each location.
     *
     * @return array
     */
    public function getIspList()
    {
        $bigList = $this->getFullIspList();
        $shortList = [];
        foreach($bigList as $isp)
        {
            $isp = [
                'name' => isset($isp->name) ? $isp->name : null,
                'website' => isset($isp->website) ? $isp->website : null,
                'phone' => isset($isp->formatted_phone_number) ? $isp->formatted_phone_number : null,
                'html_address' => isset($isp->adr_address) ? str_replace(',', '<br />', $isp->adr_address) : null
            ];
            array_push($shortList, json_decode(json_encode($isp)));
        }
        return $shortList;
    }

    /**
     * Return a JSON encoded list of nearby ISP's.
     *
     * @return string
     */
    public function getIspJsonList()
    {
        return json_encode($this->getIspList());
    }

    /**
     * Get the details for each of the top nearby ISPs.
     * This method uses the Google Places API Web Service.
     * [https://developers.google.com/places/webservice/details]
     *
     * @return array
     */
    protected function getFullIspList()
    {
        $apiKey = PLACES_API_KEY;
        $placeIds = $this->getPlaceIds();
        $ispList = [];
        foreach($placeIds as $placeId)
        {
            $referenceUrl = "https://maps.googleapis.com/maps/api/place/details/json?placeid=$placeId&key=$apiKey";
            $results = $this->doCurl($referenceUrl);
            array_push($ispList, $results->result);
        }
        return $ispList;
    }

    /**
     * Get a list of ISP's in the user's geographic area.
     * This uses the Google Places API Web Service's Nearby Search feature.
     * [https://developers.google.com/places/webservice/search#PlaceSearchRequests]
     *
     * @return bool
     */
    protected function _getNearbyIspList()
    {
        $apiKey = PLACES_API_KEY;
        $keyWords = 'internet+service+provider';
        $radius = '50000';
        $placesUrl = "https://maps.googleapis.com/maps/api/place/nearbysearch/json?location=$this->_location&radius=$radius&keyword=$keyWords&rankby=prominence&key=$apiKey";
        $ispList = $this->doCurl($placesUrl);
        return $ispList->results;
    }

    /**
     * Get the "Place ID" for each location.
     * Limit the number of references to ISP_LIST_COUNT.
     * [https://developers.google.com/places/webservice/details]
     *
     * @return array
     */
    public function getPlaceIds()
    {
        $i = 0;
        $references = [];
        foreach($this->_getNearbyIspList() as $result)
        {
            array_push($references, $result->place_id);
            if(++$i == ISP_LIST_COUNT)
            {
                break;
            }
        }
        return $references;
    }
}