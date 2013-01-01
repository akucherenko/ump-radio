$(function() {

    //Store frequently elements in variables
    var slider  = $('.slider');

    //Call the Slider
    slider.slider({
        //Config
        range: "min",
        min: 0,
        max: 10,
        step: 1,
        value: 4,

        //Slider Event
        change: function(event, ui) { //When the slider is sliding

            var value  = ui.value;

            Models.volume.change(value);

        },

        stop: function () {
            slider.slider('value')
        }

    });

    var Volume = Backbone.Model.extend({
        change: function(level) {
            $.ajax({
                url: '/radio.php',
                data: {cmd: 'volume', level: level},
                context: this,
                dataType: 'json'
            });
        }
    });

    var Status = Backbone.Model.extend({
        update: function() {
            $.ajax({
                url: '/radio.php',
                data: {cmd: 'status'},
                context: this,
                dataType: 'json',
                success: function(r){
                    if (r.response.status == 'play')
                    {
                        this.set({isPlaying:true});
                        this.set({currentStation:r.response.station});
                    }
                    else
                    {
                        this.set({isPlaying:false});
                    }
                }
            });
        }
    });

    var Models = {
        volume: new Volume(),
        status: new Status(),
    };

    var List = Backbone.View.extend({
        el: $('#StationList'),

        stations: null,

        template: _.template($('#StationTpl').html()),

        render: function(status) {
            if (this.stations == null) {
                $.ajax({
                    url: '/radio.php',
                    context: this,
                    async: false,
                    dataType: 'json',
                    success: function(r){
                        this.stations = r.response.list;
                    }
                });
            }
            $(this.el).empty();
            if (status.get('isPlaying')) {
                $('h1').text('PLAYING: ' + status.get('currentStation'));
            } else {
                $('h1').text('RADIO STOPED');
            }
            for (var station in this.stations) {
                $(this.el).append(this.template({
                    stationName: station,
                    stationUrl:  encodeURIComponent(station),
                    active:      station == status.get('currentStation')
                }));
            }
        }
    });

    var Views = {
        list: new List()
    };

    var Controller = Backbone.Router.extend({

        status: Models.status,

        routes: {
            "": "list",
            "!/list": "list",
            "!/play/:station": "play",
            "!/stop": "stop",
        },

        list: function () {
            this.status.update();
            Views.list.render(this.status);
        },

        play: function (station) {
            $.ajax({
                url: '/radio.php',
                data: {cmd: 'play', station: station},
                context: this,
                dataType: 'json',
                success: function(r){
                    if ('station' in r.response) {
                        this.status.set({isPlaying: true});
                        this.status.set({currentStation: decodeURIComponent(station)});
                    }
                    Views.list.render(this.status);
                }
            });
        },

        stop: function () {
            $.ajax({
                url: '/radio.php',
                data: {cmd: 'stop'},
                context: this,
                dataType: 'json',
                success: function(r){
                    if (r.response.result == 1) {
                        this.status.set({isPlaying: false});
                        this.status.set({currentStation: null});
                    }
                    Views.list.render(this.status);
                }
            });
        }
    });

    var controller = new Controller();

    Backbone.history.start();
    Models.volume.change(4);

});
