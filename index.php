<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>UMP Radio</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width">

        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/slider.css">
        <script src="js/vendor/modernizr-2.6.2-respond-1.1.0.min.js"></script>
    </head>
    <body>
        <div class="navbar navbar-inverse navbar-fixed-top">
            <div class="navbar-inner">
                <div class="container">
                    <h1>UMP Radio</h1>
                    <div id="Volume">
                        <section>
                            <i class="icon icon-volume-down pull-left"></i>
                            <div class="slider inline-block"></div>
                            <i class="icon icon-volume-up pull-right"></i>
                        </section>
                    </div>
                </div>
            </div>
        </div>

        <div class="container">

            <ul id="StationList" class="media-list">
            </ul>

        </div> <!-- /container -->

        <script type="text/template" id="StationTpl">
            <li class="media">
            <% if (active == false) { %>
                <a class="station-play pull-left" href="#!/play/<%= stationUrl %>">
                    <button class="btn btn-mini">
                        <i class="icon icon-play"></i>
                    </button>
                </a>
            <% } else { %>
                <a class="station-stop pull-left" href="#!/stop">
                    <button class="btn btn-mini">
                        <i class="icon icon-stop"></i>
                    </button>
                </a>
            <% } %>
                <div class="media-body">
                    <h4 class="media-heading"><%= stationName %></h4>
                </div>
            </li>
        </script>

        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
        <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.9.2/jquery-ui.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/underscore.js/1.4.3/underscore-min.js "></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/json2/20121008/json2.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/backbone.js/0.9.9/backbone-min.js"></script>
        <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.8.3.min.js"><\/script>')</script>
        <script>window.jQuery.ui || document.write('<script src="js/vendor/jquery-ui-1.8.21.custom.min.js"><\/script>')</script>
        <script>window.Backbone || document.write('<script src="js/vendor/backbone.js"><\/script>')</script>
        <script src="js/vendor/bootstrap.min.js"></script>
        <script src="js/jquery.ui.touch-punch.min.js"></script>
        <script src="js/main.js"></script>
    </body>
</html>
