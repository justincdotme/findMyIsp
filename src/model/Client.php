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

    public function __construct()
    {
        $this->getIpInfo();
    }

    /**
     * Get the ISP attribute from the ipInfo session object.
     *
     * @return mixed|string
     */
    public function getIsp()
    {
        return isset($_SESSION['ipInfo']->org) ? preg_replace('/(^[^\s]*)(\s)/', '', $_SESSION['ipInfo']->org) : 'Not Found';
    }

    /**
     * Get the location attribute from the ipInfo session object.
     *
     * @return null
     */
    public function getLocation()
    {
        return isset($_SESSION['ipInfo']->loc) ? $_SESSION['ipInfo']->loc : null;
    }

    /**
     * Set the location attribute on the ipInfo session object.
     *
     * @param $location
     */
    public function setLocation($location)
    {
       return $_SESSION['ipInfo']->loc = $location;
    }

    /**
     * Get the client's IP address.
     *
     * @return string
     */
    public function getIp()
    {
        return isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : 'Unknown';
    }

    /**
     * Get the user's Geolocation info.
     * Uses the ipinfo.io API [http://ipinfo.io]
     * This method gets the initial ISP information for the user.
     * This method also serves as a fallback for browsers lacking HTML5 Geolocation support.
     *
     * @return bool
     */
    public function getIpInfo()
    {
        $url = "http://ipinfo.io/" . $this->getIp() . "/json";
        return $_SESSION['ipInfo'] = $this->doCurl($url);
    }
}