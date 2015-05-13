# FindMyISP
 An application for determining a user's current ISP and displaying other ISPs in their area.
 The application uses either the HTML5 Geolocation API or the less accurate IpInfo API to determine the users location. 
 After the location is determined, the application will display a list of ISPs in the user's geographic area using the Google Maps and Google Places APIs.

 **View Demo**
 [http://findmyisp.demos.justinc.me](http://findmyisp.demos.justinc.me)


## Requirements
 - Use of this application requires a Google Places Web Services API key which can be obtained through the [Google Developers Console](https://developers.google.com)
 - This application requires Composer, located at [getcomposer.org](https://getcomposer.org/)

## Installation

 Clone the repository, then install dependencies using Composer.
 
    git clone https://github.com/justincdotme/findmyisp.git

    composer install
    
        

## Credits

 - The IP Info API Dev Team for an excellent and free [IP lookup API](http://ipinfo.io/).

## License

 The MIT License (MIT)
 
 Copyright (c) 2015 Justin Christenson
 
 Permission is hereby granted, free of charge, to any person obtaining a copy
 of this software and associated documentation files (the "Software"), to deal
 in the Software without restriction, including without limitation the rights
 to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 copies of the Software, and to permit persons to whom the Software is
 furnished to do so, subject to the following conditions:
 
 The above copyright notice and this permission notice shall be included in
 all copies or substantial portions of the Software.
 
 THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 THE SOFTWARE.