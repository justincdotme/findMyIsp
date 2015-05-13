        <?php include 'includes/header.php'; ?>
        <div class="row">
            <div class="col-sm-12">
                <div class="jumbotron">
                    <h1>Find My ISP</h1>
                        <h3>Your IP Address is: <span class="label label-info"><?php echo $data['clientIp']; ?></span></h3>
                        <h3>Your ISP is: <span class="label label-info"><?php echo $data['clientIsp']; ?></span></h3>
                    <hr />
                    <p class="instructions">
                        Click below to view alternative ISP's in your area.
                    </p>
                    <form id="show-isp-list" method="POST" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>">
                        <input class="btn btn-primary btn-lg" type="submit" value="Show List">
                    </form>
                </div>
            </div>
        </div>
        <!--ISP list container-->
        <div class="row" id="isp-list">

        </div>
        <!--End ISP list container-->
        <?php include 'includes/footer.php'; ?>
        <!--Begin Handlebars template-->
        <script id="isp-list-template" type="text/x-handlebars-template">
            {{#isps}}
                <div class="col-sm-6 isp-info">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h1><a href="{{website}}">{{name}}</a></h1>
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-sm-12">
                                    <p>
                                        <strong>Phone: </strong>{{phone}}
                                    </p>

                                    <p>
                                        <strong>Website: </strong><a href="{{website}}">{{website}}</a>
                                    </p>
                                    <p>
                                        {{{html_address}}}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            {{/isps}}
        </script>
        <!--End Handlebars template-->
        <script>
            var findMyIsp = window.findMyIsp || {};

            findMyIsp.findForm = $('form#show-isp-list');

            /**
             * Hide "Show List" button.
             * Render the ISP search results.
             * Change the instructions text paragraph.
             */
            findMyIsp.showResults = function()
            {
                findMyIsp.findForm.slideUp();
                var instructions = $('p.instructions');

                instructions.fadeOut('fast', function()
                {
                    $(this).text('Here is a list of ISPs in your area.').fadeIn('fast', function()
                    {
                        if(findMyIsp.ispList.length > 0)
                        {
                            findMyIsp.renderList();
                        } else {
                            instructions.after('<h3 class="alert alert-danger none-found">No ISPs found!</h3>');
                        }
                    });
                });
            };

            /**
             * Handle the form submission.
             */
            findMyIsp.findForm.submit(function(e)
            {
                $(this).find('input[type="submit"]').val('Searching...');

                $.post("<?php echo htmlentities($_SERVER['PHP_SELF']); ?>", {
                    "location": findMyIsp.latLong
                }, function(list)
                {
                    findMyIsp.ispList = list;
                    findMyIsp.showResults();
                });

                e.preventDefault();
                return false;
            });

            /**
             * Check for Geolocation support.
             */
            findMyIsp.hasGeoLocation = function()
            {
                return 'geolocation' in navigator;
            };

            /**
             * Set the location in a var.
             * This var will be sent in the outgoing POST data.
             */
            findMyIsp.handleGeolocation = function(position){
                findMyIsp.latLong = position.coords.latitude + ',' + position.coords.longitude;
            };

            /**
             * Obtain the client's location.
             */
            findMyIsp.doGeolocation = function() {
                navigator.geolocation.getCurrentPosition(findMyIsp.handleGeolocation);
            };

            //Check if client supports GeoLocation
            if(findMyIsp.hasGeoLocation())
            {
                findMyIsp.doGeolocation();
            }

            /**
             * Render the ISP list using Handlebars.js
             */
            findMyIsp.renderList = function()
            {
                var view = $('#isp-list-template').html();
                var template = Handlebars.compile(view);
                var json = {isps: findMyIsp.ispList};
                var html = template(json);
                var listContainer = $("#isp-list");
                listContainer.empty();
                listContainer.append(html);
            };
        </script>
    </body>
</html>