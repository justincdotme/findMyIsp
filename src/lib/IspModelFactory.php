<?php namespace findMyIsp\lib;

use findMyIsp\model\Isp;

class IspModelFactory {

    protected $_curl;
    protected $_location;

    public function __construct(DataAccessInterface $curl, $location)
    {
        $this->_curl = $curl;
        $this->_location = $location;
    }

    /**
     * Create a new model.
     *
     * @return mixed
     */
    public function make()
    {
        $data = [
            'ispList' => $this->getIspList()
        ];
        return new Isp($data);
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
            $curlParams = [
                CURLOPT_URL => $referenceUrl,
                CURLOPT_RETURNTRANSFER => 1,
                CURLOPT_HEADER => 0
            ];
            $results = $this->_curl->getData($curlParams);
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
    protected function getNearbyIspList()
    {
        $apiKey = PLACES_API_KEY;
        $keyWords = 'internet+service+provider';
        $radius = '50000';
        $placesUrl = "https://maps.googleapis.com/maps/api/place/nearbysearch/json?location=$this->_location&radius=$radius&keyword=$keyWords&rankby=prominence&key=$apiKey";
        $curlParams = [
            CURLOPT_URL => $placesUrl,
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_HEADER => 0
        ];
        $ispList = $this->_curl->getData($curlParams);
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
        foreach($this->getNearbyIspList() as $result)
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