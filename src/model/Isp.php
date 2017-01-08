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
 * @link http://findmyisp.justinc.me
 *
 */

class Isp extends Model {

    public function __construct($params)
    {
        foreach($params as $key => $value)
        {
            $this->$key = $value;
        }
    }

    /**
     * Get the ispList attribute.
     *
     * @return array
     */
    public function getIspList()
    {
        return isset($this->ispList) ? $this->ispList : null;
    }

    /**
     * Return the ispList attribute (array) as an stdClass object.
     *
     * @return string
     */
    public function getIspJsonList()
    {
        return isset($this->ispList) ? json_encode($this->ispList) : null;
    }
}