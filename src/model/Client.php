<?php namespace findMyIsp\model;

use findMyIsp\lib\Model;

/**
 * Class Client
 *
 * The Client class model contains methods for retrieving a clients IP and geographic location.
 *
 * The initial user location and ISP information in this model is retrieved from the free, public IpInfo API <http://ipinfo.io>.
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

class Client extends Model {

    public function __construct($params)
    {
        if($params)
        {
            foreach($params as $key => $value)
            {
                $this->$key = $value;
            }
        }
    }

    /**
     * Get the ISP attribute.
     *
     * @return mixed|string
     */
    public function getIsp()
    {
        return isset($this->org) ? $this->org : null;
    }

    /**
     * Get the location attribute.
     *
     * @return mixed|string
     */
    public function getLocation()
    {
        return isset($this->loc) ? $this->loc : null;
    }

    /**
     * Set the location attribute.
     *
     * @param $location
     */
    public function setLocation($location)
    {
       return $this->loc = $location;
    }

    /**
     * Get the client's IP address.
     *
     * @return string
     */
    public function getIp()
    {
        return isset($this->ip) ? $this->ip : 'Unknown';
    }
}