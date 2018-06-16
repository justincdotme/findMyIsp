<?php namespace findMyIsp\lib;

/**
 * Class Request
 *
 * Provides helper methods for HTTP requests.
 *
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

class Request {

    /**
     * Determine if the request was sent via the XMLHttpRequest (JavaScript) object.
     *
     * @return bool
     */
    public function isAjax()
    {
        if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest')
        {
            return true;
        }
        return false;
    }

    /**
     * Check if the request was submitted via POST.
     *
     * @return bool
     */
    public function isPost()
    {
        return $_SERVER['REQUEST_METHOD'] === 'POST';
    }

    /**
     * Check if the request was submitted via GET.
     *
     * @return bool
     */
    public function isGet()
    {
        return $_SERVER['REQUEST_METHOD'] === 'GET';
    }

    /**
     * Attempt to get the real IP address of the client.
     *
     * @return mixed
     */
    public function getClientIp()
    {
        if (isset($_SERVER["HTTP_CF_CONNECTING_IP"])) { //Cloudflare
            $clientIp = $this->sanitizeIp($_SERVER["HTTP_CF_CONNECTING_IP"]);
        } else if (isset($_SERVER['HTTP_CLIENT_IP'])) {
            $clientIp = $this->sanitizeIp($_SERVER["HTTP_CLIENT_IP"]);
        } else if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $clientIp = $this->sanitizeIp($_SERVER["HTTP_X_FORWARDED_FOR"]);
        } else {
            $clientIp = $this->sanitizeIp($_SERVER['REMOTE_ADDR']);
        }

        return (!$clientIp) ? null : $clientIp;
    }

    /**
     * Sanitize and validate the IP address.
     *
     * @param $ipAddress
     * @return mixed
     */
    protected function sanitizeIp($ipAddress)
    {
        return filter_var($ipAddress, FILTER_VALIDATE_IP);
    }
}
