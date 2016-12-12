<?php namespace nearMe\Lib;

/**
 * Class Request
 *
 * Exposes helper methods for HTTP requests.
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
 * @package nearMe
 * @author Justin Christenson <info@justinc.me>
 * @version 1.0.0
 * @license http://opensource.org/licenses/mit-license.php
 * @link http://nearMe.demos.justinc.me
 *
 */

class Request {

    /**
     * Determine if the request was sent via the XMLHttpRequest object.
     *
     * @return bool
     */
    public function isAjax()
    {
        return (
            (isset($_SERVER['HTTP_X_REQUESTED_WITH'])) &&
            ('xmlhttprequest' === strtolower($_SERVER['HTTP_X_REQUESTED_WITH']))
        );
    }

    /**
     * Check if the request was submitted via POST.
     *
     * @return bool
     */
    public function isPost()
    {
        return ('POST' === $_SERVER['REQUEST_METHOD']);
    }

    /**
     * Check if the request was submitted via GET.
     *
     * @return bool
     */
    public function isGet()
    {
        return ('GET' === $_SERVER['REQUEST_METHOD']);
    }
}
